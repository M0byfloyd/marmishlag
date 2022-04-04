<?php get_header(); ?>


<h2>Toutes nos recettes</h2>

<?php
if (have_posts()) :
    while ( have_posts() && $count < 3 ) : the_post();
?>
    <h3><?= the_title() ?></h3>
    <?php
    $count++;
    endwhile;

else :
?>
<p>Sorry no posts matched your criteria.</p>
<?php
endif;
?>


<?php get_footer(); ?>
