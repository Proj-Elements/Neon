<?php
require_once './config/define.php';

/**
 * 数据库操作类
 */
class Database
{
    /**
     * 数据库连接
     * @var mysqli
     */
    private $connection;

    /**
     * 数据库构造函数
     */
    public function __construct()
    {
        $this->connection = new mysqli(NEON_DB_HOST, NEON_DB_USER, NEON_DB_PASS, NEON_DB_NAME);
        if ($this->connection->connect_errno) {
            die("Failed to connect to MySQL: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8");
    }

    /**
     * 执行查询
     * @param mixed $query 查询语句
     * @param mixed $types 参数类型
     * @param mixed $params 参数
     * @return bool|mysqli_result 查询结果
     */
    private function executeQuery($query, $types, $params)
    {
        $request = $this->connection->prepare($query);
        $request->bind_param($types, ...$params);
        $request->execute();
        $result = $request->get_result();
        $request->close();
        return $result;
    }

    /**
     * 获取最新的书籍
     * @param int $size 书籍数量
     * @return array 书籍信息
     */
    public function newestBooks(int $size): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_books` ORDER BY `time` DESC LIMIT ?", "i", [$size]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 获取最热门的书籍
     * @param int $size 书籍数量
     * @return array 书籍信息
     */
    public function hottestBooks(int $size): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_books` ORDER BY `view` DESC LIMIT ?", "i", [$size]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 获取随机的书籍
     * @param int $size 书籍数量
     * @return array 书籍信息
     */
    public function randomBooks(int $size): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_books` ORDER BY RAND() LIMIT ?", "i", [$size]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 通过分类获取随机的书籍
     * @param int $size 书籍数量
     * @param int $category 书籍分类
     * @return array 书籍信息
     */
    public function randomBooksByCategory(int $size, int $category): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_books` WHERE `category` = ? ORDER BY RAND() LIMIT ?", "ii", [$category, $size]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 通过标题模糊搜索书籍
     * @param string $title 书籍标题
     * @return array 书籍信息
     */
    public function searchBook(string $title): array
    {
        $result = $this->executeQuery("SELECT * FROM neon_books WHERE title LIKE ?", "s", ["%$title%"]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 通过书籍 ID 获取书籍信息
     * @param int $id 书籍 ID
     * @return array 书籍信息
     */
    public function getBookInfo(int $id): array
    {
        $result = $this->executeQuery("SELECT * FROM neon_books WHERE id = ?", "i", [$id]);
        $response = [];
        if ($result->num_rows != 0)
            $response = $result->fetch_assoc();
        return $response;
    }

    /**
     * 通过书籍 ID 获取所有书籍章节
     * @param int $id 书籍 ID
     * @return array 书籍章节
     */
    public function getBookChapters(int $id): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_chapters` WHERE `belong_id` = ? ORDER BY `id` ASC", "i", [$id]);
        $chapters = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $chapters[] = $row;
        return $chapters;
    }

    /**
     * 通过章节 ID 获取章节信息
     * @param int $id 章节 ID
     * @return array 章节信息
     */
    public function getChapterInfo(int $id): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_chapters` WHERE `id` = ?", "i", [$id]);
        $response = [];
        if ($result->num_rows != 0)
            $response = $result->fetch_assoc();
        return $response;
    }

    /**
     * 更新书籍信息
     * @param int $id 书籍 ID
     * @param string $title 书籍标题
     * @param string $cover 书籍封面 URL
     * @param string $author 书籍作者
     * @param string $description 书籍简介
     * @param int $category 书籍分类
     * @param int $serial 连载状态
     * @return void
     */
    public function updateBook(int $id, string $title, string $cover, string $author, string $description, int $category, int $serial): void
    {
        $this->executeQuery("UPDATE `neon_books` SET `title` = ?, `cover` = ?, `author` = ?, `description` = ?, `category` = ?, `serial` = ? WHERE `id` = ?", "ssssiii", [$title, $cover, $author, $description, $category, $serial, $id]);
    }

    /**
     * 添加新的书籍
     * @param string $title 书籍标题
     * @param string $cover 书籍封面 URL
     * @param string $author 书籍作者
     * @param string $description 书籍简介
     * @param int $category 书籍分类
     * @param int $serial 连载状态
     * @return int|string 新的书籍 ID
     */
    public function createBook(string $title, string $cover, string $author, string $description, int $category, int $serial): int
    {
        $this->executeQuery("INSERT INTO `neon_books` (`title`, `cover`, `author`, `description`, `category`, `serial`) VALUES (?, ?, ?, ?, ?, ?)", "ssssii", [$title, $cover, $author, $description, $category, $serial]);
        return $this->connection->insert_id;
    }

    /**
     * 删除书籍
     * @param int $id 书籍 ID
     * @return void
     */
    public function deleteBook(int $id): void
    {
        $this->executeQuery("DELETE FROM `neon_books` WHERE `id` = ?", "i", [$id]);
        $this->executeQuery("DELETE FROM `neon_chapters` WHERE `belong_id` = ?", "i", [$id]);
    }

    /**
     * 阅读量 +1
     * @param int $id 书籍 ID
     */
    public function read(int $id): void
    {
        $this->executeQuery("UPDATE `neon_books` SET `view` = `view` + 1 WHERE `id` = ?", "i", [$id]);
    }

    /**
     * 获取总阅读量
     * @return int 阅读量
     */
    public function readers(): int
    {
        $result = $this->executeQuery("SELECT SUM(`view`) AS `readers` FROM `neon_books` WHERE 1 = ?", "i", [1]);
        return $result->fetch_assoc()["readers"] ?? 0;
    }

    /**
     * 获取总书籍数量
     * @return int 书籍数量
     */
    public function books(): int
    {
        $result = $this->executeQuery("SELECT COUNT(*) AS `books` FROM `neon_books` WHERE 1 = ?", "i", [1]);
        return $result->fetch_assoc()["books"];
    }

    /**
     * 获取所有书籍
     * @return array 书籍信息
     */
    public function getAllBooks(): array
    {
        $result = $this->executeQuery("SELECT * FROM `neon_books` WHERE 1 = ?", "i", [1]);
        $books = [];
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc())
                $books[] = $row;
        return $books;
    }

    /**
     * 获取总章节数量
     * @return int 章节数量
     */
    public function chapters(): int
    {
        $result = $this->executeQuery("SELECT COUNT(*) AS `chapters` FROM `neon_chapters` WHERE 1 = ?", "i", [1]);
        return $result->fetch_assoc()["chapters"];
    }

    /**
     * 数据库析构函数
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}