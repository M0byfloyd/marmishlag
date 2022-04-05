<?php

class Steps
{
    public function __construct() {
        $this->register();
    }

    public function register() {
        add_shortcode('easy-steps',[$this,'render_steps']);
    }

    public function render_steps($args = null, $content)
    {
        ob_start();
        var_dump($content);
        return ob_get_clean();
    }
}
