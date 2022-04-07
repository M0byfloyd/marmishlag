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
            <h1 class="box-title"><?= get_option('blogdescription') ?></h1>
            <p class="box-text"><?= get_option('blogsubdescription') ?></p>
        </div>
        <form action="<?php esc_url(home_url('/')) ?>">
            <div class="full flex">
                    <input type="search" placeholder="Chercher un aliment, un plat, etc" class="input-text" name="s"
                           value="<?= get_search_query() ?>">

                <button type="submit" class="input-btn">Rechercher</button>
            </div>
        </form>
    </div>
</div>
<div class="container">


    <div id="categories" class="categories-list">
        <div class="marmishlag-drag-slider">
            <div class="categories-list">
                <?php
                    foreach ($categories as $category) {
                        get_template_part('templates/category/category', null, array('category' => $category));
                    }
                ?>
            </div>
        </div>
    </div>

    <div id="new_recipes">
        <div class="section-title">
            <h2>Recettes nouvellement publiées</h2>
            <a href="<?= get_post_type_archive_link('recipe') ?>">
                <span>Tout voir</span>
                <span>
                <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.422 0L9.40537 0.870625L14.7944 5.625H0.46875V6.875H14.7944L9.40537 11.6081L10.422 12.5L17.5315 6.25L10.422 0Z"
                          fill="#6C737F"/>
                </svg>
            </span>
            </a>
        </div>

        <div class="marmishlag-drag-slider">
            <div class="thumbnails-list">
                <?php
                    $args = array(
                        'post_type' => 'recipe',
                        'posts_per_page' => 3,
                    );

                    $my_query = new WP_Query($args);

                    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();

                        get_template_part('templates/recipe/thumbnail');
                    endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>

<div id="newsletter">
    <?php 
        get_template_part('templates/newsletter/newsletter', null, array('category'=>$category));
    ?>
</div>

<div id="best_cuisto">
    <div class="section-title">
        <h2>Les meilleurs cuisiniers</h2>
    </div>

    <div class="marmishlag-drag-slider">
        <div class="cuisiniers-list">
            <?php
            if ($userList) {
                foreach ($userList as $user):
                    get_template_part('templates/recipe/cooker', null, array('cooker' => $user));
                endforeach;
            }
            ?>
        </div>
    </div>
</div>

    <?php get_footer(); ?>
