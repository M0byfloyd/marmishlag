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
<div class="container">
<?php /* get_search_form() */ ?>

<label>
    <select name="cat" form="searchForm">
        <option value="">TYPE DE PLAT</option>
        <?php
        if ($categories) {
            foreach ($categories as $category):?>

            <option value="<?= $category->term_id ?>"> <?= $category->name ?> </option>
        <?php
            endforeach;
        }

        ?>
    </select>
</label>

<?php
if (have_posts()) :
    while ( have_posts()) : the_post();
?>
    <h3><?= the_title() ?></h3>
    <?php
    endwhile;

else :
?>
<p>Sorry no posts matched your criteria.</p>
<?php
endif;
?>


<?php get_footer(); ?>
