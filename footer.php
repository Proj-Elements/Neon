<?php
function footerBuilder(): void
{
    echo <<<HTML
<div class="ui vertical segment" style="border: none;">
    <div class="ui center aligned container">
        <div>©2024-2025 <a href="https://space.bilibili.com/598656355">墨殇MournInk</a>。保留所有权利。</div>
        <div style="color: #C7C7C7; font-family: Consolas;"><a href="https://github.com/Proj-Elements/Neon">Neon</a> Powered by <a href="https://github.com/MournInk">MournInk</a></div>
    </div>
</div>
<script src="/resource/script.js"></script>
</body>
</html>
HTML;
}