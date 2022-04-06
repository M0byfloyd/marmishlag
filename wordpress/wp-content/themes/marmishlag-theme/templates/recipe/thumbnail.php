<div class="thumbnail card" <?php if (get_post_thumbnail_id()) : ?> style="background-image: url(<?= wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>)" <?php endif; ?>>
    <a href="<?= get_the_permalink() ?>" class="card-body">
        <p class="card-text"><?= the_author() ?></p>
        <h5 class="card-title"><?= the_title() ?></h5>
        <?php do_action('marmiplug-difficulty'); ?>
    </a>
</div>