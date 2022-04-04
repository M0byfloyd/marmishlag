<?php

add_action('after_setup_theme',
    function () {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        add_theme_support('menus');
        register_nav_menu('custom_header', "C'est le menu dans le header");
    });

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('marmishlag-theme-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('footer', get_template_directory_uri() . '/custom-styles/footer.css');
    wp_enqueue_script('script', get_template_directory_uri() . '/custom-scripts/script.js');
    wp_enqueue_script('marmishlag-theme-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', [], false, true);
});

add_filter('login_headerurl',
    function ($header_url) {
        return 'https://www.google.fr';
    });

add_filter('nav_menu_css_class', function ($classes) {
    $classes[] = 'nav-item';
    return $classes;
});

add_filter('nav_menu_link_attributes', function ($atts) {
    $atts['class'] = "nav-link";
    return $atts;
});

require_once __DIR__ . '/classes/Pagination.php';
$pagination = new Pagination();

require_once __DIR__ . '/classes/Sponsobox.php';
$sponso = new Sponsobox('wphetic_sponso');

require_once __DIR__ . '/classes/Recipes.php';
$recipes = new Recipes();
