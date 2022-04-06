<?php

class Ingredients
{

    private $maxIngredients = 9;
    private $unitOptions = ['c.à.s', 'g', 'cl'];

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('marmiplug-ingredients', [$this, 'display']);
    }

    public function meta_boxes()
    {
        add_meta_box('ingredients', 'Ingrédients', [$this, 'meta_render'], 'recipe');
    }

    public function meta_render()
    { ?>
        <div class="row">
            <?php for ($i = 0; $i <= $this->maxIngredients; $i++):
                $quantity = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity'] : '';
                $unit = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit'] : '';
                $ingredient = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient'] : '';
                ?>
                <div class="col-12">
                    <label>
                        <?= $i + 1 ?>.
                        <input value="<?= $quantity ?>" name="ingredients_quantity_<?= $i ?>" placeholder="quantité"
                               type="number">
                        <select name="ingredients_unit_<?= $i ?>">
                            <option value="">Mesure</option>
                            <?php foreach ($this->unitOptions as $option): ?>
                                <option <?= $option === $unit ? 'selected' : '' ?>
                                        value="<?= $option ?>"><?= $option ?></option>
                            <?php endforeach; ?> if (get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0]) {

                        </select>
                        <input value="<?= $ingredient ?>" name="ingredients_ingredient_<?= $i ?>"
                               placeholder="ingrédient" type="text">
                    </label>
                </div>
            <?php endfor; ?>
        </div>
        <?php
    }

    public function save_metabox($post_id)
    {
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
    }

    public function display()
    {
        ob_start()
        ?>
        <div class="row marmishlag-list">

        <h2 class="marmishlag-list__title">Ingrédients</h2>

        <?php
        $ingredients = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0]) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0] : null;
        if (isset($ingredients) && !empty($ingredients)) {
            ?>
            <div class="marmishlag-list__list">
                <?php
                foreach (get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0] as $ingredient):
                    ?>
                    <div>
                        <hr/>

                        <p>
                            <strong><?= $ingredient['quantity'] . $ingredient['unit'] ?></strong> <?= $ingredient['ingredient'] ?>
                        </p>
                    </div>

                <?php endforeach; ?>
            </div>
            </div>
            <?php
        } else {
            ?>
            <p>Aucun ingrédient n'a été renseigné pour cette recette</p>
        <?php }
        echo ob_get_clean();
    }
}
