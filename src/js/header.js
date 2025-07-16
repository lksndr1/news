document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('open-mobile-menu');
    const menuWrapper = document.querySelector('.mobile-wrapper');
    const closeButton = document.getElementById('close-mobile-menu');
    const overlay = document.getElementById('menu-overlay');
    const navLinks = document.querySelectorAll('.category-list a');

    function openMenu() {
        menuWrapper.classList.add('menu-visible');
        document.body.classList.add('body-scroll-lock');
        overlay.classList.add('overlay-visible');
    }

    function closeMenu() {
        menuWrapper.classList.remove('menu-visible');
        document.body.classList.remove('body-scroll-lock');
        overlay.classList.remove('overlay-visible');
    }

    toggleButton.addEventListener('click', openMenu);
    closeButton.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            closeMenu();
        });
    });
});

jQuery(document).ready(function ($) {
    $('.header__category-list li a').hover(
        function () {
            var cat_id = $(this).parent().attr('class').match(/cat-item-(\d+)/)[1];

            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_category_posts',
                    category_id: cat_id
                },
                success: function (response) {
                    $('.header__categories-preview').html(response);
                }
            });
        },
        function () {
            $('.header__categories-preview').empty();
        }
    );

    $('.header__categories').mouseleave(function () {
        $('.header__categories-preview').empty();
    });
});
