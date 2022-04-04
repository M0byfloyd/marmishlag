<?php

comment_form();

?>

<div id="commentaires" class="comments">
    <?php if ( have_comments() ) : ?>

        <ol class="comment__list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 74,
            ) );
            ?>
        </ol>

    <?php
    else :
        ?>
        <p class="comments__none">
            Il n'y a pas de commentaires pour le moment. Soyez le premier à participer !
        </p>
    <?php endif; ?>
</div>
