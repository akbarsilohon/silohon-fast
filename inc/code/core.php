<?php
/**
 * Add Shortcode Silohon Fast Load
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */


/**
 * Register tinyMCE button for ease using shortcode
 * 
 * @package silohon-fast
 */
define( 'fast_js_shortcode', FAST_URI . '/inc/code/shortcode.js' );
add_action( 'admin_init', 'fast_register_tinymce_buttons' );
function fast_register_tinymce_buttons(){
    global $typenow;

    if( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ){
        return;
    }

    if( get_user_option('rich_editing') === 'true' ){
        add_filter( 'mce_external_plugins', 'fast_mce_external_plugins' );
        add_filter( 'mce_buttons', 'fast_mce_buttons' );
    }

    function fast_mce_external_plugins( $plugin_array ){
        $plugin_array['fast_mce'] = fast_js_shortcode;
        return $plugin_array;
    }

    function fast_mce_buttons( $buttons ){
        array_push( $buttons, 'fast_mce' );

        return $buttons;
    }
}




/**
 * FAQs
 * 
 * Silohon Fast Load
 * 
 * @package silohon-fast
 */
add_shortcode( 'add_faq', 'silohon_fast_faqs_shortcode' );
function silohon_fast_faqs_shortcode( $atts, $content = null ){
    $judul = !empty($atts['judul']) ? $atts['judul'] : 'FAQs';
    $intro = !empty($atts['paragraf']) ? '<p>'. $atts['paragraf'] .'</p>' : '';

    preg_match_all('/\[faq_q\](.*?)\[\/faq_q\](?:\s*<p>|\s*<\/p>)/s', $content, $question_matches);
    preg_match_all('/\[faq_a\](.*?)\[\/faq_a\](?:\s*<p>|\s*<\/p>)/s', $content, $answer_matches);

    $html = '<h2>'. $judul .'</h2>';
    $html .= $intro;

    $html .= '<style>.slsFaqs{margin-bottom:25px}.slsFaqTanya{display:flex;align-items:center;justify-content:space-between;gap:1rem;font-weight:700;padding-bottom:1rem;border-bottom:1px solid var(--main-color);margin-bottom:1rem}.slsFaqTanya .slsQuestion{font-family:"Roboto Slab", serif;font-size:16px;color:#444;line-height:1.5}.slsFaqTanya #faqToggle{background-color:var(--main-color);color:#fff;padding:5px 10px;cursor:pointer;height:max-content}.slsFaqJawab{font-size:18px;line-height:2;color:#444;word-wrap:break-word;margin-bottom:1rem;}@media(max-width:560px){.slsFaqJawab,.slsFaqTanya .slsQuestion{font-size:16px}}</style>';

    $html .= '<div class="slsFaqs">';

    for($i = 0; $i < count($question_matches[1]); $i++){
        $question = trim(strip_tags($question_matches[1][$i]));
        $answer = trim(strip_tags($answer_matches[1][$i]));

        $html .= '<div class="slsFaqTanya">';
        $html .= '<span class="slsQuestion">'.esc_html( $question ).'</span>';
        $html .= '<span id="faqToggle">-</span>';
        $html .= '</div>';

        $html .= '<div class="slsFaqJawab">';
        $html .= $answer;
        $html .= '</div>';
    }

    $html .= '</div>';

    $use_faq_meta = get_post_meta( get_the_ID(), 'fast_faq_meta', true );
    if($use_faq_meta === 'true'){
        $json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => array()
        );
    
        for( $i = 0; $i < count($question_matches[1]); $i++ ){
            $question = trim(strip_tags($question_matches[1][$i]));
            $answer = trim(strip_tags($answer_matches[1][$i]));
    
            $json_ld["mainEntity"][] = array(
                "@type" => "Question",
                "name" => esc_html( $question ),
                "acceptedAnswer" => array(
                    "@type" => "Answer",
                    "text" => esc_html( $answer )
                )
            );
        }
    
        $json_ld_string = json_encode($json_ld, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $html .= '<script type="application/ld+json">' . $json_ld_string . '</script>';
    }

    $html .= '
        <script>
            document.addEventListener( "click", function( event ){
                var toggleButton = event.target;
                if( toggleButton.id === "faqToggle" ){
                    var answer = toggleButton.parentNode.nextElementSibling;
                    if( answer.style.display === "none" ){
                        answer.style.display = "block";
                        toggleButton.textContent = "-";
                    } else{
                        answer.style.display = "none";
                        toggleButton.textContent = "+";
                    }
                }
            });
        </script>
    ';


    return $html;
}



/**
 * Youtube Shortcode
 * 
 * @package silohon-fast
 */
