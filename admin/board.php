<?php
require_once 'header.php';
require_once 'footer.php';
require_once '../global.php';
require_once 'database.php';
require_once 'config/category.php';

checkLogin();
headerBuilder('首页 | 管理后台');

$db = new Database();
$result = $db -> hottestBooks(50);
?>
<div class="ui container" id="main">
    <div class="ui stackable equal width grid">
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    <div class="ui right floated huge header violet">
                        <i class="icon book"></i>
                    </div>
                    <div class="header">
                        <div class="ui huge header violet"><?php echo $db -> books(); ?></div>
                    </div>
                    <div class="meta">
                        <span>已收录书籍</span>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    <div class="ui right floated huge header orange">
                        <i class="icon file alternate"></i>
                    </div>
                    <div class="header">
                        <div class="ui huge header orange"><?php echo $db -> chapters(); ?></div>
                    </div>
                    <div class="meta">
                        <span>已收录章节</span>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    <div class="ui right floated huge header teal">
                        <i class="icon eye"></i>
                    </div>
                    <div class="header">
                        <div class="ui huge header teal"><?php echo $db -> readers(); ?></div>
                    </div>
                    <div class="meta">
                        <span>历史阅读量</span>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    <div class="ui stackable grid">
        <div class="column">
            <table class="ui single line table">
                <thead>
                    <tr>
                        <th colspan="3">
                            最多被阅读的 50 本书
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $book): ?>
                        <tr>
                            <td class="one wide center aligned collapsing category"><?php echo $categories[$book['category']] ?></td>
                            <td>
                                <a href="/book/<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a>
                            </td>
                            <td class="three wide right aligned collapsing time"><?php echo $book['view'] ?> 次阅读</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
footerBuilder();
