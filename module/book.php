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
    <!-- Enhanced Book Info Section -->
    <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium); margin-bottom: 2em;">
        <div class="ui items" style="padding: 2em; background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);">
            <div class="item">
                <div class="ui medium rounded image" style="margin-right: 2em;">
                    <img src="<?php echo h($book['cover']); ?>" style="border-radius: var(--border-radius); box-shadow: var(--shadow-medium);">
                </div>
                <div class="content">
                    <h1 style="color: var(--text-color); margin-bottom: 1em; font-size: 2.5em; font-weight: 600;">
                        📖 <?php echo h($book['title']); ?>
                    </h1>
                    <div class="ui relaxed divided list">
                        <div class="item">
                            <div class="ui horizontal label" style="background: var(--primary-gradient); color: white; margin-right: 1em;">
                                👤 作者
                            </div>
                            <span style="font-size: 1.1em; font-weight: 500;"><?php echo h($book['author']); ?></span>
                        </div>
                        <div class="item">
                            <div class="ui horizontal label" style="background: var(--accent-color); color: white; margin-right: 1em;">
                                📊 状态
                            </div>
                            <span style="font-size: 1.1em;">
                                <?php echo ["✅ 已完结", "📝 连载中"][$book['serial']]; ?>
                            </span>
                        </div>
                        <div class="item">
                            <div class="ui horizontal label" style="background: var(--secondary-color); color: white; margin-right: 1em;">
                                🕒 更新
                            </div>
                            <span style="font-size: 1.1em;"><?php echo h($book['time']); ?></span>
                        </div>
                        <div class="item">
                            <div class="ui horizontal label" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; margin-right: 1em;">
                                📚 最新章节
                            </div>
                            <a href="/chapter/<?php echo h($book['chapter_id']) ?>" style="font-size: 1.1em; font-weight: 500; color: var(--primary-color);">
                                <?php echo h($book['chapter']); ?>
                            </a>
                        </div>
                    </div>
                    <div class="ui divider" style="margin: 2em 0;"></div>
                    <div class="description">
                        <h3 style="color: var(--text-color); margin-bottom: 1em;">
                            📝 简介
                        </h3>
                        <p style="font-size: 1.1em; line-height: 1.8; color: var(--text-color); background: var(--bg-secondary); padding: 1.5em; border-radius: var(--border-radius); border-left: 4px solid var(--primary-color);">
                            <?php echo h($book['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Chapter List -->
    <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
        <table class="ui single line equal width table" style="border: none; border-radius: var(--border-radius); overflow: hidden;">
            <thead>
            <tr>
                <th class="center aligned" colspan="3" style="background: var(--primary-gradient); color: white; padding: 1.5em; font-size: 1.2em;">
                    📚 《<?php echo h($book['title']); ?>》章节目录
                </th>
            </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($chapters); $i += 3): ?>
                <tr style="transition: var(--transition);">
                    <?php for ($j = 0; $j < 3; $j ++): ?>
                        <td style="padding: 1em; border-right: <?php echo $j < 2 ? '1px solid var(--border-color)' : 'none'; ?>;">
                            <?php if($i + $j < count($chapters)): ?>
                            <a href="/chapter/<?php echo h($chapters[$i + $j]['id']) ?>" 
                               style="display: block; padding: 0.8em; border-radius: var(--border-radius); transition: var(--transition); color: var(--text-color); text-decoration: none; background: var(--bg-secondary);"
                               onmouseover="this.style.background='var(--primary-color)'; this.style.color='white'; this.style.transform='translateX(5px)';"
                               onmouseout="this.style.background='var(--bg-secondary)'; this.style.color='var(--text-color)'; this.style.transform='translateX(0)';">
                                📄 <?php echo h($chapters[$i + $j]["title"]) ?>
                            </a>
                            <?php endif; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</div>

<?php footerBuilder(); ?>