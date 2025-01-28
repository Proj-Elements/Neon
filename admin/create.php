<?php
require_once 'header.php';
require_once 'footer.php';
require_once '../global.php';
require_once 'database.php';
require_once 'config/category.php';

$db = new Database();
$id = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serial = isset($_POST['serial']) ? 1 : 0;
    $id = $db->createBook($_POST['title'], $_POST['cover'], $_POST['author'], $_POST['description'], $_POST['category'], $serial);
}

headerBuilder("$id | admin");
?>
<div class="ui container" id="main">
    <div class="ui stackable grid">
        <div class="column">
            <form class="ui form segment" method="POST">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <div class="ui positive message">
                        <div class="header">新书已提交</div>
                        <p>分配的 ID 为：<?php echo $id ?></p>
                    </div>
                <? endif; ?>
                <h2>书籍管理</h2>
                <div class="ui divider"></div>
                <div class="field">
                    <label>书籍 ID</label>
                    <div class="ui labeled fluid input">
                        <div class="ui label">
                            #
                        </div>
                        <input type="text" placeholder="书籍 ID" value="未分配" disabled />
                    </div>
                </div>
                <div class="field">
                    <label>书籍名称</label>
                    <div class="ui right labeled fluid input">
                        <div class="ui label">
                            《
                        </div>
                        <input type="text" placeholder="书籍名称" name="title" required />
                        <div class="ui label">
                            》
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>书籍封面</label>
                    <div class="ui left icon input fluid">
                        <input type="text" name="cover" required />
                        <i class="linkify icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>作者</label>
                    <div class="ui left icon input fluid">
                        <input type="text" placeholder="作者" name="author" required />
                        <i class="user icon"></i>
                    </div>
                </div>
                <div class="field">
                    <label>作品简介</label>
                    <textarea placeholder="作品简介" name="description" required rows="2"></textarea>
                </div>
                <div class="field">
                    <label>分类</label>
                    <div class="ui fluid dropdown selection" tabindex="0">
                        <select name="category" required>
                            <?php for ($i = 0; $i < count($categories); $i++): ?>
                                <option value="<?php echo $i ?>"><?php echo $categories[$i] ?></op>
                                <?php endfor; ?>
                        </select>
                        <i class="dropdown icon"></i>
                        <div class="text"></div>
                        <div class="menu transition hidden" tabindex="-1">
                            <?php for ($i = 0; $i < count($categories); $i++): ?>
                                <div class="item" data-value="<?php echo $i ?>"><?php echo $categories[$i] ?></div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <script>
                        $('.ui.selection.dropdown')
                            .dropdown({});
                    </script>
                </div>
                <div class="field">
                    <label>连载状态</label>
                    <div class="ui toggle checkbox">
                        <input type="checkbox" name="serial" checked>
                        <label>仍在连载</label>
                    </div>
                </div>
                <button class="ui primary button" type="submit">
                <i class="plus icon"></i>确认添加</button>
            </form>
        </div>
    </div>
</div>
<?php
footerBuilder();
