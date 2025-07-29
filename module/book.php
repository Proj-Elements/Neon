<?php
require_once '../global.php';
require_once 'config/category.php';
require_once 'database.php';
require_once 'header.php';
require_once 'footer.php';
require_once '../admin/utils.php';

if (!isset($_GET['id'])) {
    header("Location: /");
    exit;
}
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header("Location: /");
    exit;
}
$db = new Database();
$book = $db -> getBookInfo($id);
if($book == []) {
    header("Location: /");
    exit;
}
$chapters = $db -> getBookChapters($id);
$db -> read($id);

headerBuilder("《" . h($book['title']) . "》 | 新笔趣阁");
?>

<div class="ui container" id="main">
    <div class="ui segment items">
        <div class="item">
            <div class="ui small rounded image">
                <img src="<?php echo h($book['cover']); ?>">
            </div>
            <div class="content">
                <h2>
                    <?php echo h($book['title']); ?>
                </h2>
                <div class="meta">
                    <span>
                        作者：<?php echo h($book['author']); ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        状态：<?php echo ["已完结", "连载中"][$book['serial']]; ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        更新：<?php echo h($book['time']); ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        最新章节：<a href="/chapter/<?php echo h($book['chapter_id']) ?>"><?php echo h($book['chapter']); ?></a>
                    </span>
                </div>
                <div class="ui divider"></div>
                <div class="description">
                    <p>
                        简介：<?php echo h($book['description']); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <table class="ui single line equal width table">
        <thead>
        <tr>
            <th class="center aligned" colspan="3">
                《<?php echo h($book['title']); ?>》最新章节列表
            </th>
        </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($chapters); $i += 3): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j ++): ?>
                    <td>
                        <?php if($i + $j < count($chapters)): ?>
                        <a href="/chapter/<?php echo h($chapters[$i + $j]['id']) ?>"><?php echo h($chapters[$i + $j]["title"]) ?></a>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<?php footerBuilder(); ?>