<?php

class Roles
{

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('after_switch_theme', [$this, 'add_role']);
        add_action('after_switch_theme', [$this, 'modify_role']);
        add_action('switch_theme',[$this, 'remove_role']);
    }

    public function modify_role()
    {
        $admin = get_role('administrator');
        $contributor = get_role('contributor');

        $admin->add_cap('manage_recipe');
        $admin->add_cap('manage_recipe_admin');
        $contributor->add_cap('manage_recipe');

        $contributor->remove_cap('edit_others_posts');
    }

    public function add_role()
    {
        add_role('marmimodo', 'Marmimodo', [
            'manage_recipe' => true,
            'manage_recipe_admin'=> true,
            'edit'=> true,
            'edit_posts'=> true,
            'read'=> true,
            'moderate_comments' => true
        ]);
    }

    public function remove_role() {
        remove_role('marmimodo');
    }

}
