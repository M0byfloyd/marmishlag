<?php

class Auth
{

    public function __construct()
    {
      $this->register();
    }

    public function register()
    {
        global $registerDataErrors;
        $registerDataErrors = new WP_Error;

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registration-submit"])){
          $dataForm = $_POST;


          $this->registration_validation($_POST, $registerDataErrors);

          if ( 1 > count( $registerDataErrors->get_error_messages()) )
          {
            // sanitize user form input
            global $username, $useremail;
            $username   =   sanitize_user( $_POST['username'] );
            $useremail  =   sanitize_email( $_POST['useremail'] );
            $password   =   esc_attr( $_POST['password'] );

            $userdata = [
              'user_login'    =>   $username,
              'user_email'    =>   $useremail,
              'user_pass'     =>   $password,
              'role'          =>   'contributor'
            ];
            $user = wp_insert_user( $userdata );
          }

          return compact('dataForm', 'registerDataErrors');
        }
    }

    public function registration_validation($dataForm, $registerDataErrors)
    {
      if(empty( $dataForm['username'] ))
      {
          $registerDataErrors->add('username', 'Le champs ne peut être nul');
      }
      elseif ( 6 > strlen( $dataForm['username'] ) )
      {
          $registerDataErrors->add('username', 'Nom ' );
      }
      elseif ( ! validate_username( $dataForm['username'] ) )
      {
        $registerDataErrors->add( 'username', 'Ce nom n\'est pas valide !' );
      }
      elseif ( username_exists( $dataForm['username'] ) )
      {
          $registerDataErrors->add('username', 'Ce nom existe déjà !');
      }

      if(empty( $dataForm['useremail'] ))
      {
          $registerDataErrors->add('useremail', 'Le champs ne peut être nul');
      }
      elseif ( !is_email( $dataForm['useremail'] ) )
      {
          $registerDataErrors->add( 'useremail', 'Cette adresse email n\'est pas valide !' );
      }
      elseif ( email_exists( $dataForm['useremail'] ) )
      {
          $registerDataErrors->add( 'useremail', 'Cette adresse email existe déjà !' );
      }

      if(empty($dataForm['password']))
      {
          $registerDataErrors->add('password', 'Le champs ne peut être nul');
      }
      elseif( 5 > strlen( $dataForm['password'] ) ) {
          $registerDataErrors->add( 'password', 'Le mot de passe doit contenir plus de 5 caractères !' );
      }

      if (is_wp_error( $registerDataErrors ))
      {
          return $registerDataErrors;
      }
      return null;
    }
}
