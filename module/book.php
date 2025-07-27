<?php
require_once '../global.php';
require_once 'config/category.php';
require_once 'database.php';
require_once 'header.php';
require_once 'footer.php';

if (!isset($_GET['id'])) die();
$id = $_GET['id'];
$db = new Database();
$book = $db -> getBookInfo($id);
if($book == []) die();
$chapters = $db -> getBookChapters($id);
$db -> read($id);

headerBuilder("《" . $book['title'] . "》 | 新笔趣阁");
?>

<div class="ui container" id="main">
    <div class="ui segment items">
        <div class="item">
            <div class="ui small rounded image">
                <img src="<?php echo $book['cover']; ?>">
            </div>
            <div class="content">
                <h2>
                    <?php echo $book['title']; ?>
                </h2>
                <div class="meta">
                    <span>
                        作者：<?php echo $book['author']; ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        状态：<?php echo ["已完结", "连载中"][$book['serial']]; ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        更新：<?php echo $book['time']; ?>
                    </span>
                </div>
                <div class="meta">
                    <span>
                        最新章节：<a href="/chapter/<?php echo $book['chapter_id'] ?>"><?php echo $book['chapter']; ?></a>
                    </span>
                </div>
                <div class="ui divider"></div>
                <div class="description">
                    <p>
                        简介：<?php echo $book['description']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <table class="ui single line equal width table">
        <thead>
        <tr>
            <th class="center aligned" colspan="3">
                《<?php echo $book['title']; ?>》最新章节列表
            </th>
        </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($chapters); $i += 3): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j ++): ?>
                    <td>
                        <?php if($i + $j < count($chapters)): ?>
                        <a href="/chapter/<?php echo $chapters[$i + $j]['id'] ?>"><?php echo $chapters[$i + $j]["title"] ?></a>
                        <?php endif; ?>
                    </td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<?php footerBuilder(); ?>