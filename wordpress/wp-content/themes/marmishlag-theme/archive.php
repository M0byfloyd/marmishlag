<?php
$categories = get_categories();
get_header();

?>

<?php get_search_form() ?>

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
