<?php
/**
 * Root function
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

define( 'FAST_NAME', 'SILOHON FAST' );
define( 'FAST_URI', get_template_directory_uri());
define( 'FAST_DIR', get_template_directory());

/**
 * Creating simple call template part
 * 
 * @package silohon-fast
 */
function FAST_PART( $filename ){
    return get_template_part( $filename );
}


/**
 * Define theme function
 * 
 * @package silohon-fast
 */
require_once FAST_DIR . '/inc/func/theme.php';
require_once FAST_DIR . '/inc/func/scripts.php';
require_once FAST_DIR . '/inc/func/deregister.php';
require_once FAST_DIR . '/inc/func/seo.php';



/**
 * Admin Core
 * 
 * @package silohon-fast
 */
require_once FAST_DIR . '/inc/admin/dashboard.php';


/**
 * Shortcode function
 * 
 * @package silohon-fast
 */
require_once FAST_DIR . '/inc/code/core.php';