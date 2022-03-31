<?php get_header(); ?>

<h2>Les recettes marmishlag</h2>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <div>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
            <h3><?php the_title(); ?></h3>
            <div><?php the_content(); ?></div>
            <p><small><?php the_date(); ?></small></p>
            <a href="<?php the_permalink(); ?>">Voir la recette</a>
        </div>

    <?php endwhile; ?>
<?php endif; ?>

<?= marmishlagPagination(); ?>

<?php get_footer(); ?>
