/**
 * Newsify Masonry Layout JavaScript
 * Handles the resizing and animation of masonry layout items
 */

(function() {
    // Initialize once DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        initNewsifyMasonry();
    });

    // Re-initialize on window resize
    window.addEventListener('resize', debounce(function() {
        initNewsifyMasonry();
    }, 250));

    /**
     * Initialize the masonry layout
     */
    function initNewsifyMasonry() {
        const masonryContainers = document.querySelectorAll('.newsify-masonry-container');
        
        masonryContainers.forEach(container => {
            const items = container.querySelectorAll('.newsify-masonry-item');
            
            if (!items.length) return;
            
            // Reset any previously applied styles
            items.forEach(item => {
                item.style.gridRowEnd = '';
            });
            
            // Apply entrance animations with staggered delay
            items.forEach((item, index) => {
                // Add animation delay based on position
                item.style.animationDelay = `${index * 0.1}s`;
                
                // Get content height and apply the span
                resizeMasonryItem(item);
                
                // Add intersection observer for scroll animations
                createScrollObserver(item);
            });
        });
    }

    /**
     * Resize a masonry item based on its content
     */
    function resizeMasonryItem(item) {
        // Get the grid row height
        const rowHeight = parseInt(window.getComputedStyle(item.parentElement).gridAutoRows);
        const rowGap = parseInt(window.getComputedStyle(item.parentElement).gridRowGap) || 0;
        
        // Get content height including margins
        const content = item.querySelector('.newsify-masonry-card');
        if (!content) return;
        
        // Calculate appropriate height
        const contentHeight = content.getBoundingClientRect().height;
        
        // Calculate how many rows this item should span
        const rowSpan = Math.ceil((contentHeight + rowGap) / (rowHeight + rowGap));
        
        // Apply the height
        item.style.gridRowEnd = `span ${rowSpan}`;
    }

    /**
     * Create an Intersection Observer to handle scroll animations
     */
    function createScrollObserver(item) {
        // Skip if IntersectionObserver is not supported
        if (!('IntersectionObserver' in window)) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add class to trigger animations when scrolled into view
                    entry.target.classList.add('newsify-visible');
                    // Unobserve once animation is triggered
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1 // Trigger when at least 10% is visible
        });
        
        observer.observe(item);
    }

    /**
     * Debounce function to limit function calls
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
})();
