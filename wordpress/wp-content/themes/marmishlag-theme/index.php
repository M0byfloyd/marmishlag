<?php
$categories = get_categories();
$userList = get_users();

if (isset($_GET['s']) && !empty($_GET['s'])) {
    wp_redirect('/recipe?s=' . $_GET['s']);
}
?>

<?php get_header(); ?>
</div>
<div class="box box-homepage">
    <div class="container">
        <div class="box-content">
            <h1 class="box-title">Scelerisque praesent fringilla</h1>
            <p class="box-text">Tempus nisl purus tempor nunc ultricies mauris porta dolor. Risus arcu sapien amet mi dolor, sodales iaculis varius viverra. Posuere eget pulvinar pretium vitae, aliquet faucibus at.</p>
        </div>
        <form action="<?php esc_url(home_url('/')) ?>">
            <div class="full flex">
                <input type="search" placeholder="Chercher un aliment, un plat, etc" class="input-text" name="s" value="<?= get_search_query() ?>">
                <button type="submit" class="input-btn">Rechercher</button>
            </div>
        </form>
    </div>
</div>
<div class="container">



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
