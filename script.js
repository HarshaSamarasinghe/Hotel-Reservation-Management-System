// Menu Toggle
let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
};

window.onscroll = () => {
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');
};

// Swipers
new Swiper(".home-slider", {
  grabCursor: true,
  loop: true,
  centeredSlides: true,
  autoplay: { delay: 10000, disableOnInteraction: false },
  navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" }
});

new Swiper(".room-slider", {
  spaceBetween: 20,
  grabCursor: true,
  loop: true,
  centeredSlides: true,
  autoplay: { delay: 7500, disableOnInteraction: false },
  pagination: { el: ".swiper-pagination", clickable: true },
  breakpoints: {
    0: { slidesPerView: 1 },
    768: { slidesPerView: 2 },
    991: { slidesPerView: 3 }
  }
});

new Swiper(".gallery-slider", {
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  centeredSlides: true,
  autoplay: { delay: 1500, disableOnInteraction: false },
  pagination: { el: ".swiper-pagination", clickable: true },
  breakpoints: {
    0: { slidesPerView: 1 },
    768: { slidesPerView: 3 },
    991: { slidesPerView: 4 }
  }
});

new Swiper(".review-slider", {
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  centeredSlides: true,
  autoplay: { delay: 7500, disableOnInteraction: false },
  pagination: { el: ".swiper-pagination", clickable: true }
});

// Slide Animation Observer
const slides = document.querySelectorAll('.swiper-slide');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    const content = entry.target.querySelector('.content');
    const items = content?.querySelectorAll('.fade-item') || [];
    if (entry.isIntersecting) {
      content?.classList.add('active');
      items.forEach((item, i) => item.style.transitionDelay = `${i * 0.6}s`);
    } else {
      content?.classList.remove('active');
      items.forEach(item => item.style.transitionDelay = '0s');
    }
  });
}, { threshold: 0.5 });
slides.forEach(slide => observer.observe(slide));

// Login/Register Toggle
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

if (registerBtn && loginBtn && container) {
  registerBtn.addEventListener('click', () => container.classList.add("active"));
  loginBtn.addEventListener('click', () => container.classList.remove("active"));
}

// Gallery Popup Logic
const plusIcons = document.querySelectorAll('.gallery .slide .icon');
const popup = document.querySelector('.popup-image');
const popupImg = popup?.querySelector('img');
const closeBtn = popup?.querySelector('.close-btn');
const prevBtn = popup?.querySelector('.prev-btn');
const nextBtn = popup?.querySelector('.next-btn');
const imageCount = popup?.querySelector('.image-count');
let currentImageIndex = 0;

function updateImageCount() {
  const total = document.querySelectorAll('.gallery .slide').length;
  imageCount.textContent = `${currentImageIndex + 1} / ${total}`;
}

function showImage(index) {
  const slides = document.querySelectorAll('.gallery .slide');
  currentImageIndex = index;
  const src = slides[index].querySelector('img').getAttribute('src');
  popupImg.src = src;
  updateImageCount();
}

plusIcons.forEach((icon, i) => {
  icon.onclick = e => {
    e.stopPropagation();
    popup.style.display = 'block';
    showImage(i);
  };
});

closeBtn.onclick = () => popup.style.display = 'none';
prevBtn.onclick = e => {
  e.stopPropagation();
  const total = document.querySelectorAll('.gallery .slide').length;
  currentImageIndex = (currentImageIndex - 1 + total) % total;
  showImage(currentImageIndex);
};
nextBtn.onclick = e => {
  e.stopPropagation();
  const total = document.querySelectorAll('.gallery .slide').length;
  currentImageIndex = (currentImageIndex + 1) % total;
  showImage(currentImageIndex);
};
popup.onclick = e => { if (e.target === popup) popup.style.display = 'none'; };

document.addEventListener('keydown', e => {
  if (popup.style.display === 'block') {
    if (e.key === 'ArrowLeft') prevBtn.click();
    else if (e.key === 'ArrowRight') nextBtn.click();
    else if (e.key === 'Escape') popup.style.display = 'none';
  }
});

// Intersection Animations
function setupAnimation(sectionSelector, itemSelector) {
  const section = document.querySelector(sectionSelector);
  const items = document.querySelectorAll(itemSelector);
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        items.forEach(item => item.classList.add('animate'));
        observer.disconnect();
      }
    });
  }, { threshold: 0.2 });
  if (section) observer.observe(section);
}

document.addEventListener('DOMContentLoaded', () => {
  setupAnimation('.about .row .content .philosophy', '.philosophy-item');
  setupAnimation('.services .box-container', '.services .box-container .box');
  setupAnimation('.faqs .row .content', '.faqs .row .content .box');

  document.querySelectorAll('.faqs .content .box h3').forEach(header => {
    header.addEventListener('click', () => {
      const box = header.parentElement;
      const wasActive = box.classList.contains('active');
      document.querySelectorAll('.faqs .content .box').forEach(b => b.classList.remove('active'));
      if (!wasActive) box.classList.add('active');
    });
  });
});


