<?php
/**
 * Handler insert HTML
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */


add_settings_section( 'ihf-sec', '<h1 class="fast-admin-section">Insert HTML</h1>', null, 'html-footer' );
register_setting( 'fast-settings-insert', 'fast_innseert' );

/**
 * Insert Header
 * 
 * @package silohon-fast
 */
add_settings_field( 'fdheader', 'HTML Header', function(){
    $htmls = get_option('fast_innseert')['header']; ?>

<textarea name="fast_innseert[header]" rows="5"><?php echo $htmls; ?></textarea>

    <?php
}, 'html-footer', 'ihf-sec' );



/**
 * Insert Footer
 * 
 * @package silohon-fast
 */
add_settings_field( 'fdfooter', 'HTML Footer', function(){
    $footer = get_option('fast_innseert')['footer']; ?>

<textarea name="fast_innseert[footer]" rows="5"><?php echo $footer; ?></textarea>

    <?php
}, 'html-footer', 'ihf-sec' );