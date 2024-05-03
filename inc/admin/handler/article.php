<?php
/**
 * Render option for article ================
 * ==========================================
 */


/**
 * Section posts
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */
add_settings_section( 'section-post', '<h1 class="fast-admin-section">Archive</h1>', null, 'fast-article' );
register_setting( 'fast-settings-article', 'fast_article' );


/**
 * The Excerpt Length
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-excerpt', 'Excerpt Length', function(){
    $option = get_option('fast_article');
    $value = !empty($option['len']) ? $option['len'] : 15; ?>

    <input type="number" name="fast_article[len]" value="<?php echo $value; ?>">

    <?php
}, 'fast-article', 'section-post' );



add_settings_section( 'sec-post', '<h1 class="fast-admin-section">Single Post</h1>', null, 'fast-article' );
/**
 * Thumbnails option
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-thumb', 'Show Thumbnail', function(){
    $option = get_option('fast_article');
    $value = !empty($option['thumb'] && $option['thumb'] === 'true' ) ? 'checked' : ''; ?>

    <input type="checkbox" name="fast_article[thumb]" value="true" <?php echo $value ?>>

    <?php
}, 'fast-article', 'sec-post' );


/**
 * Tag options
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-tag', 'Show Tag', function(){
    $option = get_option('fast_article');
    $value = !empty($option['tag'] && $option['tag'] === 'true' ) ? 'checked' : ''; ?>

    <input type="checkbox" name="fast_article[tag]" value="true" <?php echo $value ?>>

<?php
}, 'fast-article', 'sec-post' );



/**
 * Related Posts Shor Or Not
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-rel', 'Show Related Posts', function(){
    $option = get_option('fast_article');
    $value = !empty($option['related'] && $option['related'] === 'true' ) ? 'checked' : ''; ?>

    <input type="checkbox" name="fast_article[related]" value="true" <?php echo $value; ?>>
    <?php
}, 'fast-article', 'sec-post' );


/**
 * Related Count
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-recount', 'Related Count', function(){
    $option = get_option('fast_article');
    $value = !empty($option['recount']) ? $option['recount'] : 4; ?>

    <input type="number" name="fast_article[recount]" value="<?php echo $value; ?>">

<?php
}, 'fast-article', 'sec-post' );



/**
 * Open Comments
 * 
 * @package silohon-fast
 */
add_settings_field( 'fast-comment', 'Open Comments', function(){
    $option = get_option('fast_article');
    $value = !empty($option['comment'] && $option['comment'] === 'true' ) ? 'checked' : ''; ?>

    <input type="checkbox" name="fast_article[comment]" value="true" <?php echo $value; ?>>

    <?php
}, 'fast-article', 'sec-post' );