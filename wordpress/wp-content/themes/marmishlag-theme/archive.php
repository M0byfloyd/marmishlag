<?php
$categories = get_categories();
get_header();

?>
</div>
<div class="box box-recette">
    <div class="container">
        <div class="box-content full">
            <h1 class="box-title">Résultats (<?= count($wp_query->posts) ?>)</h1>
        </div>
        <form action="<?php esc_url(home_url('/')) ?>">
            <div class="full flex">
                <input type="search" placeholder="Chercher un aliment, un plat, etc" class="input-text" name="s" value="<?= get_search_query() ?>">
                <button type="submit" class="input-btn">Rechercher</button>
            </div>
        </form>
    </div>
</div>
<div class="container-fluid">
<?php /* get_search_form() */ ?>

<div class="filters">
    <select name="category" form="searchForm">
        <option value="">CATÉGORIE DE PLAT</option>
            <?php
                if ($categories) {
                    foreach ($categories as $category):
            ?>
                    <option value="<?= $category->term_id ?>"> <?= $category->name ?> </option>
            <?php
                    endforeach;
                }
            ?>
    </select>

    <select name="difficulty" form="searchForm">
        <option value="">DIFFICULTÉ</option>
        <option value="easy">Facile</option>
        <option value="medium">Intermédiaire</option>
        <option value="hard">Difficile</option>
    </select>

    <select name="time" form="searchForm">
        <option value="">TEMPS</option>
        <option value="minus-fifteen">< 15 minutes</option>
        <option value="minus-thirty">< 30 minutes</option>
        <option value="minus-hour">< 1 heure</option>
        <option value="plus-hour">> 1 heure</option>
    </select>
</div>

<div class="search-results">
    <?php
    if (have_posts()) :
        while ( have_posts()) :
        the_post();?>
        <a href="<?= get_the_permalink() ?>">
            <?php
            get_template_part('templates/recipe/recipe');
            ?>
        </a>
        <?php
        endwhile;
    else :
    ?>
    <p>Sorry no posts matched your criteria.</p>
    <?php
    endif;
    ?>
</div>


<?php get_footer(); ?>
