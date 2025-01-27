<?php
require_once '../global.php';
require_once 'config/category.php';
require_once 'database.php';
require_once 'header.php';
require_once 'footer.php';

if (!isset($_GET['keyword']))
    die();
$keyword = $_GET['keyword'];
$result = (new Database())->searchBook($_GET['keyword']);

headerBuilder("“{$keyword}” 的搜索结果 | 新笔趣阁");
?>

<div class="ui container" id="main">
    <table class="ui single line table">
        <thead>
            <tr>
                <th colspan="5">
                    “<?php echo $keyword; ?>” 的搜索结果
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $book): ?>
                <tr>
                    <td class="one wide center aligned"><?php echo $category[$book['category']] ?></td>
                    <td class="five wide left aligned">
                        <a href="/book/<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a>
                    </td>
                    <td class="five wide left aligned">
                        <a href="/chapter/<?php echo $book['chapter_id'] ?>"><?php echo $book['chapter'] ?></a>
                    </td>
                    <td class="one wide right aligned author"><?php echo $book['author'] ?></td>
                    <td class="two wide center aligned time"><?php echo $book['time'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php footerBuilder(); ?>