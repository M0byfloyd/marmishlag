<?php
/**
 * Template Name: Create Recipe
 * Template Post Type: post, page
 */
$categories = get_categories();
get_header();
?>

<div class="create-recette">
<div class="left-side">
    <div class="section">
        <h2>Titre</h2>
        <textarea name="title" id="recipe_title" cols="50" rows="2"></textarea>
    </div>

    <div class="section">
        <h2>Préparation</h2>
        <textarea name="content" id="recipe_content" cols="50" rows="2"></textarea>
    </div>

    <div class="section">
        <h2>Ingrédients</h2>
        <div class="ingredients">
            <div class="ingredient">
                <div class="ingredient-quantity">
                    <input type="number" name="ingredient-quantity" min="1" value="1">
                    <select name="ingredient-quantity-type" id="ingredient_quantity_type">
                        <option value="cas">c.à.s</option>
                        <option value="g">g</option>
                        <option value="cl">cl</option>
                    </select>
                </div>
                <input type="text" class="ingredient-name" value="">
            </div>
        </div>
        <button class="add-new-item" data-type="ingredient">Ajouter un nouvel ingrédient</button>
    </div>

    <div class="section">
        <h2>Ustensiles</h2>
        <div class="ustensiles">
            <div class="ustensile">
                <div class="ustensile-quantity">
                    <input type="number" name="ustensile-quantity" min="1" value="1">
                    <select name="ustensile-quantity-type" id="ustensile_quantity_type">
                        <option value="cas">c.à.s</option>
                        <option value="g">g</option>
                        <option value="cl">cl</option>
                    </select>
                </div>
                <input type="text" class="ustensile-name">
            </div>
        </div>
        <button class="add-new-item" data-type="ustensile">Ajouter un nouvel ustensile</button>
    </div>
</div>
<div class="right-side">
    <div class="section">
        <h2>Temps</h2>
        <div class="time">
            <input name="time-hours" type="number" min="1" value="00">
            <span>:</span>
            <input name="time-minutes" type="number" min="1" value="00">
        </div>
    </div>

    <div class="section">
        <h2>Difficulté</h2>
        <select>
            <option value="easy">Facile</option>
            <option value="medium">Intermédiaire</option>
            <option value="hard">Difficile</option>
        </select>
    </div>

    <div class="section">
        <h2>Catégories</h2>
        <fieldset>
            <?php foreach ($categories as $category): ?>
                <div class="recipe-category">
                    <input type="checkbox" name="<?= $category->name ?>" value="<?= $category->term_id ?>"><label for="<?= $category->name ?>"><?= $category->name ?></label>
                </div>
                <?php endforeach; ?>
            
        </fieldset> 
    </div>
</div>  
</div>


<?php get_footer(); ?>
