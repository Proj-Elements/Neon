<?php
require_once '../global.php';
require_once 'config/category.php';
require_once 'database.php';
require_once 'header.php';
require_once 'footer.php';

if (!isset($_GET['id'])) die();
$id = $_GET['id'];
$db = new Database();
$chapter = $db -> getChapterInfo($id);
if($chapter == []) die();
$file = 'data/' . $chapter['belong_id'] . '/' . $chapter['id'] . '.txt';
if (!file_exists($file)) die();
$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

headerBuilder($chapter['title'] . ' | 新笔趣阁');
?>

<div class="ui container" id="main">
    <h4 class="ui block top attached header">
        <div class="ui tiny breadcrumb">
            <a class="section" href="/">首页</a>
            <i class="right chevron icon divider"></i>
            <a class="section" href="/book/<?php echo $chapter['belong_id'] ?>"><?php echo $chapter["belong"] ?></a>
            <i class="right chevron icon divider"></i>
            <div class="active section"><?php echo $chapter['title'] ?></div>
        </div>
    </h4>
    <div class="ui bottom attached text segment">
        <div class="ui container" id="reader" style="width: 95% !important;">
            <div class="ui center aligned container">
                <h1><?php echo $chapter['title'] ?></h1>
            </div>
            <div class="ui divider"></div>
            <?php foreach ($lines as $line): ?>
                <p><?php echo $line ?></p>
            <?php endforeach; ?>
            <br />
        </div>
    </div>
    <div class="ui horizontal segments">
        <a class="ui <?php echo ['disabled', ''][boolval($chapter['previous'])] ?> button segment"
            href="/chapter/<?php echo $chapter['previous'] ?>">
            <i class="icon arrow left"></i>
            上一章
        </a>
        <a class="ui button segment" href="/book/<?php echo $chapter['belong_id'] ?>">
            <i class="icon list"></i>
            目录
        </a>
        <a class="ui <?php echo ['disabled', ''][boolval($chapter['next'])] ?> button segment"
            href="/chapter/<?php echo $chapter['next'] ?>">
            下一章
            <i class="icon arrow right"></i>
        </a>
    </div>
    <script>
        const fs = $.cookie('fs');
        if (fs) {
            $('#reader p').css('font-size', fs + 'px');
        }
    </script>
</div>
<script>
    $(document).keydown(function (event) {
        if (event.which === 39 && <?php echo ['false', 'true'][boolval($chapter['next'])] ?>) {
            window.location.href = `/chapter/<?php echo $chapter['next'] ?>`;
        }
        if (event.which === 37 && <?php echo ['false', 'true'][boolval($chapter['previous'])] ?>) {
            window.location.href = `/chapter/<?php echo $chapter['previous'] ?>`;
        }
    });
</script>

<?php footerBuilder(); ?>