add_shortcode( 'add_youtube', 'silohon_fast_youtube_shortcode' );
function silohon_fast_youtube_shortcode( $atts ){
    $vidID = $atts['videoid'];
    $judulVideo = !empty( $atts['title']) ? $atts['title'] : 'Youtube Video Player';

    if( !empty($vidID)){
        $shortCodeYt = '<div style="width: 100%;height: 100%;box-shadow: 6px 6px 10px rgba(0, 0, 0, .3);margin-bottom: 25px;">';
        $shortCodeYt .= '<div style="position: relative;padding-bottom: 56.15%;height: 0;overflow: hidden;">';
        $shortCodeYt .= '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%; border: 0;" loading="lazy" srcdoc="<style>*{padding:0;margin:0;overflow:hidden}body,html{height:100%}img{position:absolute;width:100%;height:auto;top:0;bottom:0;margin:auto}svg{filter:drop-shadow(1px 1px 6px hsl(206.5, 70.7%, 8%));transition:250ms ease-in-out}body:hover svg{filter:drop-shadow(1px 1px 6px hsl(206.5, 0%, 10%);)}svg {position: absolute;width: 50px;height: auto;left: 50%;top: 50%;transform: translate(-50%, -50%);}</style><a href=\'https://www.youtube.com/embed/'. $vidID .'?autoplay=1\'><img src=\'https://i.ytimg.com/vi/'. $vidID .'/sddefault.jpg\' alt=\''. $judulVideo .'\'><svg width=\'64px\' height=\'64px\' viewBox=\'0 -3 20 20\' version=\'1.1\' xmlns=\'http://www.w3.org/2000/svg\' xmlns:xlink=\'http://www.w3.org/1999/xlink\' fill=\'#e74b2c\'><g id=\'SVGRepo_bgCarrier\' stroke-width=\'0\'></g><g id=\'SVGRepo_tracerCarrier\' stroke-linecap=\'round\' stroke-linejoin=\'round\'></g><g id=\'SVGRepo_iconCarrier\'><title>youtube [#e74b2c]</title><desc>Created with Sketch.</desc><defs> </defs><g id=\'Page-1\' stroke=\'none\' stroke-width=\'1\' fill=\'none\' fill-rule=\'evenodd\'> <g id=\'Dribbble-Light-Preview\' transform=\'translate(-300.000000, -7442.000000)\' fill=\'#fff\'><g id=\'icons\' transform=\'translate(56.000000, 160.000000)\'><path d=\'M251.988432,7291.58588 L251.988432,7285.97425 C253.980638,7286.91168 255.523602,7287.8172 257.348463,7288.79353 C255.843351,7289.62824 253.980638,7290.56468 251.988432,7291.58588 M263.090998,7283.18289 C262.747343,7282.73013 262.161634,7282.37809 261.538073,7282.26141 C259.705243,7281.91336 248.270974,7281.91237 246.439141,7282.26141 C245.939097,7282.35515 245.493839,7282.58153 245.111335,7282.93357 C243.49964,7284.42947 244.004664,7292.45151 244.393145,7293.75096 C244.556505,7294.31342 244.767679,7294.71931 245.033639,7294.98558 C245.376298,7295.33761 245.845463,7295.57995 246.384355,7295.68865 C247.893451,7296.0008 255.668037,7296.17532 261.506198,7295.73552 C262.044094,7295.64178 262.520231,7295.39147 262.895762,7295.02447 C264.385932,7293.53455 264.28433,7285.06174 263.090998,7283.18289\' id=\'youtube-[#e74b2c]\'></path></g></g></g></g></svg></a>"frameborder="0"allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"referrerpolicy=" strict-origin-when-cross-origin" allowfullscreen></iframe>';
        $shortCodeYt .= '</div>';
        $shortCodeYt .= '</div>';

        return $shortCodeYt;
    }
}


/**
 * Related Posts Shortcode
 * 
 * @package silohon-fast
 */
add_shortcode( 'add_irp', 'silohon_fast_irp_shortcode' );
function silohon_fast_irp_shortcode( $id ){
    $id_post = $id['id'];
    $id_rel = !empty($id['rel']) ? $id['rel'] : 'dofollow';
    $id_target = !empty( $id['target'] ) ? $id['target'] : '_self';
    
    $myOption = get_option('irp_option');

    $irp_button = !empty($myOption['button']) ? $myOption['button'] : 'Read more';
    $background_color = !empty($myOption['bg']) ? $myOption['bg'] : '#e5ac1b';
    $button_bg_color = !empty($myOption['button_bg']) ? $myOption['button_bg'] : '#000000';
    $button_color = !empty($myOption['button_color']) ? $myOption['button_color'] : '#ffffff';
    $title_color = !empty($myOption['title_color']) ? $myOption['title_color'] : '#000000';

    if( !empty( $id_post )){

        $thumbnailUri = '';
        if(has_post_thumbnail( $id_post )){
            $thumbnailUri = get_the_post_thumbnail_url( $id_post, 'medium' );
            $printImage = '<img src="' . $thumbnailUri . '" alt="' . get_the_title($id_post) . '" loading="lazy" class="re-thumbnail"/>';
        } else{
            $getContent = get_post_field('post_content', $id_post);
            $array_thumbnail = '';

            preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $getContent, $array_thumbnail);
            if(!empty($array_thumbnail[1])){
                $thumbnailUri = esc_url( $array_thumbnail[1] );
                $printImage = '<img src="' . $thumbnailUri . '" alt="' . get_the_title($id_post) . '" loading="lazy" class="re-thumbnail"/>';
            } else{
                $printImage = '<div class="re-thumbnail"></div>';
            }
        }

        $irp_output = '<a href="'. get_the_permalink( $id_post ) .'" title="'. get_the_title( $id_post ) .'" target="'. $id_target .'" rel="'. $id_rel .'" class="silohon-irp" style="background-color: '. $background_color .';border-left: 4px solid '. $button_bg_color .';">';
        $irp_output .= '<div class="irp-relative">';
        $irp_output .= '<span class="irp-button" style="background-color: '. $button_bg_color .'; color: '. $button_color .';">'. esc_attr($irp_button) .'</span>';
        $irp_output .= '<p class="irp-title" style="color: '. $title_color .';">'. esc_attr(get_the_title($id_post)) .'</p>';
        $irp_output .= '</div>';
        $irp_output .= $printImage;
        $irp_output .= '</a>';

        return $irp_output;
    }
}