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



/**
 * Render data organization schema
 * 
 * @package silohon-fast
 */
function fast_render_organization_schema(){
    $organization = get_option('seo_two');

    if(empty($organization['organization'])){
        return;
    }
    
    $outputJSON = '<script type="application/ld+json">{';
    $outputJSON .= '"@context": "https://schema.org",';
    $outputJSON .= '"@type": "Organization",';
    $outputJSON .= '"image": "'. $organization['image'] .'",';
    $outputJSON .= '"url": "'. $organization['url'] .'",';
    $outputJSON .= '"sameAs": ' . json_encode($organization['sameAs']) . ',';
    $outputJSON .= '"logo": "'. $organization['logo'] .'",';
    $outputJSON .= '"name": "'. $organization['name'] .'",';
    $outputJSON .= '"description": "'. $organization['description'] .'",';
    $outputJSON .= '"email": "'. $organization['email'] .'",';
    $outputJSON .= '"telephone": "'. $organization['telephone'] .'",';
    $outputJSON .= '"address": {';
    $outputJSON .= '"@type": "PostalAddress",';
    $outputJSON .= '"streetAddress": "'. $organization['streetAddress'] .'",';
    $outputJSON .= '"addressLocality": "'. $organization['addressLocality'] .'",';
    $outputJSON .= '"addressCountry": "'. $organization['addressCountry'] .'",';
    $outputJSON .= '"addressRegion": "'. $organization['addressRegion'] .'",';
    $outputJSON .= '"postalCode": "'. $organization['postalCode'] .'"';
    $outputJSON .= '},';
    $outputJSON .= '"vatID": "'. $organization['vatID'] .'",';
    $outputJSON .= '"iso6523Code": "'. $organization['iso6523Code'] .'"';
    $outputJSON .= '}</script>';

    echo $outputJSON;
}
add_action('wp_head', 'fast_render_organization_schema');


/**
 * Add ID to Heading single posts
 * 
 * @package silohon-fast
 */
function generate_toc_and_add_id_to_heading($content) {
    $autoTOC = get_option('fast_article');
    $disable_toc = get_post_meta( get_the_ID(), 'fast_disable_toc', true );
    if(empty($autoTOC['toc']) || $disable_toc === 'true' ){
        return $content;
    } else{
        preg_match('/<h2>(.*?)<\/h2>/i', $content, $first_h2_match, PREG_OFFSET_CAPTURE);

        if (!empty($first_h2_match)) {
            $toc = generate_toc($content);
            $content = substr_replace($content, $toc, $first_h2_match[0][1], 0);
        }

        $content = preg_replace_callback('/<h([2-3])>(.*?)<\/h[2-3]>/i', function($matches) {
            $tag = $matches[1];
            $text = $matches[2];
            $isReplace = array(
                ' ', '.', ',', '-',
                '?', '!', '#', '*', '#', '"',
                '@', '$', '%', '^', '(', ')', '+',
                '=', '{', '}', '[', ']', ':', '\''
            );
            $id = strtolower(str_replace($isReplace, '_', preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $text))));
            return '<h' . $tag . ' id="' . $id . '">' . $text . '</h' . $tag . '>';
        }, $content);

        return $content;
    }
}

function generate_toc($content) {
    $toc = '';

    // Build TOC
    $toc .= '<div class="silo_toc">';
    $toc .= '<div class="toc-title">';
    $toc .= '<p class="this_toc">Table of Contents:</p>';
    $toc .= '<div id="silo_icon_toc" class="silo_icon_toc">';
    $toc .= '<span></span><span></span><span></span>';
    $toc .= '</div>';
    $toc .= '</div>';
    $toc .= '<ul id="this_toc_counters">';

    // Iterate through all <h2> and <h3> tags
    preg_match_all('/<h([2-3])>(.*?)<\/h[2-3]>/i', $content, $matches);
    $level = 2; // Start at h2 level
    foreach ($matches[1] as $key => $tag) {
        $text = $matches[2][$key];
        $isReplace = array(
            ' ', '.', ',', '-',
            '?', '!', '#', '*', '#', '"',
            '@', '$', '%', '^', '(', ')', '+',
            '=', '{', '}', '[', ']', ':', '\''
        );
        $id = strtolower(str_replace($isReplace, '_', preg_replace('/\s+/', '-', preg_replace('/[^a-zA-Z0-9\s]/', '', $text))));
        if ($tag == 2) {
            if ($level > 2) {
                $toc .= '</ul></li>';
            }
            $toc .= '<li><a title="'. $text .'" href="#' . $id . '">' . $text . '</a>';
            $level = 2;
        } elseif ($tag == 3) {
            if ($level == 2) {
                $toc .= '<ul>';
            }
            $toc .= '<li><a title="'. $text .'" href="#' . $id . '">' . $text . '</a></li>';
            $level = 3;
        }
    }

    if ($level == 3) {
        $toc .= '</ul>';
    }

    $toc .= '</ul>';
    $toc .= '</div>';
    $toc .= "<script>const thisTOC = document.getElementById('silo_icon_toc');const thiTOCTar = document.getElementById('this_toc_counters');thisTOC.addEventListener('click', function(){thiTOCTar.classList.toggle('tocNone');});</script>";

    return $toc;
}
add_filter('the_content', 'generate_toc_and_add_id_to_heading', 12 );


/**
 * Remove <br> in the_content() function
 * 
 * @package silohon-fast
 */
add_filter( 'the_content', 'fast_remove_tag_br', 11 );
function fast_remove_tag_br( $content ){
    // Menghapus tag <br>, spasi, dan baris baru sebelum atau sesudahnya
    $content = preg_replace('/\s*<br\s*\/?>\s*|\s*\n\s*<br\s*\/?>\s*|\s*<br\s*\/?>\s*\n\s*|\s*\n\s*/i', '', $content);
    return $content;
}