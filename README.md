# 氖 / Neon

> 元素周期表项目组的项目之一

Neon 是使用 PHP 语言开发的新笔趣阁，开发周期为 `?` 天。

### 使用方法

> [!IMPORTANT]
> 请在投入使用前关闭 `display_errors`。

1. 将 `database/database.sql` 导入本地数据库。
2. 将本仓库克隆至网站根目录。
3. 在 `config/define.php` 中配置本地数据库（目前仅支持 MySQL）信息。
4. 配置 `.htaccess` 中的伪静态（给出的为 Apache 格式的，Nginx 格式需自行转写）。

> [!TIP]
> 如果想要自定义分类，请修改 `config/category.php` 中的 `$categories` 数组。
> 请注意保留顶部的“未分类”选项。