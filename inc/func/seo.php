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