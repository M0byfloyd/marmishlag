<?php

$recipeCapsDefault = [
    'edit_recipe',
    'edit_recipes',
    'read_recipes',
    'delete_recipes'
];

define('ROLE_TO_MODIFY',[
    'administrator' => array_merge($recipeCapsDefault,['publish_recipes']),
    'contributor' => $recipeCapsDefault
]);

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
    }

    public function modify_role()
    {
        foreach (ROLE_TO_MODIFY as $role => $capabilities) {
            $wpRole = get_role($role);

            foreach ($capabilities as $capability) {
                $wpRole->add_cap($capability);
            }
        }
    }

    public function add_role()
    {
        add_role('marmimodo', 'Marmimodo', [
            'edit_recipe' => true,
            'edit_recipes' => true,
            'read_recipes' => true,
            'delete_recipes' => true,
            'publish_recipes'=> true
        ]);
    }

}
