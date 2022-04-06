<?php

class Duration
{

    public function __construct()
    {
        $this->register();
    }

    public function register()
    {
        add_action('add_meta_boxes', [$this, 'meta_boxes']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('marmiplug-duration', [$this, 'display']);
    }

    public function meta_boxes()
    {
        add_meta_box('duration', 'Durée', [$this, 'meta_render'], 'recipe');
    }

    public function meta_render()
    { ?>
        <label>
            Durée de la préparation
            <input type="number" value="<?= get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0] ?>"
                   name="duration" placeholder="">
            min.
        </label>
        <?php
    }

    public function save_metabox($post_id)
    {
        if (isset($_POST['duration']) && !empty($_POST['duration'])) {
            $inputDuration = intval($_POST['duration']);
            update_post_meta($post_id, 'marmishlag_recipe_duration', $inputDuration);
        } else {
            delete_post_meta($post_id, 'marmishlag_recipe_duration');
        }
    }

    public function display()
    {
        ob_start();
        $duration = isset(get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0]) && !empty(get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')) ? get_post_meta(get_the_ID(), 'marmishlag_recipe_duration')[0] : null;
        if (isset($duration) && !empty($duration)) {
            ?>
            <span class="single__infos-time"><svg width="29" height="31" viewBox="0 0 29 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M13.1267 10.364H14.8769V18.8437H13.1267V10.364ZM11.3765 1.88436H16.6272V3.76874H11.3765V1.88436Z" fill="#E17C78"/>
<path d="M24.5029 8.47966L23.2603 7.15117L21.2912 9.27109C19.6795 7.26709 17.4125 6.00871 14.9614 5.7574C12.5103 5.50609 10.0634 6.28119 8.12931 7.92164C6.19517 9.56209 4.92243 11.9418 4.57552 14.5662C4.2286 17.1907 4.8342 19.8582 6.26648 22.0144C7.69876 24.1707 9.84759 25.6499 12.2665 26.1448C14.6854 26.6397 17.1885 26.1122 19.2555 24.6719C21.3226 23.2315 22.7948 20.9892 23.3662 18.4106C23.9376 15.8321 23.5643 13.1156 22.3239 10.8257L24.5029 8.47966ZM14.0015 24.4968C12.4438 24.4968 10.921 23.9995 9.62582 23.0678C8.33061 22.136 7.32112 20.8116 6.725 19.2622C6.12888 17.7127 5.97291 16.0077 6.27681 14.3628C6.58071 12.718 7.33083 11.207 8.43231 10.0211C9.5338 8.8352 10.9372 8.02759 12.465 7.7004C13.9928 7.37321 15.5764 7.54114 17.0156 8.18295C18.4547 8.82475 19.6848 9.91162 20.5502 11.3061C21.4156 12.7006 21.8776 14.34 21.8776 16.0172C21.8776 18.2661 21.0478 20.4229 19.5707 22.0132C18.0937 23.6034 16.0904 24.4968 14.0015 24.4968Z" fill="#E17C78"/>
</svg>
<?= $duration ?> min.</span>

            <?php
        } else {
            ?>
            <span title="Aucun temps n'a été renseigné">? min.</span>
        <?php }
        echo ob_get_clean();
    }
}
