document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('nav-toggle');
    var mobileNav = document.getElementById('mobile-nav');

    if (!toggle || !mobileNav) return;

    // Start hidden
    mobileNav.style.display = 'none';

    toggle.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var isOpen = mobileNav.style.display === 'block';
        mobileNav.style.display = isOpen ? 'none' : 'block';
        // Animate the hamburger bars
        toggle.classList.toggle('is-open', !isOpen);
    });

    // Close menu if user clicks anywhere outside of it
    document.addEventListener('click', function (e) {
        if (!toggle.contains(e.target) && !mobileNav.contains(e.target)) {
            mobileNav.style.display = 'none';
            toggle.classList.remove('is-open');
        }
    });

    // Close menu when a link inside it is clicked
    var navLinks = mobileNav.querySelectorAll('a');
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            mobileNav.style.display = 'none';
            toggle.classList.remove('is-open');
        });
    });
});
