<div class="thumbnail card">
    <a href="<?= get_the_permalink() ?>" class="card-body">
        <p class="card-text"><?= the_author() ?></p>
        <h5 class="card-title"><?= the_title() ?></h5>
        <?php do_action('marmiplug-difficulty'); ?>
    </a>
</div>
