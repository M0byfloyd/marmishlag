<?php

class PreparationHelp
{
    private $maxUstensils = 9;

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
    }


    public function meta_render_ustensils() { ?>
        <div class="row">
            <?php for ($i = 0; $i <= $this->maxUstensils; $i++):
                $quantity = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['quantity']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['quantity']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['quantity'] : '';
                $ustensil = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['ustensil']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['ustensil'])  ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ustensils')[0][$i]['ustensil'] : '';
                ?>
                <div class="col-12">
                    <label>
                        <?= $i + 1 ?>.
                        <input value="<?= $quantity ?>" name="ustensils_quantity_<?= $i ?>" placeholder="quantité"
                               type="number">
                        <input value="<?= $ustensil ?>" name="ustensils_ustensil_<?= $i ?>"
                               placeholder="ustensiles" type="text">
                    </label>
                </div>
            <?php endfor; ?>
        </div>
    <?php }

    public function meta_boxes()
    {
        add_meta_box('ustensils', 'Ustensiles', [$this, 'meta_render_ustensils'], 'recipe');
    }

    public function save_metabox($post_id)
    {

        for ($i = 0; $i <= $this->maxUstensils; $i++) {
            if (isset($_POST['ustensils_ustensil_' . $i]) && !empty($_POST['ustensils_ustensil_' . $i])) {
                $inputUstensils[$i]['ustensil'] = $_POST['ustensils_ustensil_' . $i];
                $inputUstensils[$i]['quantity'] = $_POST['ustensils_quantity_' . $i];
            }
        }

        if (empty($inputustensils)) {
            delete_post_meta($post_id, 'marmishlag_recipe_ustensils');
        }

        update_post_meta($post_id, 'marmishlag_recipe_ustensils', $inputUstensils);
    }

}
