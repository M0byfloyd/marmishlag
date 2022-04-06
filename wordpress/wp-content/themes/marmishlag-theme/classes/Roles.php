<?php

const ROLE_TO_MODIFY = [
    'add' => [
        'administrator' => [
            'create_recipes',
            'publish_recipes',
            'edit_recipe',
            'edit_recipes',
            'edit_others_recipes',
            'read_recipes',
            'delete_recipes'
        ],
        'contributor' => [
            'create_recipes',
            'edit_recipe',
            'edit_recipes',
            'read_recipes',
            'delete_recipes'
        ],
    ],
    'remove' => [
        'contributor' => [
            'edit_others_posts'
        ]
    ]
];

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
        add_action('switch_theme', [$this, 'remove_role']);
    }

    public function modify_role()
    {
        foreach (ROLE_TO_MODIFY['add'] as $role => $capabilities) {
            $wpRole = get_role($role);

            foreach ($capabilities as $capability) {
                $wpRole->add_cap($capability);
            }
            var_dump($wpRole);
        }

        foreach (ROLE_TO_MODIFY['remove'] as $role => $capabilities) {
            $wpRole = get_role($role);

            foreach ($capabilities as $capability) {
                $wpRole->remove_cap($capability);
            }
        }

    }

    public function add_role()
    {
        add_role('marmimodo', 'Marmimodo', [
            'create_recipes' => true,
            'publish_recipes' => true,
            'edit_recipe' => true,
            'edit_recipes' => true,
            'edit_others_recipes' => true,
            'read_recipes' => true,
            'delete_recipes' => true
        ]);
    }

    public function remove_role()
    {
        remove_role('marmimodo');
    }

}
