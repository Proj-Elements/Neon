<?php
function checkLogin(): void
{
    session_start();
    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
        header('Location: /admin/login');
        exit;
    }
}

function headerBuilder(string $title): void
{
    global $categories;
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8" />
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
            <h2>新笔趣阁管理面板</h2>
        </div>
        <a class="item" href="/admin/board">
            <i class="home icon"></i>
            首页
        </a>
        <a class="item" href="/admin/books">
            <i class="book icon"></i>
            书籍管理
        </a>
        <a class="item" href="/admin/upload">
            <i class="cloud upload icon"></i>
            导入
        </a>
        <div class="right menu">
            <div class="item">
                <a class="ui primary button" href="/admin/create">
                    <i class="icon plus"></i>
                    新建书籍
                </a>
            </div>
            <div class="item">
                <a class="ui button" href="/admin/logout">
                    <i class="icon logout"></i>
                    登出
                </a>
            </div>
        </div>
    </div>
</div>

HTML;
}
