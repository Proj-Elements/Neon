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
    <!-- Hero Section with Welcome Message -->
    <div class="ui segment" style="background: var(--primary-gradient); color: white; text-align: center; margin-bottom: 2em; border: none;">
        <h1 style="color: white; margin: 0; font-size: 2.5em; font-weight: 300;">
            📚 欢迎来到新笔趣阁
        </h1>
        <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.2em; margin: 0.5em 0 0;">
            发现精彩小说，享受阅读时光
        </p>
    </div>

    <div class="ui stackable grid">
        <div class="twelve wide column">
            <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
                <h4 class="ui block top attached header" style="background: var(--primary-gradient); color: white; padding: 1.2em; margin: 0; border-radius: var(--border-radius) var(--border-radius) 0 0;">
                    🔥 热门小说推荐
                </h4>
                <div class="ui bottom attached segment" style="border-radius: 0 0 var(--border-radius) var(--border-radius); background: var(--bg-color);">
                    <div class="ui stackable equal width grid">
                        <?php for($i = 0; $i < 2; $i++): ?>
                            <div class="column">
                                <?php for($j = 0; $j < 2; $j++): ?>
                                    <?php if($i * 2 + $j < count($top_ten)): ?>
                                        <div class="ui items" style="margin-bottom: 1.5em;">
                                            <div class="item" style="background: var(--bg-secondary); border-radius: var(--border-radius); padding: 1.5em; transition: var(--transition);">
                                                <a class="ui small rounded image" href="/book/<?php echo $top_ten[$i * 2 + $j]['id'] ?>" style="margin-right: 1.5em;">
                                                    <img src="<?php echo $top_ten[$i * 2 + $j]['cover'] ?>" style="border-radius: var(--border-radius); box-shadow: var(--shadow-light);" />
                                                </a>
                                                <div class="content">
                                                    <a class="header" href="/book/<?php echo $top_ten[$i * 2 + $j]['id'] ?>" style="color: var(--text-color); font-weight: 600; font-size: 1.2em; line-height: 1.4;">
                                                        <?php echo $top_ten[$i * 2 + $j]['title'] ?>
                                                    </a>
                                                    <div class="ui divider" style="margin: 1em 0;"></div>
                                                    <div class="description">
                                                        <p style="color: var(--text-muted); line-height: 1.6;">
                                                            <?php echo $top_ten[$i * 2 + $j]['description'] ?>
                                                        </p>
                                                    </div>
                                                    <div class="meta" style="margin-top: 1em; color: var(--text-muted);">
                                                        <span style="background: var(--primary-color); color: white; padding: 0.3em 0.8em; border-radius: 15px; font-size: 0.85em;">
                                                            <?php echo $categories[$top_ten[$i * 2 + $j]['category']] ?>
                                                        </span>
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
        </div>
        <div class="four wide column">
            <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
                <table class="ui single line table" style="border: none; border-radius: var(--border-radius); overflow: hidden;">
                    <thead>
                    <tr>
                        <th colspan="2" style="background: var(--secondary-color); background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; text-align: center; padding: 1.2em;">
                            ⭐ 强力推荐
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for($i = 4; $i < count($top_ten); $i++): ?>
                        <tr style="transition: var(--transition);">
                            <td class="one wide center aligned category" style="border-right: 1px solid var(--border-color);">
                                <span style="background: var(--accent-color); color: white; padding: 0.3em 0.5em; border-radius: 12px; font-size: 0.8em;">
                                    <?php echo $categories[$top_ten[$i]['category']] ?>
                                </span>
                            </td>
                            <td class="fourteen wide left aligned" style="padding: 1em;">
                                <a href="/book/<?php echo $top_ten[$i]['id'] ?>" style="font-weight: 500; color: var(--text-color);">
                                    <?php echo $top_ten[$i]['title'] ?>
                                </a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="ui stackable grid" style="margin-top: 2em;">
        <div class="eleven wide column">
            <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
                <table class="ui single line table" style="border: none; border-radius: var(--border-radius); overflow: hidden;">
                    <thead>
                    <tr>
                        <th colspan="5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; padding: 1.2em;">
                            📰 最近更新小说列表
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($latest_books as $book): ?>
                        <tr style="transition: var(--transition); cursor: pointer;" onclick="window.location.href='/book/<?php echo $book['id'] ?>'">
                            <td class="one wide center aligned" style="border-right: 1px solid var(--border-color);">
                                <span style="background: var(--primary-color); color: white; padding: 0.3em 0.5em; border-radius: 12px; font-size: 0.8em;">
                                    <?php echo $categories[$book['category']] ?>
                                </span>
                            </td>
                            <td class="five wide left aligned" style="padding: 1em; font-weight: 500;">
                                <a href="/book/<?php echo $book['id'] ?>" style="color: var(--text-color); text-decoration: none;">
                                    <?php echo $book['title'] ?>
                                </a>
                            </td>
                            <td class="five wide left aligned" style="padding: 1em;">
                                <a href="/chapter/<?php echo $book['chapter_id'] ?>" style="color: var(--accent-color); text-decoration: none;">
                                    📖 <?php echo $book['chapter'] ?>
                                </a>
                            </td>
                            <td class="two wide right aligned author" style="padding: 1em; color: var(--text-muted);">
                                👤 <?php echo $book['author'] ?>
                            </td>
                            <td class="one wide center aligned time" style="padding: 1em; color: var(--text-muted); font-size: 0.9em;">
                                🕒 <?php echo $book['time'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="five wide column">
            <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
                <table class="ui single line table" style="border: none; border-radius: var(--border-radius); overflow: hidden;">
                    <thead>
                    <tr>
                        <th colspan="3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; text-align: center; padding: 1.2em;">
                            ✨ 最新入库小说
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($random_books as $book): ?>
                        <tr style="transition: var(--transition); cursor: pointer;" onclick="window.location.href='/book/<?php echo $book['id'] ?>'">
                            <td class="one wide center aligned category" style="border-right: 1px solid var(--border-color);">
                                <span style="background: var(--accent-color); color: white; padding: 0.3em 0.5em; border-radius: 12px; font-size: 0.8em;">
                                    <?php echo $categories[$book['category']] ?>
                                </span>
                            </td>
                            <td class="ten wide left aligned" style="padding: 1em; font-weight: 500;">
                                <a href="/book/<?php echo $book['id'] ?>" style="color: var(--text-color); text-decoration: none;">
                                    <?php echo $book['title'] ?>
                                </a>
                            </td>
                            <td class="three wide right aligned author" style="padding: 1em; color: var(--text-muted); font-size: 0.9em;">
                                👤 <?php echo $book['author'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once './footer.php';
footerBuilder();