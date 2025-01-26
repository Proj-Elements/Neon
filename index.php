<?php
require_once '/database.php';
require_once '/config/category.php';
global $category;
$db = new Database();
$top_ten = $db->hottestBooks(10);
$latest_books = $db->newestBooks(30);
$random_books = $db->randomBooks(30);
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="小说,免费小说,笔趣阁,在线读,免费读" />
    <meta name="description" content="笔趣阁" />
    <link rel="stylesheet" type="text/css" href="/resource/semantic/semantic.min.css" />
    <link rel="stylesheet" type="text/css" href="/resource/style.css" />
    <script src="/resource/semantic/semantic.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <title>首页 | 新笔趣阁</title>
</head>

<body>
<div class="ui borderless top fixed menu">
    <div class="ui container">
        <div class="item">
            <h2>新笔趣阁</h2>
        </div>
        <a class="item" href="/">首页</a>
        <div class="ui simple dropdown item">
            分类
            <i class="dropdown icon"></i>
            <div class="menu">
                <?php for($i = 1; $i <= 14; $i++): ?>
                    <a class="item" href="/category/<?php echo $i; ?>"><?php echo $category[$i]; ?></a>
                <?php endfor; ?>
            </div>
        </div>
        <a class="item">排行榜</a>
        <div class="item right">
            <div class="ui category search item">
                <div class="ui transparent icon input">
                    <input class="prompt" type="text" placeholder="搜索书名" id="search">
                    <i class="search link icon" id="search_btn"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
    </div>
</div>
<div class="ui container" id="main">
    <div class="ui stackable grid">
        <div class="twelve wide column">
            <h4 class="ui block top attached header">热门小说</h4>
            <div class="ui bottom attached segment">
                <div class="ui stackable equal width grid">
                    <?php for($i = 0; $i < 2; $i++): ?>
                        <div class="column">
                            <?php for($j = 0; $j < 2; $j++): ?>
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
                <?php for($i = 4; $i < 10; $i++): ?>
                    <tr>
                        <td class="one wide center aligned category"><?php echo $category[$top_ten[$i]['category']] ?></td>
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
                        <td class="one wide center aligned"><?php echo $category[$book['category']] ?></td>
                        <td class="five wide left aligned">
                            <a href="/book/<?php echo $book['id'] ?>"><?php echo $book['title'] ?></a>
                        </td>
                        <td class="five wide left aligned">
                            <a href="/read/<?php echo $book['chapter_id'] ?>"><?php echo $book['chapter'] ?></a>
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
                        <td class="one wide center aligned category"><?php echo $category[$book['category']] ?></td>
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
<script>
    function search(text) {
        const encodedText = encodeURIComponent(text);
        window.location.href = `/search/${encodedText}`;
    }
    $(document).ready(function() {
        $("#search").on('keypress', function(event) {
            if(event.which === 13) {
                const content = $(this).val();
                search(content);
            }
        });
        $("#search_btn").on("click", function() {
            const content = $("#search").val();
            search(content);
        });
    });
</script>
</body>

</html>