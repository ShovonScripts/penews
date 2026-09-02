import './bootstrap';
import './custom-editor';

// Scroll reveal
document.addEventListener('DOMContentLoaded', function() {
    if (!window.IntersectionObserver) return;
    var revealEls = document.querySelectorAll('.reveal');
    if (!revealEls.length) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(function(el) { observer.observe(el); });
});

// Scroll-to-top FAB
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('scrollTop');
    if (!btn) return;
    window.addEventListener('scroll', function() {
        btn.classList.toggle('opacity-0', window.scrollY < 400);
        btn.classList.toggle('pointer-events-none', window.scrollY < 400);
    }, { passive: true });
    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
