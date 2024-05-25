<?php
/**
 * Function script handler Silohon Fast Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_action( 'wp_enqueue_scripts', 'fast_wp_enqueue_scripts' );
function fast_wp_enqueue_scripts(){
    wp_enqueue_style( 'fast-style', get_stylesheet_uri(), array(), fileatime( FAST_DIR . '/style.css'), 'all' );
    wp_enqueue_script( 'fast-script', FAST_URI . '/asset/js/main.js', [], fileatime( FAST_DIR . '/asset/js/main.js' ), true );
}



/**
 * Backend script
 * 
 * @package silohon-fast
 */
add_action( 'admin_enqueue_scripts', 'fast_admin_enqueue_scripts' );
function fast_admin_enqueue_scripts(){
    wp_enqueue_style( 'fast-admin-style', FAST_URI . '/asset/css/admin.css', array(), fileatime( FAST_DIR . '/asset/css/admin.css'), 'all' );
    wp_enqueue_media();

    wp_enqueue_script( 'fast-admin-script', FAST_URI . '/asset/js/admin.js', [], fileatime( FAST_DIR . '/asset/js/admin.js' ), true );
}


/**
 * Login logo Wordpress Admin
 * 
 * @package silohon-fast
 */
add_action( 'login_enqueue_scripts', 'fast_cutom_logo_admin_login' );
function fast_cutom_logo_admin_login(){ ?>

    <style type="text/css">
        body.login{
            background-image: url('<?php echo FAST_URI . '/asset/img/wallpaper.png'; ?>');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        form#loginform{
            border-radius: 10px;
        }
    </style>

    <?php
}