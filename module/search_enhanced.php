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

headerBuilder("「{$keyword}」 的搜索结果 | 新笔趣阁");
?>

<div class="ui container" id="main">
    <!-- Enhanced Search Header -->
    <div class="ui segment" style="background: var(--primary-gradient); color: white; text-align: center; margin-bottom: 2em; border: none;">
        <h1 style="color: white; margin: 0; font-size: 2em; font-weight: 400;">
            🔍 搜索结果
        </h1>
        <p style="color: rgba(255, 255, 255, 0.9); font-size: 1.2em; margin: 0.5em 0 0;">
            为您找到关键词 "<strong><?php echo htmlspecialchars($keyword); ?></strong>" 的相关结果
        </p>
    </div>

    <?php if(empty($result)): ?>
    <!-- No Results Found -->
    <div class="ui segment" style="text-align: center; padding: 4em 2em; border: none; box-shadow: var(--shadow-light);">
        <div style="font-size: 4em; margin-bottom: 1em; opacity: 0.3;">📚</div>
        <h2 style="color: var(--text-muted); margin-bottom: 1em;">未找到相关小说</h2>
        <p style="color: var(--text-muted); font-size: 1.1em; margin-bottom: 2em;">
            抱歉，没有找到包含关键词 "<strong><?php echo htmlspecialchars($keyword); ?></strong>" 的小说
        </p>
        <div class="ui buttons">
            <a href="/" class="ui primary button" style="background: var(--primary-gradient); border: none;">
                <i class="home icon"></i> 返回首页
            </a>
            <div class="or" data-text="或"></div>
            <a href="#" onclick="document.getElementById('search').focus(); return false;" class="ui button">
                <i class="search icon"></i> 重新搜索
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- Search Results -->
    <div class="ui segment" style="border: none; padding: 0; box-shadow: var(--shadow-medium);">
        <table class="ui single line table" style="border: none; border-radius: var(--border-radius); overflow: hidden;">
            <thead>
                <tr>
                    <th colspan="5" style="background: var(--primary-gradient); color: white; text-align: center; padding: 1.2em; font-size: 1.1em;">
                        📊 找到 <?php echo count($result); ?> 部相关小说
                    </th>
                </tr>
                <tr style="background: var(--bg-secondary);">
                    <th style="text-align: center; color: var(--text-color); padding: 1em; font-weight: 600;">分类</th>
                    <th style="text-align: left; color: var(--text-color); padding: 1em; font-weight: 600;">书名</th>
                    <th style="text-align: left; color: var(--text-color); padding: 1em; font-weight: 600;">最新章节</th>
                    <th style="text-align: center; color: var(--text-color); padding: 1em; font-weight: 600;">作者</th>
                    <th style="text-align: center; color: var(--text-color); padding: 1em; font-weight: 600;">更新时间</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $index => $book): ?>
                    <tr style="transition: var(--transition); cursor: pointer; background: <?php echo $index % 2 == 0 ? 'white' : 'var(--bg-secondary)'; ?>;" 
                        onclick="window.location.href='/book/<?php echo $book['id'] ?>'"
                        onmouseover="this.style.background='linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='var(--shadow-light)';"
                        onmouseout="this.style.background='<?php echo $index % 2 == 0 ? 'white' : 'var(--bg-secondary)'; ?>'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <td class="center aligned" style="border-right: 1px solid var(--border-color); padding: 1em;">
                            <span style="background: var(--primary-color); color: white; padding: 0.4em 0.8em; border-radius: 15px; font-size: 0.85em; font-weight: 500;">
                                <?php echo $categories[$book['category']] ?>
                            </span>
                        </td>
                        <td class="left aligned" style="padding: 1em; font-weight: 600; border-right: 1px solid var(--border-color);">
                            <a href="/book/<?php echo $book['id'] ?>" style="color: var(--text-color); text-decoration: none; font-size: 1.05em;">
                                📖 <?php echo htmlspecialchars($book['title']) ?>
                            </a>
                        </td>
                        <td class="left aligned" style="padding: 1em; border-right: 1px solid var(--border-color);">
                            <a href="/chapter/<?php echo $book['chapter_id'] ?>" style="color: var(--accent-color); text-decoration: none;">
                                📄 <?php echo htmlspecialchars($book['chapter']) ?>
                            </a>
                        </td>
                        <td class="center aligned author" style="padding: 1em; color: var(--text-muted); border-right: 1px solid var(--border-color);">
                            👤 <?php echo htmlspecialchars($book['author']) ?>
                        </td>
                        <td class="center aligned time" style="padding: 1em; color: var(--text-muted); font-size: 0.95em;">
                            🕒 <?php echo htmlspecialchars($book['time']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Search Tips -->
    <div class="ui segment" style="margin-top: 2em; border: 1px solid var(--border-color); border-radius: var(--border-radius); background: var(--bg-secondary);">
        <h4 style="color: var(--text-color); margin-bottom: 1em;">
            💡 搜索小贴士
        </h4>
        <div class="ui relaxed list">
            <div class="item">
                <i class="lightbulb outline icon" style="color: var(--primary-color);"></i>
                <div class="content">
                    <div class="description">
                        可以搜索书名、作者名或者关键词来找到您想要的小说
                    </div>
                </div>
            </div>
            <div class="item">
                <i class="keyboard outline icon" style="color: var(--accent-color);"></i>
                <div class="content">
                    <div class="description">
                        使用快捷键 <code style="background: var(--primary-color); color: white; padding: 0.2em 0.5em; border-radius: 3px;">Ctrl + K</code> 可以快速打开搜索框
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php footerBuilder(); ?>