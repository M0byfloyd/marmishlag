<?php

class Difficulty
{
    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('marmiplug-difficulty', [$this, 'display']);
    }

    public function meta_boxes()
    {
        add_meta_box('difficulty', 'Difficulté', [$this, 'meta_render'], 'recipe');
    }

    public function meta_render()
    { ?>
        <label>
            Difficulté de la préparation (de 1 à 3)
            <input type="number" min="1" max="3"
                   value="<?= get_post_meta(get_the_ID(), 'marmishlag_recipe_difficulty')[0] ?>"
                   name="difficulty" placeholder="">
        </label>
        <?php
    }

    public function save_metabox($post_id)
    {
        if (isset($_POST['difficulty']) && !empty($_POST['difficulty'])) {
            $inputDifficulty = intval($_POST['difficulty']);
            update_post_meta($post_id, 'marmishlag_recipe_difficulty', $inputDifficulty);
        } else {
            delete_post_meta($post_id, 'marmishlag_recipe_difficulty');
        }
    }

    public function display()
    {
        $levelDifficulty = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_difficulty')[0]) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_difficulty')) ? get_post_meta(get_the_ID() , 'marmishlag_recipe_difficulty')[0]: null;
        if (isset($levelDifficulty) && !empty($levelDifficulty)) {
            ob_start()
            ?>
            <div class="marmiplug-difficulty">
                <?php for ($i = 1; $i <= 3; $i++) { ?>
                    <img class="marmiplug-difficulty__img"
                         src="<?= $i <= $levelDifficulty ? '/wp-content/plugins/marmiplug/assets/img/svg/difficulty_active.svg' : '/wp-content/plugins/marmiplug/assets/img/svg/difficulty.svg' ?>"
                         alt="">
                <?php } ?>
            </div>
            <?php echo ob_get_clean();}
    }
}
