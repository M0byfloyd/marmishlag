<?php



$comments_args = array(
    'label_submit' => 'Envoyer',
    'title_reply' => null,
    'comment_notes_after' => '',
    'submit_button' => '<input class="single__button" name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    'logged_in_as' => null,
    'comment_notes_before' => null,
    'comment_notes_after' => null,
    'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" class=" single__comment" rows="3" placeholder="Votre commentaire..."  aria-required="true"></textarea></p>',
    'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author single__input">' .
      '<label for="author">Nom ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30" class="single__comment"/></p>',

    'email' =>
      '<p class="comment-form-email single__input"><label for="email">Email ' .
      ( $req ? '<span class="required">*</span>' : '' ) .
      '</label> <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30" class="single__comment"/></p>',
      'cookies' => '',
    ))
);
comment_form( $comments_args );

?>



<div>
    <?php if ( have_comments() ) : ?>

        <ol>
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
