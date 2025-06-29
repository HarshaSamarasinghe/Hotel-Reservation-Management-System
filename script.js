let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');


document.addEventListener("DOMContentLoaded", () => {
    // Toggle user dropdown
    const profileBox = document.querySelector('.profile-box');
    const avatarCircle = document.querySelector('.avatar-circle');

    if (avatarCircle && profileBox) {
        avatarCircle.addEventListener('click', () => {
            profileBox.classList.toggle('show');
        });
    }

});




// Login/Register Toggle
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

if (registerBtn && loginBtn && container) {
  registerBtn.addEventListener('click', () => container.classList.add("active"));
  loginBtn.addEventListener('click', () => container.classList.remove("active"));
}


menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

// Initialize Swiper
var swiper = new Swiper(".home-slider", {
    grabCursor: true,
    loop: true,
    centeredSlides: true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});


// Set up the intersection observer
const slides = document.querySelectorAll('.swiper-slide');

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        const slideContent = entry.target.querySelector('.content, .form-content');
        const fadeItems = slideContent.querySelectorAll('.fade-item');

        // Trigger animation if the slide is in view
        if (entry.isIntersecting) {
            slideContent.classList.add('active');  // This will trigger the animations for all .fade-item
            fadeItems.forEach((item, index) => {
                // Apply delay to each item for sequential animation
                item.style.transitionDelay = `${index * 0.6}s`;
            });
        } else {
            slideContent.classList.remove('active');
            fadeItems.forEach(item => {
                item.style.transitionDelay = '0s';  // Reset the delay when out of view
            });
        }
    });
}, {
    threshold: 0.5,  // Trigger when 50% of the slide is visible
});

// Observe each slide
slides.forEach(slide => {
    observer.observe(slide);
});

//About us

document.addEventListener('DOMContentLoaded', function() {
    // Select the philosophy section
    const philosophySection = document.querySelector('.about .row .content .philosophy');
    const philosophyItems = document.querySelectorAll('.philosophy-item');

    // Create an Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class to each item when section is visible
                philosophyItems.forEach(item => {
                    item.classList.add('animate');
                });
                // Disconnect the observer after triggering
                observer.disconnect();
            }
        });
    }, {
        // Options: trigger when 20% of the element is visible
        threshold: 0.2
    });

    // Start observing the philosophy section
    if (philosophySection) {
        observer.observe(philosophySection);
    }
});



var swiper = new Swiper(".room-slider", {
    spaceBetween: 20,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".gallery-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
    },
});

const plusIcons = document.querySelectorAll('.gallery .slide .icon');
const popup = document.querySelector('.popup-image');
const popupImg = popup.querySelector('img');
const closeBtn = popup.querySelector('.close-btn');
const prevBtn = popup.querySelector('.prev-btn');
const nextBtn = popup.querySelector('.next-btn');
const imageCount = popup.querySelector('.image-count');
let currentImageIndex = 0;

function updateImageCount() {
    const totalSlides = document.querySelectorAll('.gallery .slide').length;
    imageCount.textContent = `${currentImageIndex + 1} / ${totalSlides}`;
}

function showImage(index) {
    const allSlides = document.querySelectorAll('.gallery .slide');
    currentImageIndex = index;
    const imageSource = allSlides[index].querySelector('img').getAttribute('src');
    popupImg.src = imageSource;
    updateImageCount();
}

plusIcons.forEach((icon, index) => {
    icon.onclick = (e) => {
        e.stopPropagation();
        popup.style.display = 'block';
        showImage(index);
    }
});

closeBtn.onclick = () => {
    popup.style.display = 'none';
};

prevBtn.onclick = (e) => {
    e.stopPropagation();
    const totalSlides = document.querySelectorAll('.gallery .slide').length;
    currentImageIndex = (currentImageIndex - 1 + totalSlides) % totalSlides;
    showImage(currentImageIndex);
};

nextBtn.onclick = (e) => {
    e.stopPropagation();
    const totalSlides = document.querySelectorAll('.gallery .slide').length;
    currentImageIndex = (currentImageIndex + 1) % totalSlides;
    showImage(currentImageIndex);
};

popup.onclick = (e) => {
    if (e.target === popup) {
        popup.style.display = 'none';
    }
};

document.addEventListener('keydown', (e) => {
    if (popup.style.display === 'block') {
        if (e.key === 'ArrowLeft') {
            prevBtn.click();
        } else if (e.key === 'ArrowRight') {
            nextBtn.click();
        } else if (e.key === 'Escape') {
            popup.style.display = 'none';
        }
    }
});

var swiper = new Swiper(".review-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});



// services

document.addEventListener('DOMContentLoaded', function() {
    // Select the services container
    const servicesContainer = document.querySelector('.services .box-container');
    const serviceBoxes = document.querySelectorAll('.services .box-container .box');

    // Create an Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class to each box when section is visible
                serviceBoxes.forEach(box => {
                    box.classList.add('animate');
                });
                // Disconnect the observer after triggering
                observer.disconnect();
            }
        });
    }, {
        // Options: trigger when 20% of the element is visible
        threshold: 0.2
    });

    // Start observing the services container
    if (servicesContainer) {
        observer.observe(servicesContainer);
    }
});

// faqs
document.addEventListener('DOMContentLoaded', function() {
    // Select the FAQ content container and boxes
    const faqContent = document.querySelector('.faqs .row .content');
    const faqBoxes = document.querySelectorAll('.faqs .row .content .box');
    
    // Create an Intersection Observer for animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add animation class to each FAQ box when section is visible
                faqBoxes.forEach(box => {
                    box.classList.add('animate');
                });
                // Disconnect the observer after triggering
                observer.disconnect();
            }
        });
    }, {
        // Options: trigger when 20% of the element is visible
        threshold: 0.2
    });

    // Start observing the FAQ content container
    if (faqContent) {
        observer.observe(faqContent);
    }

    // Add click handlers for FAQ boxes
    document.querySelectorAll('.faqs .content .box h3').forEach(header => {
        header.addEventListener('click', () => {
            const box = header.parentElement;
            const wasActive = box.classList.contains('active');
            
            // Close all boxes
            document.querySelectorAll('.faqs .content .box').forEach(b => {
                b.classList.remove('active');
            });
            
            // Open clicked box if it wasn't active
            if (!wasActive) {
                box.classList.add('active');
            }
        });
    });
});