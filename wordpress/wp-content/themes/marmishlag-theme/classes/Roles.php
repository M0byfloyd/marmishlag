<?php


const ROLE_TO_MODIFY = [
    'add' => [
        'administrator' => [
            'manage_recipe',
            'manage_recipe_admin'
        ],
        'contributor' => [
            'manage_recipe'
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
        add_action('switch_theme',[$this, 'remove_role']);
    }

    public function modify_role()
    {
        foreach (ROLE_TO_MODIFY['add'] as $role => $capabilities) {
            $wpRole = get_role($role);

            foreach ($capabilities as $capability) {
                $wpRole->add_cap($capability);
            }
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
