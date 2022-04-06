<?php

class Duration
{

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('marmiplug-duration', [$this, 'display']);
    }

    public function meta_boxes()
    {
        add_meta_box('duration', 'Durée', [$this, 'meta_render'], 'recipe');
    }

    public function meta_render()
    { ?>
        <label>
            Durée de la préparation
            <input type="number" value="<?= get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0] ?>"
                   name="duration" placeholder="">
            min.
        </label>
        <?php
    }

    public function save_metabox($post_id)
    {
        if (isset($_POST['duration']) && !empty($_POST['duration'])) {
            $inputDuration = intval($_POST['duration']);
            update_post_meta($post_id, 'marmishlag_recipe_duration', $inputDuration);
        } else {
            delete_post_meta($post_id, 'marmishlag_recipe_duration');
        }
    }

    public function display()
    {
        ob_start();
        $duration = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0]) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0] : null;
        if (isset($duration) && !empty($duration)) {
            ?>
            <span><?= $duration ?> min.</span>

            <?php
        } else {
            ?>
            <span title="Aucun temps n'a été renseigné">? min.</span>
        <?php }
        echo ob_get_clean();
    }
}
