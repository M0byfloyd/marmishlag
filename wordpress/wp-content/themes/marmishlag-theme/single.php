<?php

$comments = get_comments();
get_header();
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>

        <div>
            <img src="<?php the_post_thumbnail_url(); ?>" alt="...">
            <div>
                <h5><?php the_title(); ?></h5>
                <p><?php the_content(); ?></p>
                <p><small><?php the_date(); ?></small></p>
            </div>
        </div>

    <div>
        <h2>Avis de la communauté</h2>
        <?php
        comments_template();

        ?>
    </div>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
