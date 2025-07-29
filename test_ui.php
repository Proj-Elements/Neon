<?php
// Mock data for UI testing
require_once 'config/category.php';
require_once 'header.php';
require_once 'footer.php';

// Mock book data
$top_ten = [
    ['id' => 1, 'title' => '斗破苍穹', 'author' => '天蚕土豆', 'category' => 1, 'cover' => 'https://via.placeholder.com/120x160/667eea/ffffff?text=斗破苍穹', 'description' => '这里是三十年河东，三十年河西，莫欺少年穷！萧炎，一个修炼废材，在机缘巧合下获得了药老师父，从此踏上了修炼之路。'],
    ['id' => 2, 'title' => '完美世界', 'author' => '辰东', 'category' => 1, 'cover' => 'https://via.placeholder.com/120x160/f093fb/ffffff?text=完美世界', 'description' => '一粒尘可填海，一根草斩尽日月星辰，弹指间天翻地覆。群雄并起，万族林立，诸圣争霸，乱天动地。'],
    ['id' => 3, 'title' => '遮天', 'author' => '辰东', 'category' => 1, 'cover' => 'https://via.placeholder.com/120x160/4facfe/ffffff?text=遮天', 'description' => '冰冷与黑暗并存的宇宙深处，九具庞大的龙尸拉着一口青铜古棺，亘古长存。'],
    ['id' => 4, 'title' => '神墓', 'author' => '辰东', 'category' => 1, 'cover' => 'https://via.placeholder.com/120x160/667eea/ffffff?text=神墓', 'description' => '神魔陵园，埋葬着无数死去了的神魔，但他们并非真正的死去...'],
    ['id' => 5, 'title' => '仙逆', 'author' => '耳根', 'category' => 4, 'cover' => 'https://via.placeholder.com/120x160/f093fb/ffffff?text=仙逆', 'description' => '顺为凡，逆为仙，只在心中一念间！是仙是凡，我王林说了才算！'],
    ['id' => 6, 'title' => '我欲封天', 'author' => '耳根', 'category' => 4, 'cover' => 'https://via.placeholder.com/120x160/4facfe/ffffff?text=我欲封天', 'description' => '我若要有，天不可无！我若要无，天不可有！这是一个起始于第九山海的故事，一个立志封天的少年，走向巅峰的传奇。'],
    ['id' => 7, 'title' => '求魔', 'author' => '耳根', 'category' => 4, 'cover' => 'https://via.placeholder.com/120x160/667eea/ffffff?text=求魔', 'description' => '苏铭的世界被摇动了，他眼前的天空，在这一瞬，成为了一面镜子...'],
    ['id' => 8, 'title' => '一念永恒', 'author' => '耳根', 'category' => 4, 'cover' => 'https://via.placeholder.com/120x160/f093fb/ffffff?text=一念永恒', 'description' => '一念成沧海，一念化桑田。一念斩千魔，一念诛万仙。唯我念...永恒'],
    ['id' => 9, 'title' => '将夜', 'author' => '猫腻', 'category' => 6, 'cover' => 'https://via.placeholder.com/120x160/4facfe/ffffff?text=将夜', 'description' => '宁缺是一个为了给自己的师父报仇而苦修的少年，意外考入最高学府书院。'],
    ['id' => 10, 'title' => '择天记', 'author' => '猫腻', 'category' => 6, 'cover' => 'https://via.placeholder.com/120x160/667eea/ffffff?text=择天记', 'description' => '太始元年，有神石自太空飞来，分散落在人间，其中落在东土大陆的神石，上面记载着奇妙的图案。']
];

$latest_books = [
    ['id' => 1, 'title' => '斗破苍穹', 'author' => '天蚕土豆', 'category' => 1, 'chapter_id' => 1, 'chapter' => '第2345章 终极对决', 'time' => '12:30'],
    ['id' => 2, 'title' => '完美世界', 'author' => '辰东', 'category' => 1, 'chapter_id' => 2, 'chapter' => '第1890章 帝战', 'time' => '11:45'],
    ['id' => 3, 'title' => '遮天', 'author' => '辰东', 'category' => 1, 'chapter_id' => 3, 'chapter' => '第3456章 仙路尽头', 'time' => '10:20'],
    ['id' => 4, 'title' => '神墓', 'author' => '辰东', 'category' => 1, 'chapter_id' => 4, 'chapter' => '第567章 神魔复苏', 'time' => '09:15'],
    ['id' => 5, 'title' => '仙逆', 'author' => '耳根', 'category' => 4, 'chapter_id' => 5, 'chapter' => '第2100章 逆天而行', 'time' => '08:30'],
];

$random_books = [
    ['id' => 11, 'title' => '武动乾坤', 'author' => '天蚕土豆', 'category' => 3],
    ['id' => 12, 'title' => '大主宰', 'author' => '天蚕土豆', 'category' => 1],
    ['id' => 13, 'title' => '元尊', 'author' => '天蚕土豆', 'category' => 1],
    ['id' => 14, 'title' => '万古神帝', 'author' => '飞天鱼', 'category' => 1],
    ['id' => 15, 'title' => '帝霸', 'author' => '厌笔萧生', 'category' => 1],
];

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
footerBuilder();
?>