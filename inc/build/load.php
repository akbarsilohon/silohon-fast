<?php
/**
 * Load page builder panel
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */


require FAST_DIR . '/inc/build/handler/save.php';


/**
 * Render Page builder
 * 
 * @package silohon-fast
 */
function fast_render_page_builder(){
    global $post;
    $screen = get_current_screen();

    if( get_post_type( $post->ID ) != 'page' && $screen->post_type != 'page' ){
        return;
    }

    $get_meta = get_post_custom( $post->ID );

    $categories_obj = get_categories('hide_empty=0');
	$categories 	= array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	} ?>

    <a href="" class="button button-large <?php if( !empty( $get_meta['builder_active'])) echo 'button-primary builder-active' ?>" id="fast_call_builder">
        <?php 
            if(!empty($get_meta['builder_active']) && $get_meta['builder_active'] === 'true' ){
                echo 'Remove Builder';
            } else{
                echo 'Use Builder';
            }
        ?>
    </a>

    <input type="hidden" name="builder_active" id="builder_active" value="<?php if( !empty( $get_meta['builder_active']) && $get_meta['builder_active'][0] == 'true' ) echo 'true'; ?>">

    <div id="fastHomeBuilder" <?php if( !empty( $get_meta['builder_active']) && $get_meta['builder_active'][0] == 'true' ) echo 'style="display:block;"'; ?>>
        <h1>Page Builder</h1>
    </div>

    <?php
}