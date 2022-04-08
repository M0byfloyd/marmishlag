<?php

$developmentUrl = 'http://141.94.85.201/';


// Set the environment type for development
if ($_SERVER['SERVER_NAME'] = $developmentUrl) {
    define('WP_ENVIRONMENT_TYPE', 'development');
    define("WP_DEBUG", true);
}

if (WP_ENVIRONMENT_TYPE === 'development') {
    if (!function_exists('getenv_docker')) {
        ;
        // https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
        function getenv_docker($env, $default)
        {
            if ($fileEnv = getenv($env . '_FILE')) {
                return rtrim(file_get_contents($fileEnv), "\r\n");
            } else if (($val = getenv($env)) !== false) {
                return $val;
            } else {
                return $default;
            }
        }
    }

    define('DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress'));
    define('DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username'));
    define('DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password'));
    define('DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql'));
}
else {
      define('DB_NAME', 'wordpress');
      define('DB_USER', 'groupe9');
      define('DB_PASSWORD', 'kevinestbeau');
      define('DB_HOST','localhost');
}

const DB_CHARSET = 'utf8';
const DB_COLLATE = '';
const AUTH_KEY = '185cfd079348796d49b2d9bcbd470508a63e14f9';
const SECURE_AUTH_KEY = 'c7427215b162bc4c463e7dee28dee98e7a5bf457';
const LOGGED_IN_KEY = '56fc4ec6ea121e5ea6708a41a0c0b5242f4046c2';
const NONCE_KEY = '6945d6574dfdc1e04050355924946b635aa63c1a';
const AUTH_SALT = '7d6a3160500f4eefa6f3885f535e144c8ad87bb7';
const SECURE_AUTH_SALT = '1aba25d86d6be485db895303620ae24037c69ad7';
const LOGGED_IN_SALT = 'b0532675f56545b5eb57d26d2e10a1a8d4e48d24';
const NONCE_SALT = '16d10e78e7a6b74bd306e548a1366076486d78f7';

$table_prefix = 'wp_';

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
    $_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
    eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
