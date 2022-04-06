<?php

$comments = get_comments();
get_header();
?>
<?php the_post(); ?>
<div class="single">
    <div class="row single__header"
         style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
        <h1 class="single__title"><?= the_title() ?></h1>
    </div>
    <div class="row">
        <div class="col">
            <?php do_action('marmiplug-duration'); ?>
        </div>
        <div class="col">
            <?php do_action('marmiplug-difficulty'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <?php do_action('marmiplug-ingredients'); ?>

            <?php do_action('marmiplug-ustensils'); ?>
        </div>

        <div class="col-8">

            <h2>Préparation</h2>

            <div>
                <?php the_content() ?>
            </div>
            <div>
                <h2>Avis de la communauté</h2>
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>
