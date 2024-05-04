<?php
/**
 * SEO Meta handler for single post
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

function fast_generate_img_meta_seo($id){
    $printImg = null;

    if(has_post_thumbnail( $id )){
        $printImg .= '<meta itemprop="image" content="'. get_the_post_thumbnail_url( $id, 'thumbnail' ) .'" />';
        $printImg .= '<meta itemprop="image" content="'. get_the_post_thumbnail_url( $id, 'medium' ) .'" />';
        $printImg .= '<meta itemprop="image" content="'. get_the_post_thumbnail_url( $id, 'large' ) .'" />';
        $printImg .= '<meta itemprop="image" content="'. get_the_post_thumbnail_url( $id, 'full' ) .'" />';
    } else{
        $getContent = get_the_content( null, false, $id );
        $img = '';

        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $getContent, $img);
        if(!empty( $img[1] )){
            $printImg .= '<meta itemprop="image" content="'. $img[1] .'" />';
        }
    }

    echo $printImg;
}



/**
 * Redirect 404 to homepage
 * 
 * @package silohon-fast
 */
$redirect = get_option('seo_one');
if(!empty($redirect['redirect']) && $redirect['redirect'] === 'true' ){
    add_action( 'template_redirect', 'fast_handler_404_redirect' );

    function fast_handler_404_redirect(){
        if(is_404() && $_SERVER['REQUEST_URI'] !== '/404'){
            wp_redirect(home_url());
            exit();
        }
    }
}