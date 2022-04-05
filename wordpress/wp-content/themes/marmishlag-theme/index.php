<?php
$categories = get_categories();
$userList = get_users();

if (isset($_GET['s']) && !empty($_GET['s'])) {
    wp_redirect('/recipe?s=' . $_GET['s']);
}
?>

<?php get_header(); ?>

<form action="<?php esc_url(home_url('/')) ?>">
    <label>
        <input type="search" placeholder="Chercher" name="s" value="<?= get_search_query() ?>">
    </label>

    <button type="submit">Chercher</button>
</form>

<?php
foreach ( $categories as $category ) {?>
    <span><?= $category->name ?></span>
    <?php
}
?>
<h2>Recettes les plus appréciées</h2>

<h2>Recettes nouvellement publiées</h2>
<a href="<?= get_post_type_archive_link('recipe') ?>">Tout voir</a>

<?php
$args = array(
    'post_type' => 'recipe',
    'posts_per_page' => 3,
);

$my_query = new WP_Query( $args );

if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();

    the_title();
    the_content();
    the_post_thumbnail();

endwhile;
endif;
wp_reset_postdata();
?>


<h2>Les meilleurs cuisiniers</h2>

<?php
    if ($userList) {
        foreach ($userList as $user):
            ?>

            <p>
                <?= $user->display_name ?>
            </p>

<?php
endforeach;
    }
?>

<?php get_footer(); ?>
