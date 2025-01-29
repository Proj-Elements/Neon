<?php
require_once 'global.php';
require_once 'config/category.php';
require_once 'database.php';
require_once 'header.php';
require_once 'footer.php';

$db = new Database();
$top_ten = $db->hottestBooks(10);
$latest_books = $db->newestBooks(30);
$random_books = $db->randomBooks(30);
require_once './header.php';
headerBuilder("首页 | 新笔趣阁");
?>

<div class="ui container" id="main">
    <div class="ui stackable grid">
        <div class="twelve wide column">
            <h4 class="ui block top attached header">热门小说</h4>
            <div class="ui bottom attached segment">
                <div class="ui stackable equal width grid">
                    <?php for($i = 0; $i < 2; $i++): ?>
                        <div class="column">
                            <?php for($j = 0; $j < 2; $j++): ?>
                                <?php if($i * 2 + $j < count($top_ten)): ?>
                                    <div class="ui items">
                                        <div class="item">
                                            <a class="ui tiny rounded image" href="/book/<?php echo $top_ten[$i * 2 + $j]['id'] ?>">
                                                <img src="<?php echo $top_ten[$i * 2 + $j]['cover'] ?>" />
                                            </a>
                                            <div class="content">
                                                <a class="header" href="/book/<?php echo $top_ten[$i * 2 + $j]['id'] ?>"><?php echo $top_ten[$i * 2 + $j]['title'] ?></a>
                                                <div class="ui divider"></div>
                                                <div class="description">
                                                    <p><?php echo $top_ten[$i * 2 + $j]['description'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="four wide column">
            <table class="ui single line table">
                <thead>
                <tr>
                    <th colspan="2">
                        强力推荐
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php for($i = 4; $i < count($top_ten); $i++): ?>
                    <tr>
                        <td class="one wide center aligned category"><?php echo $categories[$top_ten[$i]['category']] ?></td>
                        <td class="fourity wide left aligned">
                            <a><?php echo $top_ten[$i]['title'] ?></a>
                        </td>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="ui stackable grid">
        <div class="eleven wide column">
            <table class="ui single line table">
                <thead>
                <tr>
                    <th colspan="5">
                        最近更新小说列表
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($latest_books as $book): ?>
                    <tr>
                        <td class="one wide center aligned"><?php echo $categories[$book['category']] ?></td>
                        <td class="five wide left aligned">
                            <a href="/book/<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a>
                        </td>
                        <td class="five wide left aligned">
                            <a href="/chapter/<?php echo $book['chapter_id'] ?>"><?php echo $book['chapter'] ?></a>
                        </td>
                        <td class="two wide right aligned author"><?php echo $book['author'] ?></td>
                        <td class="one wide center aligned time"><?php echo $book['time'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="five wide column">
            <table class="ui single line table">
                <thead>
                <tr>
                    <th colspan="3">
                        最新入库小说
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($random_books as $book): ?>
                    <tr>
                        <td class="one wide center aligned category"><?php echo $categories[$book['category']] ?></td>
                        <td class="eleven wide left aligned">
                            <a href="/book/<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a>
                        </td>
                        <td class="two wide right aligned author"><?php echo $book['author'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once './footer.php';
footerBuilder();