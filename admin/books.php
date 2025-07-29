<?php
require_once 'header.php';
require_once 'footer.php';
require_once '../global.php';
require_once 'database.php';
require_once 'config/category.php';
require_once 'utils.php';

checkLogin();
headerBuilder('书籍列表 | 管理后台');

$db = new Database();
$result = $db->getAllBooks();
?>
<div class="ui container" id="main">
    <div class="ui stackable grid">
        <div class="column">
            <table class="ui celled striped table">
                <thead>
                    <tr>
                        <th colspan="6">
                            库中全部书籍
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $book): ?>
                        <tr>
                            <td class="one wide center aligned collapsing category">#<?php echo h($book['id']) ?></td>
                            <td class="one wide center aligned collapsing category"><?php echo h($categories[$book['category']]) ?></td>
                            <td class="five wide collapsing">
                                <a href="/admin/book/<?php echo h($book['id']) ?>"><?php echo h($book['title']) ?></a>
                            </td>
                            <td class="five wide collapsing"><?php echo h($book['chapter']) ?></td>
                            <td class="one wide center aligned collapsing category"><?php echo ["已完结", "连载中"][$book['serial']] ?></td>
                            <td class="two wide right aligned collapsing time"><?php echo h($book['view']) ?> 次阅读</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
footerBuilder();
