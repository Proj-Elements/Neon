// Enhanced search functionality with better UX
function search(text) {
    if (!text.trim()) {
        showNotification('请输入搜索关键词', 'warning');
        return;
    }
    
    // Show loading state
    const searchBtn = document.getElementById('search_btn');
    const searchInput = document.getElementById('search');
    
    searchBtn.classList.add('loading');
    searchInput.disabled = true;
    
    const encodedText = encodeURIComponent(text.trim());
    
    // Simulate a small delay for better UX
    setTimeout(() => {
        window.location.href = `/search/${encodedText}`;
    }, 300);
}

// Enhanced notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.ui.message.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `ui ${type} message notification`;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease-out;
        box-shadow: var(--shadow-heavy);
    `;
    
    notification.innerHTML = `
        <i class="close icon"></i>
        <div class="header">${message}</div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
    
    // Allow manual close
    notification.querySelector('.close.icon').addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    });
}

// Enhanced keyboard navigation
function initKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K for quick search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.getElementById('search');
            searchInput.focus();
            searchInput.select();
            showNotification('快捷搜索已激活', 'info');
        }
        
        // Esc to clear search
        if (e.key === 'Escape') {
            const searchInput = document.getElementById('search');
            if (document.activeElement === searchInput) {
                searchInput.blur();
                searchInput.value = '';
            }
        }
    });
}

// Enhanced table interactions
function initTableEnhancements() {
    // Add click-to-navigate functionality for table rows
    const tableRows = document.querySelectorAll('table.ui.table tbody tr');
    tableRows.forEach(row => {
        const firstLink = row.querySelector('a');
        if (firstLink) {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function(e) {
                // Don't navigate if clicking on a specific link
                if (e.target.tagName !== 'A') {
                    window.location.href = firstLink.href;
                }
            });
        }
    });
}

// Enhanced loading states
function addLoadingStates() {
    // Add loading state to all navigation links
    const navLinks = document.querySelectorAll('a[href^="/"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (!this.hasAttribute('target') && !this.href.includes('#')) {
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';
            }
        });
    });
}

// Add CSS animations
function addAnimations() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse-animation {
            animation: pulse 0.5s ease-in-out;
        }
        
        /* Enhanced focus styles */
        *:focus {
            outline: 2px solid var(--accent-color) !important;
            outline-offset: 2px !important;
        }
        
        /* Smooth transitions for all interactive elements */
        a, button, input, .ui.button, .ui.menu .item {
            transition: var(--transition) !important;
        }
    `;
    document.head.appendChild(style);
}

// Initialize everything when DOM is ready
$(document).ready(function () {
    // Initialize search functionality
    $("#search").on('keypress', function (event) {
        if (event.which === 13) {
            const content = $(this).val();
            search(content);
        }
    });
    
    $("#search_btn").on("click", function () {
        const content = $("#search").val();
        search(content);
    });
    
    // Initialize enhancements
    initKeyboardNavigation();
    initTableEnhancements();
    addLoadingStates();
    addAnimations();
    
    // Add focus enhancement for search
    $("#search").on('focus', function() {
        $(this).addClass('pulse-animation');
        setTimeout(() => $(this).removeClass('pulse-animation'), 500);
    });
    
    // Add subtle animations on page load
    setTimeout(() => {
        $('.ui.table, .ui.segment, .ui.items').addClass('fade-in');
    }, 100);
    
    // Show keyboard shortcut hint on first visit
    if (!localStorage.getItem('keyboardHintShown')) {
        setTimeout(() => {
            showNotification('提示：按 Ctrl+K 快速搜索', 'info');
            localStorage.setItem('keyboardHintShown', 'true');
        }, 2000);
    }
});