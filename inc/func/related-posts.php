<?php
/**
 * Render related posts
 * 
 * Silohon Fast Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$optionIrp = get_option('irp_option');
if( !empty($optionIrp['active']) && $optionIrp['active'] === 'true'){
    add_filter( 'the_content', 'fast_render_inline_related_posts', 99 );
}

function fast_render_inline_related_posts( $content ){
    global $post;
    $meta_checker = get_post_meta( $post->ID, 'fast_irp_disable', true );

    if( empty( $content ) || $meta_checker === 'true' ){
        return $content;
    } else{
        $option = get_option('irp_option');
        $irp_word = !empty($option['word']) ? $option['word'] : 250;
        $irp_repeat = !empty($option['repeat']) ? $option['repeat'] : 3;
        $irp_meta = fast_render_meta( $post->ID, $irp_repeat );
    
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        $xpath = new DOMXPath($dom);
        $fixWord = 0;
        $repeat_here = 0;
        $nodes = $xpath->query('//text()');
    
        foreach( $nodes as $node ){
            if( $node->parentNode->nodeName === 'p' ){
                $word = explode( ' ', trim( $node->nodeValue ));
                $word_count = count( $word );
                $fixWord += $word_count;
    
                if($fixWord >= $irp_word && !empty($irp_meta) && $repeat_here < $irp_repeat){
                    $fragment = $dom->createDocumentFragment();
                    $random_key = array_rand($irp_meta);
                    $random_post_id = $irp_meta[$random_key];
    
                    unset( $irp_meta[$random_key] );
    
                    $irp_content = create_html_output( $random_post_id );
                    if( !empty( $irp_content )){
                        $fragment->appendXML($irp_content);
    
                        if( $node->parentNode->nextSibling ){
                            $node->parentNode->parentNode->insertBefore($fragment, $node->parentNode->nextSibling);
                        } else{
                            $node->parentNode->parentNode->appendChild($fragment);
                        }
    
                        $fixWord = 0;
                        $repeat_here++;
                    }
                }
            }
        }
    
        $content = $dom->saveHTML();
        return $content;
    }

}


/**
 * Render Meta
 * 
 * @package silohon-fast
 */
function fast_render_meta( $id, $repeat ){
    $optionQuery = get_option('irp_option');
    $related = $optionQuery['query'];
    $cat = get_the_category( $id );
    $tags = wp_get_post_tags( $id, array('fields' => 'ids'));

    $args = array(
        'post_type'         =>  'post',
        'posts_per_page'    =>  $repeat,
        'post__not_in'      =>  array($id),
        'fields'            =>  'ids',
        'orderby'           =>  'rand'
    );

    if( $related === 'category'){
        $args['tax_query'] = array(
            'relation'  =>  'OR',
            array(
                'taxonomy'      =>  'category',
                'field'         =>  'term_id',
                'terms'         =>  wp_list_pluck($cat, 'term_id')
            )
        );
    } else if( $related === 'tags'){
        $args['tax_query'] = array(
            'relation'  =>  'OR',
            array(
                'taxonomy'  =>  'post_tag',
                'field'     =>  'term_id',
                'terms'     =>  $tags
            )
        );
    } else if( $related === 'cat_tag'){
        $args['tax_query'] = array(
            'relation'  =>  'OR',
            array(
                'taxonomy'  =>  'category',
                'field'     =>  'term_id',
                'terms'     =>  wp_list_pluck($cat, 'term_id')
            ),
            array(
                'taxonomy'  =>  'post_tag',
                'field'     =>  'term_id',
                'terms'     =>  $tags
            )
        );
    }

    $query = new WP_Query( $args );
    return $query->posts;
}


/**
 * Create Html Output on content
 * 
 * @package silohon-fast
 */
function create_html_output($post_id){

    $myOption = get_option('irp_option');

    $thumbnailUri = '';
    if(has_post_thumbnail( $post_id )){
        $thumbnailUri = get_the_post_thumbnail_url( $post_id, 'medium' );
        $printImage = '<img src="' . $thumbnailUri . '" alt="' . get_the_title($post_id) . '" loading="lazy" class="re-thumbnail"/>';
    } else{
        $getContent = get_post_field('post_content', $post_id);
        $array_thumbnail = '';

        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $getContent, $array_thumbnail);
        if(!empty($array_thumbnail[1])){
            $thumbnailUri = esc_url( $array_thumbnail[1] );
            $printImage = '<img src="' . $thumbnailUri . '" alt="' . get_the_title($post_id) . '" loading="lazy" class="re-thumbnail"/>';
        } else{
            $printImage = '<div class="re-thumbnail"></div>';
        }
    }

    $target = !empty($myOption['target']) ? $myOption['target'] : '_self';
    $type = !empty($myOption['rel']) ? $myOption['rel'] : 'nofollow';
    $irp_button = !empty($myOption['button']) ? $myOption['button'] : 'Read more';
    $background_color = !empty($myOption['bg']) ? $myOption['bg'] : '#e5ac1b';
    $button_bg_color = !empty($myOption['button_bg']) ? $myOption['button_bg'] : '#000000';
    $button_color = !empty($myOption['button_color']) ? $myOption['button_color'] : '#ffffff';
    $title_color = !empty($myOption['title_color']) ? $myOption['title_color'] : '#000000';


    $htmlOutput = '<a target="'. $target .'" href="'. esc_url(get_the_permalink($post_id)) .'" rel="'. $type .'" title="'. esc_attr(get_the_title($post_id)) .'" class="silohon-irp" style="background-color: '. $background_color .';border-left: 4px solid '. $button_bg_color .';">';
    $htmlOutput .= '<div class="irp-relative">';
    $htmlOutput .= '<span class="irp-button" style="background-color: '. $button_bg_color .'; color: '. $button_color .';">'. esc_attr($irp_button) .'</span>';
    $htmlOutput .= '<p class="irp-title" style="color: '. $title_color .';">'. esc_attr(get_the_title($post_id)) .'</p>';
    $htmlOutput .= '</div>';
    $htmlOutput .= $printImage;
    $htmlOutput .= '</a>';

    return $htmlOutput;
}
