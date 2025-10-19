// assets/js/script.js

document.addEventListener('DOMContentLoaded', function() {
    // Toggle Menu for Mobile
    const toggleBtn = document.querySelector('.toggle-menu');
    const navMenu = document.querySelector('.nav-menu');
    
    if(toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            
            // Change icon based on menu state
            if(navMenu.classList.contains('active')) {
                toggleBtn.innerHTML = '<i class="fas fa-times"></i>';
            } else {
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    }
    
    // Mobile Submenu Toggle
    const dropdownItems = document.querySelectorAll('.dropdown');
    
    dropdownItems.forEach(item => {
        const link = item.querySelector('a');
        
        // Create dropdown toggle button for mobile
        const toggleDropdown = document.createElement('span');
        toggleDropdown.className = 'dropdown-toggle';
        toggleDropdown.innerHTML = '<i class="fas fa-chevron-down"></i>';
        
        // Only append to first level menu items in mobile view
        if(window.innerWidth <= 992) {
            link.appendChild(toggleDropdown);
        }
        
        // Toggle submenu on click
        toggleDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdownContent = item.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('show');
            
            // Change icon based on dropdown state
            if(dropdownContent.classList.contains('show')) {
                toggleDropdown.innerHTML = '<i class="fas fa-chevron-up"></i>';
            } else {
                toggleDropdown.innerHTML = '<i class="fas fa-chevron-down"></i>';
            }
        });
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if(window.innerWidth > 992) {
            // Reset mobile menu when screen size changes
            if(navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
            
            // Remove dropdown toggles from desktop view
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.remove();
            });
        } else {
            // Add dropdown toggles to mobile view if they don't exist
            dropdownItems.forEach(item => {
                const link = item.querySelector('a');
                if(!link.querySelector('.dropdown-toggle')) {
                    const toggleDropdown = document.createElement('span');
                    toggleDropdown.className = 'dropdown-toggle';
                    toggleDropdown.innerHTML = '<i class="fas fa-chevron-down"></i>';
                    link.appendChild(toggleDropdown);
                    
                    toggleDropdown.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const dropdownContent = item.querySelector('.dropdown-content');
                        dropdownContent.classList.toggle('show');
                        
                        if(dropdownContent.classList.contains('show')) {
                            toggleDropdown.innerHTML = '<i class="fas fa-chevron-up"></i>';
                        } else {
                            toggleDropdown.innerHTML = '<i class="fas fa-chevron-down"></i>';
                        }
                    });
                }
            });
        }
    });
    
    // Back to Top Button
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if(backToTopBtn) {
        window.addEventListener('scroll', function() {
            if(window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Image Slider for Gallery (if needed)
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    if(galleryItems.length > 0) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                // You can implement a lightbox or redirect to detail page
                const link = item.getAttribute('data-link');
                if(link) {
                    window.location.href = link;
                }
            });
        });
    }
    
    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if(href !== '#' && href.startsWith('#')) {
                e.preventDefault();
                
                const targetElement = document.querySelector(href);
                if(targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if(navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            }
        });
    });
});

let currentIndex = 0;
const track = document.querySelector('.carousel-track');
const slides = document.querySelectorAll('.carousel-slide');
const nextBtn = document.querySelector('.carousel-next');
const prevBtn = document.querySelector('.carousel-prev');

function updateSlidePosition() {
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
}

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlidePosition();
});

prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlidePosition();
});

// Auto slide
setInterval(() => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlidePosition();
}, 5000);

// Initial
updateSlidePosition();


