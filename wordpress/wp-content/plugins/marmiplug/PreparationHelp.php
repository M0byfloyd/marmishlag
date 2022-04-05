<?php

class PreparationHelp
{
    private $maxIngredients = 9;
    private $maxUstensils = 9;
    private $unitOptions = ['c.à.s','g','cl'];

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
    }

    public function meta_render_duration()
    {
        ?>
        <label>
            Durée de la préparation
            <input type="number" value="<?= get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0] ?>"
                   name="duration" placeholder="">
            min.
        </label>
        <?php
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

    public function meta_render_ingredients() { ?>
        <div class="row">
            <?php for ($i = 0; $i <= $this->maxIngredients; $i++):
                $quantity = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity'] : '';
                $unit = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit'])  ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit'] : '';
                $ingredient = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient'])  ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient'] : '';
                ?>
                <div class="col-12">
                    <label>
                        <?= $i + 1 ?>.
                        <input value="<?= $quantity ?>" name="ingredients_quantity_<?= $i ?>" placeholder="quantité"
                               type="number">
                        <select name="ingredients_unit_<?= $i ?>">
                            <option value="">Mesure</option>
                            <?php foreach ($this->unitOptions as $option): ?>
                                <option <?= $option === $unit ? 'selected': '' ?>  value="<?= $option ?>"><?= $option ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input value="<?= $ingredient ?>" name="ingredients_ingredient_<?= $i ?>"
                               placeholder="ingrédient" type="text">
                    </label>
                </div>
            <?php endfor; ?>
        </div>
        <?php }

    public function meta_boxes()
    {
        add_meta_box('duration', 'Durée', [$this, 'meta_render_duration'], 'recipe');
        add_meta_box('ingredients', 'Ingrédients', [$this, 'meta_render_ingredients'], 'recipe');
        add_meta_box('ustensils', 'Ustensiles', [$this, 'meta_render_ustensils'], 'recipe');
    }

    public function save_metabox($post_id)
    {
        if (isset($_POST['duration']) && !empty($_POST['duration'])) {
            $inputDuration = intval($_POST['duration']);
            update_post_meta($post_id, 'marmishlag_recipe_duration', $inputDuration);
        } else {
            delete_post_meta($post_id, 'marmishlag_recipe_duration');
        }

        $inputIngredients = [];

        for ($i = 0; $i <= $this->maxIngredients; $i++) {
            if (isset($_POST['ingredients_ingredient_' . $i]) && !empty($_POST['ingredients_ingredient_' . $i])) {
                $inputIngredients[$i]['ingredient'] = $_POST['ingredients_ingredient_' . $i];
                $inputIngredients[$i]['quantity'] = $_POST['ingredients_quantity_' . $i];
                $inputIngredients[$i]['unit'] = $_POST['ingredients_unit_' . $i];
            }
        }

        if (empty($inputIngredients)) {
            delete_post_meta($post_id, 'marmishlag_recipe_ingredients');
        }

        update_post_meta($post_id, 'marmishlag_recipe_ingredients', $inputIngredients);

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