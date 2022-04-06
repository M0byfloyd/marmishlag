<?php
/*
    Plugin Name: Marmi-Plug
*/

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('marmiplug-css', '/wp-content/plugins/marmiplug/assets/style/index.css');
});

require_once __DIR__ . '/Ustensils.php';
$recipes = new Ustensils();

require_once __DIR__ . '/Difficulty.php';
$difficulty = new Difficulty();

require_once __DIR__ . '/Ingredients.php';
$ingredients = new Ingredients();

require_once __DIR__ . '/Duration.php';
$ingredients = new Duration();

