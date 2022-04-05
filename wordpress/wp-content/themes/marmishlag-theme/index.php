<?php
$categories = get_categories();
$userList = get_users();
?>

<?php get_header(); ?>

<form action="<?php esc_url(home_url('/')) ?>">
    <input type="search" placeholder="Chercher" name="s" value="<?= get_search_query() ?>">

    <button type="submit">Chercher</button>
</form>

<div id="categories" class="categories-list">
    <?php
    foreach ( $categories as $category ) {
        get_template_part('templates/recipe/category', null, array('category'=>$category));
        get_template_part('templates/recipe/category', null, array('category'=>$category));
    }
    ?>
</div>

<div id="best_recipes">
    <div class="section-title">
        <h2>Recettes les plus appréciées</h2> 
        <a href="<?= get_post_type_archive_link('recipe') ?>">
            <span>Tout voir</span>
            <span>
                <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.422 0L9.40537 0.870625L14.7944 5.625H0.46875V6.875H14.7944L9.40537 11.6081L10.422 12.5L17.5315 6.25L10.422 0Z" fill="#6C737F"/>
                </svg>
            </span>
        </a>
    </div>

    <div class="thumbnails-list">
        <?php get_template_part('templates/recipe/thumbnail'); ?>
        <?php get_template_part('templates/recipe/thumbnail'); ?>
    </div>
</div>

<div id="new_recipes">
    <div class="section-title">
        <h2>Recettes nouvellement publiées</h2> 
        <a href="<?= get_post_type_archive_link('recipe') ?>">
            <span>Tout voir</span>
            <span>
                <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.422 0L9.40537 0.870625L14.7944 5.625H0.46875V6.875H14.7944L9.40537 11.6081L10.422 12.5L17.5315 6.25L10.422 0Z" fill="#6C737F"/>
                </svg>
            </span>
        </a>
    </div>

    <div class="thumbnails-list">
        <?php get_template_part('templates/recipe/thumbnail'); ?>
        <?php get_template_part('templates/recipe/thumbnail'); ?>
    </div>
</div>

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

<div id="newsletter">
    <?php 
    get_template_part('templates/recipe/newsletter', null, array('category'=>$category));
    ?>
</div>
<div id="best_cuisto">
    <div class="section-title">
        <h2>Les meilleurs cuisiniers</h2>
    </div>
    <div class="cuisiniers-list">
        <?php
        if ($userList) {
            foreach ($userList as $user):
                get_template_part('templates/recipe/cuisinier', null, array('cuisinier'=>$user->display_name));
                get_template_part('templates/recipe/cuisinier', null, array('cuisinier'=>$user->display_name));
            endforeach;
        }
        ?>
    </div>
</div>



<?php get_footer(); ?>
