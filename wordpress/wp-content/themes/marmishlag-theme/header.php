<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marmishlag</title>
    <?php wp_head(); ?>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-box">
        <div class="container-fluid justify-content-between navbar-container">
            <a class="navbar-brand navbar-title" href="<?= home_url(); ?>"><?= get_option('blogname') ?></a>
            <button class="navbar-toggler navbar-burger" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-burger-icons"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php get_search_form(); ?>
                <?php if (is_user_logged_in()): ?>
                  <a href="<?= wp_logout_url( home_url() ) ?>" type="button" class="navbar-connexion" id="open-search">
                    <svg class="navbar-connexion-user" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 384.971 384.971" style="enable-background:new 0 0 384.971 384.971;" xml:space="preserve">
                      <title />
                    	<g id="Sign_Out">
                    		<path d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03    C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03    C192.485,366.299,187.095,360.91,180.455,360.91z"/>
                    		<path d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279    c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179    c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z"/>
                    	</g>
                    </svg>
                    Deconnection
                  </a>
                <?php else: ?>
                  <button type="button" class="navbar-connexion" id="open-search" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg viewBox="0 0 32 32" class="navbar-connexion-user">
                      <title />
                      <g id="poeple">
                        <path d="M16,16A7,7,0,1,0,9,9,7,7,0,0,0,16,16ZM16,4a5,5,0,1,1-5,5A5,5,0,0,1,16,4Z" />
                        <path d="M17,18H15A11,11,0,0,0,4,29a1,1,0,0,0,1,1H27a1,1,0,0,0,1-1A11,11,0,0,0,17,18ZM6.06,28A9,9,0,0,1,15,20h2a9,9,0,0,1,8.94,8Z" />
                      </g>
                    </svg>
                    Connexion
                  </button>
                <?php endif; ?>

            </div>
        </div>
    </nav>
    <?php
    ?>
    <?php if (!is_user_logged_in()): ?>
      <!-- Modal -->
      <?php $dataErrors = $GLOBALS['registerDataErrors']; ?>
      <div class="modal fade connection-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-3">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Se connecter</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">S'inscrire</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form action="<?= home_url('wp-login.php'); ?>" method="post">
                  <div class="mt-2 mb-3">
                    <label for="inputEmail" class="form-label">Identifiant ou adresse email</label>
                    <input type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" name="log">
                  </div>
                  <div class= "mb-3">
                    <label for="inputPassword1" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword1" name="pwd">
                  </div>
                  <input type="hidden" name= "redirect_to" value= "<?= home_url() ?>"/>
                  <button type="submit" class="btn btn-primary">Je me connecte</button>
                </form>
              </div>

              <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <form action="" name="user_registration" method="post">
                  <div class="mb-3">
                    <label for="inputName2" class="form-label">Identifiant</label>
                    <input type="text" class="form-control <?= $dataErrors->get_error_messages('username') ? "is-invalid" : "" ?>"
                    id="inputName2" aria-describedby="emailHelp" name="username">
                    <?php if ($dataErrors->get_error_message('username') !== ""): ?>
                      <div class="invalid-feedback"><?= $dataErrors->get_error_message('username') ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="mb-3">
                    <label for="inputEmail2" class="form-label">Email</label>
                    <input type="text" class="form-control <?= $dataErrors->get_error_messages('useremail') ? "is-invalid" : "" ?>"
                    id="inputEmail2" aria-describedby="emailHelp" name="useremail">
                    <?php if ($dataErrors->get_error_message('useremail') !== ""): ?>
                      <div class="invalid-feedback"><?= $dataErrors->get_error_message('useremail') ?></div>
                    <?php endif; ?>
                  </div>
                  <div class= "mb-3">
                    <label for="inputPassword2" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control <?= $dataErrors->get_error_messages('password') ? "is-invalid" : "" ?>"
                    id="inputPassword2" name="password">
                    <?php if ($dataErrors->get_error_message('password') !== ""): ?>
                      <div class="invalid-feedback"><?= $dataErrors->get_error_message('password') ?></div>
                    <?php endif; ?>
                  </div>
                  <button type="submit" class="btn btn-primary" name="registration-submit" value="true">Je m'inscris</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="container-fluid">
