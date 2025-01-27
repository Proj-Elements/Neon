<?php
require_once 'config/category.php';
function headerBuilder(string $title, string $description = "笔趣阁", string $keywords = "小说,免费小说,笔趣阁,在线读,免费读"): void
{
    global $categories;
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="$keywords" />
    <meta name="description" content="$description" />
    <link rel="stylesheet" type="text/css" href="/resource/semantic/semantic.min.css" />
    <link rel="stylesheet" type="text/css" href="/resource/style.css" />
    <link rel="icon" href="/favicon.png">
    <script src="/resource/jquery.min.js"></script>
    <script src="/resource/jquery.cookie.min.js"></script>
    <script src="/resource/semantic/semantic.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex/dist/contrib/auto-render.min.js"
            onload="renderMathInElement(document.body);"></script>

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
    for ($i = 1; $i < count($categories); $i++) {
        echo '<a class="item" href="/category/' . $i . '">' . $categories[$i] . '</a>';
    }
    echo <<<HTML
            </div>
        </div>
        <a class="item" href="/rank">排行榜</a>
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
