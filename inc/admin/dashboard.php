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
    add_menu_page( FAST_NAME, FAST_NAME, 'manage_options', 'fast-dash', 'fast_dash', 'dashicons-update-alt', 1 );
    add_submenu_page( 'fast-dash', FAST_NAME, 'General', 'manage_options', 'fast-dash', 'fast_dash' );

    // Article setting page
    add_submenu_page( 'fast-dash', 'Article Settings', 'Article Settings', 'manage_options', 'fast-article', 'fast_article' );

    // Inser HTML header & footer
    add_submenu_page( 'fast-dash', 'Insert HTML', 'Insert HTML', 'manage_options', 'html-footer', 'fast_insert' );

    // SEO Panel
    add_submenu_page( 'fast-dash', 'SEO & Schema', 'SEO & Schema', 'manage_options', 'fast-seo', 'fast_seo', );

    // Custom Color
    add_submenu_page( 'fast-dash', 'Color', 'Color', 'manage_options', 'fast-color', 'fast_color' );

    // Inline related posts
    add_submenu_page( 'fast-dash', 'Inline Related Posts', 'Inline Related Posts', 'manage_options', 'fast-re', 'fast_re' );
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


function fast_seo(){ ?>

<div class="fast_container">

    <h1 class="fastHeading">Schema end Redirect</h1>

    <?php settings_errors() ?>
    
    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-seo' ); ?>
        <?php do_settings_sections( 'fast-seo' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>

<?php
}


function fast_color(){ ?>
<div class="fast_container">

    <h1 class="fastHeading">Cusom Color</h1>

    <?php settings_errors() ?>

    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-color' ); ?>
        <?php do_settings_sections( 'fast-color' ); ?>
        <?php submit_button('Save Change'); ?>
    </form>
</div>
<?php
}

function fast_re(){ ?>
<div class="fast_container">
    <h1 class="fastHeading">Inline Related Posts</h1>
    <?php settings_errors() ?>

    <form action="options.php" method="post" class="fast_form">
        <?php settings_fields( 'fast-settings-irp' ); ?>
        <?php do_settings_sections( 'fast-re' ); ?>
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
    require FAST_DIR . '/inc/admin/handler/seo.php';
    require FAST_DIR . '/inc/admin/handler/color.php';
    require FAST_DIR . '/inc/admin/handler/irp.php';
}


/**
 * Add MetaBoxes to spesifix post by ID
 * 
 * @package silohon-fast
 */
function fast_add_new_meta_boxes() {
    add_meta_box(
        'show_related_posts_meta_box',
        'Fast New Meta',
        'fast_display_box_posts_meta_box',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'fast_add_new_meta_boxes');


function fast_display_box_posts_meta_box($post) {
    $disable_irp = get_post_meta($post->ID, 'fast_irp_disable', true);
    $disable_toc = get_post_meta( $post->ID, 'fast_disable_toc', true );
    $use_faq_meta = get_post_meta( $post->ID, 'fast_faq_meta', true );
    ?>
    <input type="checkbox" name="fast_irp_disable" id="fast_irp_disable" <?php checked($disable_irp, 'true'); ?> />
    <label for="fast_irp_disable">Disable IRP</label><br>

    <input type="checkbox" name="fast_disable_toc" id="fast_disable_toc" <?php checked($disable_toc, 'true'); ?> />
    <label for="fast_disable_toc">Disable TOC</label><br>

    <input type="checkbox" name="fast_faq_meta" id="fast_faq_meta" <?php checked($use_faq_meta, 'true'); ?>>
    <label for="fast_faq_meta">Use FAQ Meta SEO</label><br>

    <?php
}

function fast_save_new_posts_meta_box($post_id) {

    // DIsable Related Posts
    if (isset($_POST['fast_irp_disable'])) {
        update_post_meta($post_id, 'fast_irp_disable', 'true');
    } else {
        delete_post_meta($post_id, 'fast_irp_disable');
    }


    // Adding FAQs meta SEO
    if(isset($_POST['fast_faq_meta'])){
        update_post_meta( $post_id, 'fast_faq_meta', 'true' );
    } else{
        delete_post_meta($post_id, 'fast_faq_meta');
    }

    if(isset($_POST['fast_disable_toc'])){
        update_post_meta( $post_id, 'fast_disable_toc', 'true' );
    } else{
        delete_post_meta($post_id, 'fast_disable_toc');
    }
}
add_action('save_post', 'fast_save_new_posts_meta_box');



/**
 * Add Action Admin_bar_menu
 * 
 * @package silohon-fast
 */
// Tambahkan link ke toolbar admin
add_action('admin_bar_menu', 'fast_admin_bar_menu', 999);
function fast_admin_bar_menu( $wp_admin_bar ) {
    $args = array(
        'id' => 'fast-clear-cache',
        'title' => 'Clear Cache',
        'href' => admin_url('admin.php?action=fast_clear_cache_action'),
        'meta' => array(
            'class' => 'dashicons-trash',
            'title' => 'Clear Cache'
        )
    );
    $wp_admin_bar->add_node($args);
}

// Tambahkan action untuk menangani clear cache
add_action('admin_init', 'fast_clear_cache_action');

function fast_clear_cache_action() {
    if (isset($_GET['action']) && $_GET['action'] === 'fast_clear_cache_action') {
        $cache_dir = FAST_DIR . '/cache/temp/';
        $cache_files = glob($cache_dir . '*.html');
        if (!empty($cache_files)) {
            foreach ($cache_files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $current_url = admin_url(add_query_arg(array(),$wp->request));
            wp_redirect($current_url);

            settings_errors('Silohon Fast Cache Success fully deleted', 'success');

            exit;

        } else {

            $current_url = admin_url(add_query_arg(array(),$wp->request));
            wp_redirect($current_url);

            settings_errors('Not find Cache detected', 'error');

            exit;
        }
    }
}
