<?php


class Recipes
{

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('init', [$this, 'register_post_type'], 0);
    }

    public function register_post_type()
    {
        $labels = array(
            'name' => _x('Recettes', 'Post Type General Name', 'text_domain'),
            'singular_name' => _x('Recette', 'Post Type Singular Name', 'text_domain'),
            'menu_name' => __('Recettes', 'text_domain'),
            'name_admin_bar' => __('Recettes', 'text_domain'),
            'archives' => __('Les recette', 'text_domain'),
            'attributes' => __('Item Attributes', 'text_domain'),
            'parent_item_colon' => __('Parent Item:', 'text_domain'),
            'all_items' => __('Toutes les recettes', 'text_domain'),
            'add_new_item' => __('Ajouter une nouvelle recette', 'text_domain'),
            'add_new' => __('Ajouter une nouvelle recette', 'text_domain'),
            'new_item' => __('Nouvelle recette', 'text_domain'),
            'edit_item' => __('Modifier la recette', 'text_domain'),
            'update_item' => __('Mettre à jour la recette', 'text_domain'),
            'view_item' => __('Voir la recette', 'text_domain'),
            'view_items' => __('VOir les recettes', 'text_domain'),
            'search_items' => __('Chercher une recette', 'text_domain'),
            'not_found' => __('Recette non trouvée', 'text_domain'),
            'not_found_in_trash' => __('Votre poubelle est vite', 'text_domain'),
            'featured_image' => __('Votre image alléchante', 'text_domain'),
            'set_featured_image' => __('Choisir votre image alléchante', 'text_domain'),
            'remove_featured_image' => __('Retirer votre image alléchante', 'text_domain'),
            'use_featured_image' => __('Utilisaer comme image alléchante', 'text_domain'),
            'insert_into_item' => __('Insert into item', 'text_domain'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
            'items_list' => __('Liste des recettes', 'text_domain'),
            'items_list_navigation' => __('Navigation dans les recettes', 'text_domain'),
            'filter_items_list' => __('Filtrer les recettes', 'text_domain'),
        );

        $args = array(
            'label' => __('Recettes', 'text_domain'),
            'description' => __('Recette du shlag', 'text_domain'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'comments','thumbnail'),
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
                'create_posts' => 'create_recipes',
                'publish_posts' => 'publish_recipes',
                'edit_post' => 'edit_recipe',
                'edit_posts' => 'edit_recipes',
                'edit_others_posts' => 'edit_others_recipes',
                'read_posts' => 'read_recipes',
                'delete_posts' => 'delete_recipes'
            ]
        );

        register_post_type('recipe', $args);
    }
}
