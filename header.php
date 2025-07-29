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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <style>
        /* Enhanced navigation styles */
        .ui.menu.top.fixed {
            background: var(--primary-gradient) !important;
            border: none !important;
            box-shadow: var(--shadow-medium) !important;
            backdrop-filter: blur(20px);
            z-index: 1000;
        }
        
        .ui.menu .item {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .ui.menu .item:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .ui.menu .item:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transform: translateY(-1px);
        }
        
        .ui.menu .item:hover:before {
            left: 100%;
        }
        
        .ui.menu .item h2 {
            color: white !important;
            margin: 0 !important;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced search styling */
        .ui.search .prompt {
            border-radius: 25px !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            background: rgba(255, 255, 255, 0.9) !important;
            padding: 0.8em 1.2em !important;
            transition: var(--transition);
            font-size: 0.95em;
        }
        
        .ui.search .prompt:focus {
            border-color: white !important;
            background: white !important;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3) !important;
            transform: scale(1.02);
        }
        
        .ui.search .search.icon {
            color: var(--primary-color) !important;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .ui.search .search.icon:hover {
            color: var(--accent-color) !important;
            transform: scale(1.1);
        }
        
        /* Dropdown enhancements */
        .ui.dropdown .menu {
            border-radius: var(--border-radius) !important;
            box-shadow: var(--shadow-heavy) !important;
            border: none !important;
            backdrop-filter: blur(10px);
        }
        
        .ui.dropdown .menu .item {
            color: var(--text-color) !important;
            transition: var(--transition);
        }
        
        .ui.dropdown .menu .item:hover {
            background: var(--primary-gradient) !important;
            color: white !important;
        }
        
        /* Mobile menu enhancements */
        @media (max-width: 768px) {
            .ui.menu .item {
                padding: 0.8em !important;
            }
            
            .ui.search .prompt {
                width: 200px !important;
            }
        }
    </style>
</head>
<body>
<div class="ui borderless top fixed menu">
    <div class="ui container">
        <div class="item">
            <h2>✨ 新笔趣阁</h2>
        </div>
        <a class="item" href="/">🏠 首页</a>
        <div class="ui simple dropdown item">
            📚 分类
            <i class="dropdown icon"></i>
            <div class="menu">
HTML;
    for ($i = 1; $i < count($categories); $i++) {
        echo '<a class="item" href="/category/' . $i . '">' . $categories[$i] . '</a>';
    }
    echo <<<HTML
            </div>
        </div>
        <a class="item" href="/rank">🏆 排行榜</a>
        <div class="item right">
            <div class="ui category search item">
                <div class="ui transparent icon input">
                    <input class="prompt" type="text" placeholder="🔍 搜索书名" id="search">
                    <i class="search link icon" id="search_btn"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
    </div>
</div>

HTML;
}
