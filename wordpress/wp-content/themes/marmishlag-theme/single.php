<?php

$duration = get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0];
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

        <p>
            La durée : (convertir en hh/mm/ss) <?= $duration ?> min
        </p>

        <h2>
            Ingrédients
        </h2>

        <div>
            <?php
            if (get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0]) {
                foreach (get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0] as $ingredient):
                    ?>
                    <div>
                        <p><strong><?= $ingredient['quantity'] . $ingredient['unit']?></strong> <?= $ingredient['ingredient'] ?></p>
                    </div>

                <?php endforeach;
            }
            ?>
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
