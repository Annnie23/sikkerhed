<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <nav>
            <!-- Burger Menu Button -->
            <button class="burger-menu" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <!-- Navigation Menu -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'menu',
                'container' => false,
            ));
            ?>
        </nav>
    </header>


    <?php wp_footer(); ?>
    <script>
        // JavaScript to toggle the menu
        document.addEventListener('DOMContentLoaded', function () {
            const burgerMenu = document.querySelector('.burger-menu');
            const menu = document.querySelector('.menu');

            burgerMenu.addEventListener('click', function () {
                burgerMenu.classList.toggle('active');
                menu.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
