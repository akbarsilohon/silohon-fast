<?php
/**
 * Handler SEO Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'seo1', null, null, 'fast-seo' );
register_setting( 'fast-settings-seo', 'seo_one' );

/**
 * Redirect to homepage
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-redirect', 'Redirect 404 to Homepage', function(){
    $redirect = get_option('seo_one'); ?>

    <input type="checkbox" name="seo_one[redirect]" value="true" <?php if(!empty($redirect['redirect']) && $redirect['redirect'] === 'true') echo 'checked';  ?>>

    <?php
}, 'fast-seo', 'seo1' );