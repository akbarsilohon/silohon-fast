<?php
/**
 * Dashboard amin
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_action( 'admin_menu', 'fast_admin_menu');
function fast_admin_menu(){
    add_menu_page( FAST_NAME, FAST_NAME, 'manage_options', 'fast-dash', 'fast_dash', 'dashicons-category', 1 );
    add_submenu_page( 'fast-dash', FAST_NAME, 'General', 'manage_options', 'fast-dash', 'fast_dash' );

    // Article setting page
    add_submenu_page( 'fast-dash', 'Article Settings', 'Article Settings', 'manage_options', 'fast-article', 'fast_article' );

    // Inser HTML header & footer
    add_submenu_page( 'fast-dash', 'Insert HTML', 'Insert HTML', 'manage_options', 'html-footer', 'fast_insert' );
}


function fast_dash(){ ?>

<div class="fast_container">
    <h1 class="fastHeading">Logo & Schema</h1>

    <?php settings_errors() ?>

    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-group' ); ?>
        <?php do_settings_sections( 'fast-dash' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>

<?php
}

function fast_article(){ ?>
<div class="fast_container">

    <?php settings_errors() ?>
    
    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-article' ); ?>
        <?php do_settings_sections( 'fast-article' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>
    <?php
}


function fast_insert(){ ?>

<div class="fast_container">

    <?php settings_errors() ?>
    
    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-insert' ); ?>
        <?php do_settings_sections( 'html-footer' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>

<?php
}

add_action( 'admin_init', 'fast_admin_inits' );
function fast_admin_inits(){
    require FAST_DIR . '/inc/admin/handler/main.php';
    require FAST_DIR . '/inc/admin/handler/article.php';
    require FAST_DIR . '/inc/admin/handler/insert.php';
}