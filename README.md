# 氖 / Neon

> 元素周期表项目组的项目之一

Neon 是使用 PHP 语言开发的新笔趣阁，开发周期为 `?` 天。

### 使用方法

1. 将 `database/database.sql` 导入本地数据库。
2. 将本仓库克隆至网站根目录。
3. 在 `config/define.php` 中配置本地数据库（目前仅支持 MySQL）信息。
4. 配置 `.htaccess` 中的伪静态（给出的为 Apache 格式的，Nginx 格式需自行转写）。

> [!IMPORTANT]
> 请在投入使用前关闭 `display_errors`。