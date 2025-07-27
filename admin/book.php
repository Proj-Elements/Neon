<?php
require_once 'header.php';
require_once 'footer.php';
require_once '../global.php';
require_once 'database.php';
require_once 'config/category.php';
require_once 'utils.php';

checkLogin();
headerBuilder("$id | 管理后台");

if (!isset($_GET['id'])) {
    header("Location: /admin/books");
    exit;
}
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header("Location: /admin/books");
    exit;
}
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $db->deleteBook($id);
        header("Location: /admin/books");
        exit;
    }
    
    $validation = validateBookData($_POST, $categories);
    if (!$validation['valid']) {
        $error = $validation['error'];
    } else {
        $bookData = sanitizeBookData($_POST);
        $db->updateBook($id, $bookData['title'], $bookData['cover'], 
                      $bookData['author'], $bookData['description'], 
                      $bookData['category'], $bookData['serial']);
        $success = true;
    }
}
$book = $db->getBookInfo($id);
if ($book == []) {
    header("Location: /admin/books");
    exit;
}
?>
<div class="ui container" id="main">
    <div class="ui stackable grid">
        <div class="column">
            <form class="ui form segment" method="POST">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($success)): ?>
                    <div class="ui positive message">
                        <div class="header">修改已保存</div>
                        <p>您对书籍信息的修改已保存到数据表中。</p>
                    </div>
                <?php elseif (isset($error)): ?>
                    <div class="ui negative message">
                        <div class="header">操作失败</div>
                        <p><?php echo h($error) ?></p>
                    </div>
                <?php endif; ?>
                <h2>书籍管理</h2>
                <div class="ui divider"></div>
                <div class="field">
                    <label>书籍 ID</label>
                    <div class="ui labeled fluid input">
                        <div class="ui label">
                            #
                        </div>
                        <input type="text" placeholder="书籍 ID" value="<?php echo h($book['id']) ?>" disabled />
                    </div>
                </div>
                <div class="field">
                    <label>书籍名称</label>
                    <div class="ui right labeled fluid input">
                        <div class="ui label">
                            《
                        </div>
                        <input type="text" placeholder="书籍名称" name="title" required value="<?php echo h($book['title']) ?>" />
                        <div class="ui label">
                            》
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>书籍封面</label>
                    <div class="ui left icon input fluid">
                        <input type="text" name="cover" value="<?php echo h($book['cover']) ?>" required />
                        <i class="linkify icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>作者</label>
                    <div class="ui left icon input fluid">
                        <input type="text" placeholder="作者" name="author" value="<?php echo h($book['author']) ?>" required />
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>作品简介</label>
                    <textarea placeholder="作品简介" name="description" required rows="2"><?php echo h($book['description']) ?></textarea>
                </div>
                <div class="field">
                    <label>分类</label>
                    <div class="ui fluid dropdown selection" tabindex="0">
                        <select name="category" required>
                            <?php echo generateCategoryOptions($categories, $book['category']); ?>
                        </select>
                        <i class="dropdown icon"></i>
                        <div class="text"><?php echo h($categories[$book['category']]) ?></div>
                        <div class="menu transition hidden" tabindex="-1">
                            <?php echo generateCategoryItems($categories, $book['category']); ?>
                        </div>
                    </div>
                    <script>
                        $('.ui.selection.dropdown')
                            .dropdown('set selected', "<?php echo h($categories[$book['category']]) ?>");
                    </script>
                </div>
                <div class="field">
                    <label>连载状态</label>
                    <div class="ui toggle checkbox">
                        <input type="checkbox" name="serial" <?php echo $book['serial'] ? 'checked' : '' ?>>
                        <label>仍在连载</label>
                    </div>
                </div>
                <div>
                    <button class="ui primary button" type="submit">
                        <i class="icon save"></i>
                        保存修改
                    </button>
                    <button class="ui button red" type="button" onclick="$('.ui.modal').modal('show');">
                        <i class="icon trash"></i>
                        删除书籍
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="ui modal">
    <div class="header">
        书籍管理
    </div>
    <div class="image content">
        <div class="ui small image">
            <img src="<?php echo h($book['cover']) ?>">
        </div>
        <div class="description">
            <div class="ui header">确认删除《<?php echo h($book['title']) ?>》？</div>
            <p>这将删除与本书相关的所有章节。</p>
        </div>
    </div>
    <div class="actions">
        <div class="ui deny button">
            <i class="close icon"></i>
            取消
        </div>
        <div class="ui negative right labeled icon button" onclick="$('#hf').submit();">
            确认删除
            <i class="trash icon"></i>
        </div>
        <form id="hf" method="POST">
            <input type="hidden" name="delete" value="1" />
        </form>
    </div>
</div>
<?php
footerBuilder();
