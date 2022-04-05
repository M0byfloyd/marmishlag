<?php


class Recipes
{
    private $maxIngredients = 9;
    private $unitOptions = ['c.à.s','g','cl'];

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('init', [$this, 'register_post_type'], 0);
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
    }

    public function meta_render_duration()
    {
        ?>
        <label>
            Durée de la préparation
            <input type="number" value="<?= get_post_meta(get_the_ID(), 'marmishlage_recipe_duration')[0] ?>"
                   name="duration" placeholder="">
            min.
        </label>
        <?php
    }

    public function meta_render_ingredients()
    {
        ?>
        <div class="row">
            <?php
            var_dump(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0]);

            for ($i = 0; $i <= $this->maxIngredients; $i++):
                $quantity = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity']) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['quantity'] : '';
                $unit = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit'])  ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['unit'] : '';
                $ingredient = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient']) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient'])  ? get_post_meta(get_the_ID(), 'marmishlag_recipe_ingredients')[0][$i]['ingredient'] : '';


                ?>
                <div class="col-12">
                    <label>
                        <?= $i + 1 ?>.
                        <input value="<?= $quantity ?>" name="ingredients_quantity_<?= $i ?>" placeholder="quantité"
                               type="text">
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
        <?php
    }

    public function meta_render_utensils(){

    }

    public function meta_boxes()
    {
        add_meta_box('duration', 'Durée', [$this, 'meta_render_duration'], 'recipe');
        add_meta_box('ingredients', 'Ingrédients', [$this, 'meta_render_ingredients'], 'recipe');
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
    }

    public function register_post_type()
    {
        $labels = array(
            'name' => _x('Recipes', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Recipe', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Recipes', 'text_domain'),
            'name_admin_bar' => __('Recipe', 'text_domain'),
            'archives' => __('Item Archives', 'text_domain'),
            'attributes' => __('Item Attributes', 'text_domain'),
            'parent_item_colon' => __('Parent Item:', 'text_domain'),
            'all_items' => __('All Items', 'text_domain'),
            'add_new_item' => __('Add New Item', 'text_domain'),
            'add_new' => __('Add New', 'text_domain'),
            'new_item' => __('New Item', 'text_domain'),
            'edit_item' => __('Edit Item', 'text_domain'),
            'update_item' => __('Update Item', 'text_domain'),
            'view_item' => __('View Item', 'text_domain'),
            'view_items' => __('View Items', 'text_domain'),
            'search_items' => __('Search Item', 'text_domain'),
            'not_found' => __('Not found', 'text_domain'),
            'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
            'featured_image' => __('Featured Image', 'text_domain'),
            'set_featured_image' => __('Set featured image', 'text_domain'),
            'remove_featured_image' => __('Remove featured image', 'text_domain'),
            'use_featured_image' => __('Use as featured image', 'text_domain'),
            'insert_into_item' => __('Insert into item', 'text_domain'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
            'items_list' => __('Items list', 'text_domain'),
            'items_list_navigation' => __('Items list navigation', 'text_domain'),
            'filter_items_list' => __('Filter items list', 'text_domain'),
        );

        $args = array(
            'label' => __('Recipe', 'text_domain'),
            'description' => __('Recipe du shlag', 'text_domain'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'comments'),
            'taxonomies' => array('category'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'blog',
            'menu_icon' => 'dashicons-list-view',
            'capabilities' => [
                'publish_posts' => 'manage_recipe_admin',
                'edit_post' => 'manage_recipe',
                'edit_posts' => 'manage_recipe',
                'edit_others_posts' => 'manage_recipe_admin',
                'read_posts' => 'manage_recipe',
                'delete_posts' => 'manage_recipe'
            ]
        );

        register_post_type('recipe', $args);
    }
}
