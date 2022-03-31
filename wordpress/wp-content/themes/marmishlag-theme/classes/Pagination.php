<?php

class Pagination
{
    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('wp_marmishlag_pagination', [$this, 'wp_marmishlag_paginate']);
    }

    public function wp_marmishlag_paginate() {
        $pages = paginate_links(['type' => 'array']);

        if ($pages) {
            ob_start();
            $html =  '<nav aria-label="Pagination">';
            $html .= '<ul class="pagination">';

            foreach ($pages as $page) {
                $active = strpos($page, 'current');
                $class =  $active ? 'page-item active' : 'page-item';
                $html .= '<li class="' . $class .'">';
                $html .= str_replace('page-numbers', 'page-link', $page);
                $html .= '</li>';
            }

            echo $html . '</ul></nav>';
            echo ob_get_clean();        }
    }
}
