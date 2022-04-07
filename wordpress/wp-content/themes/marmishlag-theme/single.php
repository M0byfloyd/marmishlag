<?php

$comments = get_comments();
get_header();
?>
<?php the_post(); ?>
<div class="single">
    <div class="row single__header" style="background-image: url('<?= get_the_post_thumbnail_url() ?>')">
        <h1 class="single__header__title"><?= the_title() ?></h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="flex single__infos">
                <?php do_action('marmiplug-duration'); ?>
                <?php do_action('marmiplug-difficulty'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-4">
                <?php do_action('marmiplug-ingredients'); ?>

                <?php do_action('marmiplug-ustensils'); ?>
            </div>

            <div class="col-xs-12 col-md-8">

                <h2 class="single__title">Préparation</h2>

                <div class="preparation-steps">
                    <?php the_content() ?>
                </div>
                <div>
                    <h2 class="single__title">Avis de la communauté</h2>
                    <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </div>

</div>


<?php get_footer(); ?>