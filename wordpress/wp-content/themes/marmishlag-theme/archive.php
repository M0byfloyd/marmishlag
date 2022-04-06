<?php
$categories = get_categories();
get_header();

?>
</div>
<div class="box box-recette">
    <div class="container">
        <div class="box-content full">
            <h1 class="box-title">Résultats (lorem)</h1>
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
    <select name="type" form="searchForm">
        <option value="">TYPE DE PLAT</option>
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

    <select name="time" form="searchForm">
        <option value="">TEMPS</option>
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

    <select name="diet" form="searchForm">
        <option value="">RÉGIME</option>
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

    <select name="cost" form="searchForm">
        <option value="">COÛT</option>
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
</div>

<div class="search-results">
    <?php
    if (have_posts()) :
        while ( have_posts()) :
        the_post();
        get_template_part('templates/recipe/recipe');
        endwhile;
    else :
    ?>
    <p>Sorry no posts matched your criteria.</p>
    <?php
    endif;
    ?>
</div>


<?php get_footer(); ?>
