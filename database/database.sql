SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE TABLE `neon_articles` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
    `previous` int(11) NOT NULL COMMENT '上一章的 ID',
    `next` int(11) NOT NULL COMMENT '下一章的 ID',
    `belong` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '属于的书籍名称',
    `belong_id` int(11) NOT NULL COMMENT '属于的书籍 ID',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `neon_books` (
    `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
    `cover` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '封面链接',
    `author` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '作者',
    `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '简介',
    `view` bigint(20) NOT NULL DEFAULT '0' COMMENT '阅读次数',
    `category` int(11) NOT NULL COMMENT '分类',
    `serial` tinyint(1) NOT NULL COMMENT '连载状态',
    `chapter` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '最新章节的名称',
    `chapter_id` int(11) NOT NULL COMMENT '最新章节的 id',
    `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;