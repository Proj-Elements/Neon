<?php
function footerBuilder(): void
{
    echo <<<HTML
<div class="ui vertical segment" style="border: none; background: var(--primary-gradient); margin-top: 4em; padding: 3em 0;">
    <div class="ui center aligned container">
        <div style="color: rgba(255, 255, 255, 0.9); font-size: 1.1em; margin-bottom: 1em;">
            ©2024-2025 <a href="https://space.bilibili.com/598656355" style="color: white; font-weight: 600; text-decoration: none;">墨殇MournInk</a>。保留所有权利。
        </div>
        <div style="color: rgba(255, 255, 255, 0.7); font-family: 'Consolas', monospace; font-size: 0.95em;">
            <a href="https://github.com/Proj-Elements/Neon" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-weight: 500;">✨ Neon</a> 
            Powered by 
            <a href="https://github.com/MournInk" style="color: rgba(255, 255, 255, 0.9); text-decoration: none; font-weight: 500;">MournInk</a>
        </div>
        <div style="margin-top: 2em; color: rgba(255, 255, 255, 0.6); font-size: 0.9em;">
            💖 为阅读而生，用心打造每一个细节
        </div>
    </div>
</div>
<script src="/resource/script.js"></script>
<script>
// Add smooth scrolling and enhanced interactions
$(document).ready(function() {
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // Add loading states for better UX
    $('form').on('submit', function() {
        $(this).find('button, input[type="submit"]').prop('disabled', true).addClass('loading');
    });
    
    // Initialize dropdowns with better animations
    $('.ui.dropdown').dropdown({
        transition: 'slide down',
        duration: 200
    });
    
    // Add subtle parallax effect to main content
    $(window).scroll(function() {
        var scrolled = $(window).scrollTop();
        var parallax = -(scrolled * 0.1);
        $('#main').css('transform', 'translateY(' + parallax + 'px)');
    });
});
</script>
</body>
</html>
HTML;
}