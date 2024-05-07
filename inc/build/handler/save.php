<?php
/**
 * Save page builder meta
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_action( 'save_post', 'fast_save_builder_meta' );
function fast_save_builder_meta( $post_id ){
    global $post;

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return $post_id;
    }


    /**
     * This checking builder active or not
     * 
     * @package silohon-fast
     */
    $builder = $_POST['builder_active'];
    if( isset($builder) && !empty($builder)){
        update_post_meta( $post_id, 'builder_active', 'true' );
    } else{
        delete_post_meta( $post_id, 'builder_active' );
    }


    /**
     * carousel handler save meta
     * 
     * @package silohon-fast
     */
    $carousel = $_POST['carousel'];
    if(isset($carousel) && !empty($carousel) && $carousel['active'] == 'true' ){
        $hero_data = $carousel;
        array_walk_recursive( $hero_data, function(&$value){
            $value = sanitize_text_field($value);
        });

        update_post_meta( $post_id, 'carousel', $hero_data );
    } else{
        delete_post_meta( $post_id, 'carousel' );
    }


    /**
     * List style call or render
     * 
     * @package silohon-fast
     */
    $buider_data = $_POST['sls_builder_data'];
    if(isset($buider_data) && !empty($buider_data)){
        $data = $buider_data;
        array_walk_recursive( $data, function(&$value){
            $value = sanitize_text_field($value);
        });

        update_post_meta( $post_id, 'sls_data', $data );
    } else{
        delete_post_meta( $post_id, 'sls_data' );
    }
}



/**
 * Action generate post meta boxes
 * 
 * @package silohon-fast
 */
add_action( 'add_meta_boxes', 'fast_add_builder_metabox' );
function fast_add_builder_metabox(){
    if(is_gutenberg_editing()){
        add_meta_box( 'is_not_classic_editor', esc_html__( "Can't Call Page Builder", 'silohon-fast' ), null, 'page', 'normal', 'high' );
    } else{
        add_action( 'edit_form_after_title', 'fast_render_page_builder' );
    }
}





/**
 * Editor Handler for classic Editor Only
 * 
 * @package silohon
 */
function is_gutenberg_editing(){
    if(version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' )){
        $current_screen = get_current_screen();
        if($current_screen->is_block_editor()){
            return true;
        }
    }

    return false;
}