<?php
require_once './config/category.php';
function headerBuilder(string $title, string $description = "笔趣阁", string $keywords = "小说,免费小说,笔趣阁,在线读,免费读"): void
{
    global $category;
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="$keywords" />
    <meta name="description" content="$description" />
    <link rel="stylesheet" type="text/css" href="/resource/semantic/semantic.min.css" />
    <link rel="stylesheet" type="text/css" href="/resource/style.css" />
    <script src="/resource/jquery.min.js"></script>
    <script src="/resource/semantic/semantic.min.js"></script>
    <title>$title</title>
</head>
<body>
<div class="ui borderless top fixed menu">
    <div class="ui container">
        <div class="item">
            <h2>新笔趣阁</h2>
        </div>
        <a class="item" href="/">首页</a>
        <div class="ui simple dropdown item">
            分类
            <i class="dropdown icon"></i>
            <div class="menu">
HTML;
    for ($i = 1; $i < count($category); $i++) {
        echo '<a class="item" href="/category/' . $i . '">' . $category[$i] . '</a>';
    }
    echo <<<HTML
            </div>
        </div>
        <a class="item">排行榜</a>
        <div class="item right">
            <div class="ui category search item">
                <div class="ui transparent icon input">
                    <input class="prompt" type="text" placeholder="搜索书名" id="search">
                    <i class="search link icon" id="search_btn"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
    </div>
</div>

HTML;
}
