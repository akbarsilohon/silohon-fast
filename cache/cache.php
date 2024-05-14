<?php
/**
 * Cache handler by Silohon Fast Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$cacheOption = get_option('fast_option_cache');
if(!empty($cacheOption['active']) && $cacheOption['active'] === 'true' ){
    if( !is_user_logged_in() || $_SERVER['REQUEST_URI'] === '/wp-admin/' ){
        add_action( 'template_redirect', 'start_buffering', 1);
        add_action( 'shutdown', 'cache_page', 0 );
    }
}




/**
 * Adding Cache
 * 
 * @package silohon-fast
 */
function start_buffering() {
    ob_start();
}

function cache_page() {
    $fast_cache_time = !empty($cacheOption['time']) ? $cacheOption['time'] : 86400;
    $fast_cache_file = FAST_DIR . '/cache/temp/' . md5($_SERVER['REQUEST_URI']) . '.html';
    
    if (file_exists($fast_cache_file) && (time() - filemtime($fast_cache_file)) < $fast_cache_time) {

        header('X-Cache: HIT');

        ob_end_clean();

        readfile($fast_cache_file);

        exit;
    } else {
        header('X-Cache: MISS');
    }
    
    $cached_output = ob_get_contents();
    ob_end_clean();

    if (!empty($cached_output)) {
        if (!file_exists(dirname($fast_cache_file))) {
            mkdir(dirname($fast_cache_file), 0755, true);
        }

        file_put_contents($fast_cache_file, $cached_output);
    }

    echo $cached_output;
}



/**
 * Remove All Cahce if post published
 * 
 * @package silohon-fast
 */
add_action( 'save_post', 'fast_remove_cache_if_action_save_post' );
function fast_remove_cache_if_action_save_post( $id ){
    $cache_dir = FAST_DIR . '/cache/temp/';
    
    // Hapus semua file cache di direktori
    $cache_files = glob($cache_dir . '*.html');
    if (!empty( $cache_files )) {
        foreach ($cache_files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}