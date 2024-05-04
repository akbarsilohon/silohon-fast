<?php
/**
 * Custom color theme Silohon Fast Load
 * 
 * Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'color1', null, null, 'fast-color' );
register_setting( 'fast-settings-color', 'color_option' );


/**
 * Main color options
 * 
 * @package silohon-fast
 */
add_settings_field( 'main-color', 'Main Color', function(){
    $option = get_option('color_option');
    $value = !empty($option['main']) ? $option['main'] : '#e5ac1b'; ?>

    <input type="color" name="color_option[main]" value="<?php echo $value; ?>" >

    <?php
}, 'fast-color', 'color1' );