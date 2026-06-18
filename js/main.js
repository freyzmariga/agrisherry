// Agrisherry - Main JS

document.addEventListener('DOMContentLoaded', function () {

    // ---- Navbar scroll effect ----
    const navbar = document.getElementById('mainNav');
    if (navbar) {
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });
    }

    // ---- Mobile nav toggle ----
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('open');
            navToggle.classList.toggle('open');
        });
        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('open');
            }
        });
        // Close on nav link click
        navMenu.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => navMenu.classList.remove('open'));
        });
    }

    // ---- Hero Slider ----
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let currentSlide = 0;
    let slideInterval;

    function goToSlide(n) {
        slides[currentSlide].classList.remove('active');
        dots[currentSlide]?.classList.remove('active');
        currentSlide = (n + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
        dots[currentSlide]?.classList.add('active');
    }

    function startSlider() {
        slideInterval = setInterval(() => goToSlide(currentSlide + 1), 5000);
    }

    if (slides.length > 0) {
        slides[0].classList.add('active');
        dots[0]?.classList.add('active');
        startSlider();

        document.querySelector('.hero-arrow.prev')?.addEventListener('click', () => {
            clearInterval(slideInterval);
            goToSlide(currentSlide - 1);
            startSlider();
        });
        document.querySelector('.hero-arrow.next')?.addEventListener('click', () => {
            clearInterval(slideInterval);
            goToSlide(currentSlide + 1);
            startSlider();
        });
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(slideInterval);
                goToSlide(i);
                startSlider();
            });
        });
    }

    // ---- Back to Top ----
    const backBtn = document.getElementById('backToTop');
    if (backBtn) {
        window.addEventListener('scroll', () => {
            backBtn.classList.toggle('visible', window.scrollY > 400);
        });
        backBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ---- Fade-in on scroll ----
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

    // ---- Counter Animation (stats) ----
    const counters = document.querySelectorAll('[data-count]');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-count'));
                const suffix = entry.target.getAttribute('data-suffix') || '';
                let count = 0;
                const step = Math.ceil(target / 60);
                const timer = setInterval(() => {
                    count = Math.min(count + step, target);
                    entry.target.textContent = count + suffix;
                    if (count >= target) clearInterval(timer);
                }, 25);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => counterObserver.observe(c));

    // ---- Shop: Live Search Filter ----
    const searchInput = document.getElementById('shopSearch');
    const productCards = document.querySelectorAll('.product-card[data-name]');
    const priceRows = document.querySelectorAll('.price-row[data-name]');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let visible = 0;
            productCards.forEach(card => {
                const match = card.getAttribute('data-name').toLowerCase().includes(q) ||
                              card.getAttribute('data-category').toLowerCase().includes(q);
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            priceRows.forEach(row => {
                const match = row.getAttribute('data-name').toLowerCase().includes(q);
                row.style.display = match ? '' : 'none';
            });
            const resultEl = document.getElementById('shopResultCount');
            if (resultEl) resultEl.textContent = visible + ' seedling' + (visible !== 1 ? 's' : '') + ' found';
        });
    }

    // ---- Price Range Filter ----
    const priceSlider = document.getElementById('priceRange');
    const priceDisplay = document.getElementById('priceDisplay');
    if (priceSlider) {
        priceSlider.addEventListener('input', function () {
            const max = parseInt(this.value);
            priceDisplay.textContent = 'Ksh ' + max.toLocaleString();
            productCards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price') || '0');
                card.style.display = price <= max ? '' : 'none';
            });
            priceRows.forEach(row => {
                const price = parseInt(row.getAttribute('data-price') || '0');
                row.style.display = price <= max ? '' : 'none';
            });
        });
    }

    // ---- Form validation feedback ----
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            const name = document.getElementById('name')?.value.trim();
            const message = document.getElementById('message')?.value.trim();
            if (!name || !message) {
                e.preventDefault();
                alert('Please fill in your name and message.');
            }
        });
    }

    // ---- Smooth anchor scroll ----
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

});
