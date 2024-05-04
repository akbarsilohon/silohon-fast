<?php
/**
 * Create Options related posts
 * 
 * Silohon Fast Load Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_settings_section( 'irp1', null, null, 'fast-re' );
register_setting( 'fast-settings-irp', 'irp_option' );


/**
 * Setting field active or not
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-active', 'Active?', function(){
    $option = get_option('irp_option');
    $value = (!empty($option['active']) && $option['active'] === 'true') ? 'checked' : ''; ?>

    <input type="checkbox" name="irp_option[active]" value="true" <?php echo $value; ?>>

    <?php
}, 'fast-re', 'irp1' );


/**
 * Repeat Inline related posts
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-repeat', 'Repeat', function(){
    $option = get_option('irp_option');
    $value = !empty($option['repeat']) ? $option['repeat'] : 3; ?>

    <input type="number" name="irp_option[repeat]" value="<?php echo $value; ?>" max="10">

    <?php
}, 'fast-re', 'irp1' );



/**
 * Inject per 250 for default value
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-word', 'Inject after', function(){
    $option = get_option('irp_option');
    $value = !empty($option['word']) ? $option['word'] : 250; ?>

    <input type="number" name="irp_option[word]" value="<?php echo $value; ?>">

    <?php
}, 'fast-re', 'irp1' );