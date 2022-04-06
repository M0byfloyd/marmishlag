<?php $cooker = $args['cooker'];
?>

<div class="cuisinier">
  <img src="<?= get_avatar_url($cooker->user_email) ?>" alt="">

  <p><?= $cooker->display_name ?></p>
</div>
