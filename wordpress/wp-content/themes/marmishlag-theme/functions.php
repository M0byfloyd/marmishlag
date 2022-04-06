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
    wp_enqueue_script('marmishlag-theme-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', [], false, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/custom-scripts/script.js');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
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


function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="single__opinion"><?php
    } ?>
        <div class="single__opinion-text">
            <?php comment_text(); ?>
        </div>
        <div class="single__opinion-author">
            @<?php 
                    printf( get_comment_author_link() );
            ?>
        </div>
        <?php 
            if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
        } ?>
        <?php 
    if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}




require_once __DIR__ . '/classes/Pagination.php';
$pagination = new Pagination();

require_once __DIR__ . '/classes/Sponsobox.php';
$sponso = new Sponsobox('wphetic_sponso');

require_once __DIR__ . '/classes/Recipes.php';
$recipes = new Recipes();

require_once __DIR__ . '/classes/Roles.php';
$recipes = new Roles();

