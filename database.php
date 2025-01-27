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
        $result = $this->executeQuery("SELECT * FROM `neon_articles` WHERE `belong_id` = ? ORDER BY `id` ASC", "i", [$id]);
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
        $result = $this->executeQuery("SELECT * FROM `neon_articles` WHERE `id` = ?", "i", [$id]);
        $response = [];
        if ($result->num_rows != 0)
            $response = $result->fetch_assoc();
        return $response;
    }

    /**
     * 数据库析构函数
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}