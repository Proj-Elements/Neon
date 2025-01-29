<?php
require_once 'header.php';
require_once 'footer.php';
require_once '../global.php';
require_once 'database.php';

$db = new Database();

$alert_type = "positive";
$alert_title = "";
$alert_meta = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $book_id = $_POST['book_id'];
        $belong = $db->getBookInfo($book_id)['title'];
        if (!$belong) {
            // TODO: 页面内报错
            die("未找到对应的书籍ID：" . $book_id);
        } else {
            $file = $_FILES['file']['tmp_name'];
            $content = file_get_contents($file);
            $chapters = preg_split('/(?=^第\s*[\d零一二三四五六七八九十百千万\s]+章\s*)/m', $content);
            $uploadDir = "data/$book_id/";
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0755, true);
            $existing_num = 0;
            $new_num = 0;
            // ↑ 初始化
            // ↓ 逻辑处理

            $latest_id = $db->executeQuery("SELECT `id` FROM `neon_chapters` WHERE `belong_id` = ? ORDER BY `id` DESC LIMIT 1", "i", [$book_id])->fetch_assoc();
            if ($latest_id == []) $latest_id = 0;
            else $latest_id = $latest_id['id'];


            foreach ($chapters as $chapter) {
                preg_match('/^第\s*[\d零一二三四五六七八九十百千万\s]+章\s*(.*)/', $chapter, $matches);
                $title = $matches[0] ?? '0';
                $chapterContent = preg_replace('/^第\s*[\d零一二三四五六七八九十百千万\s]+章\s*.*/', '', $chapter);
                if (trim($chapterContent) === '' || $title === '0') {
                    continue;
                }

                $existing_id = $db->executeQuery("SELECT `id` FROM `neon_chapters` WHERE `title` = ? AND `belong_id` = ?", "si", [$title, $book_id])->fetch_assoc();
                $chapter_id = $existing_id['id'] ?? null;

                if($existing_id == []) {
                    $new_num++;
                    $db -> executeQuery("INSERT INTO `neon_chapters` (`title`, `belong`, `belong_id`, `previous`) VALUES (?, ?, ?, ?)", "ssii", [$title, $belong, $book_id, $latest_id]);
                    $chapter_id = $db -> getInsertId();
                    if($latest_id != 0)
                        $db -> executeQuery("UPDATE `neon_chapters` SET `next` = ? WHERE `id` = ?", "ii", [$chapter_id, $latest_id]);
                    $latest_id = $chapter_id;
                }
                else {
                    $existing_num++;
                }
                $chapterFileName = $uploadDir . $chapter_id . '.txt';
                file_put_contents($chapterFileName, trim($chapterContent));
                if(!isset($existing_id))
                    $db -> executeQuery("UPDATE `neon_books` SET `chapter` = ?, `chapter_id` = ? WHERE `id` = ?", "sii", [$title, $chapter_id, $book_id]);
            }
        }
        $alert_title = "书籍已上传";
        $alert_meta = "共新增 $new_num 章，修改 $existing_num 章。";
    } else {
        $alert_type = "negative";
        $alert_title = "书籍上传失败";
        $alert_meta = "文件上传失败，请检查文件格式或大小。";
    }
}

headerBuilder("上传书籍 | 管理后台");
?>

<div class="ui container" id="main">
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST"): ?>
        <div class="ui <?php echo $alert_type; ?> message">
            <div class="header"><?php echo $alert_title; ?></div>
            <p><?php echo $alert_meta; ?></p>
        </div>
    <?php endif; ?>
    <h2 class="ui header">上传书籍</h2>
    <form class="ui form" method="post" enctype="multipart/form-data">
        <div class="field">
            <label>书籍 ID</label>
            <input type="number" name="book_id" required>
        </div>
        <div class="field">
            <label>选择文件</label>
            <input type="file" name="file" accept=".txt" required>
        </div>
        <button class="ui primary button" type="submit">
            <i class="icon cloud upload"></i>
            上传
        </button>
    </form>
</div>

<?php
footerBuilder();
