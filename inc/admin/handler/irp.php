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


/**
 * Button text
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-button', 'Button text', function(){
    $option = get_option('irp_option');
    $value = !empty($option['button']) ? $option['button'] : 'Read more'; ?>

    <input type="text" name="irp_option[button]" value="<?php echo $value; ?>">

    <?php
}, 'fast-re', 'irp1' );


/**
 * Link Target _blank or _self
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-target', 'Link Target', function(){
    $option = get_option('irp_option');
    $value = !empty($option['target']) ? $option['target'] : '_self'; ?>

    <select name="irp_option[target]">
        <option value="_self" <?php selected($value, '_self'); ?>>_self</option>
        <option value="_blank" <?php selected($value, '_blank'); ?>>_blank</option>
    </select>

    <?php
}, 'fast-re', 'irp1' );


/**
 * Url type rel nofollow or dofollow
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-rel', 'Url type', function(){
    $option = get_option('irp_option');
    $value = !empty($option['rel']) ? $option['rel'] : 'nofollow'; ?>

    <select name="irp_option[rel]">
        <option value="nofollow" <?php selected($value, 'nofollow'); ?>>nofollow</option>
        <option value="dofollow" <?php selected($value, 'dofollow'); ?>>dofollow</option>
    </select>

    <?php
}, 'fast-re', 'irp1' );


/**
 * Related query
 * 
 * By Category
 * 
 * By Tags
 * 
 * By Author
 * 
 * All posts
 * 
 * @package silohon-fast
 */
add_settings_field( 'irp-query', 'Related query', function(){
    $option = get_option('irp_option');
    $value = !empty($option['query']) ? $option['query'] : 'category'; ?>

    <select name="irp_option[query]">
        <option value="category" <?php selected($value, 'category'); ?>>By Category</option>
        <option value="tags" <?php selected($value, 'tags'); ?>>By Tags</option>
        <option value="cat_tag" <?php selected($value, 'cat_tag'); ?>>By Category & Tags</option>
        <option value="all" <?php selected($value, 'all'); ?>>All posts</option>
    </select>

    <?php
}, 'fast-re', 'irp1' );