<?php
/**
 * After setup theme
 * 
 * Silohon Fast Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

add_action( 'after_setup_theme', 'fast_after_setup_theme' );
function fast_after_setup_theme(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );


    register_nav_menus(
        array(
            'header'        =>  __('Menu Header Primary', 'silohon-fast'),
            'footer'        =>  __('Menu Footer', 'silohon-fast')
        )
    );
}




/**
 * Defaut favicon Silohon Fast Load
 * 
 * Wordpress Theme
 * 
 * @package silohon-fast
 */
$siteIcon = get_site_icon_url();
if(empty( $siteIcon )){
    add_action( 'admin_head', 'fast_generate_favicon' );
    add_action( 'wp_head', 'fast_generate_favicon' );
    add_action( 'login_enqueue_scripts', 'fast_generate_favicon' );
}

function fast_generate_favicon(){
    $fastIcon = FAST_URI . '/asset/img/favicon.png'; ?>
    <link rel="shortcut icon" href="<?php echo esc_url( $fastIcon ); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo esc_url( $fastIcon ); ?>">
    <?php
}




/**
 * Generate Post Thumbnail
 * 
 * @package silohon-fast
 */
function fast_generate_thumbnail( $id, $size, $class, $loading ){
    $thumbnail = '';
    if( has_post_thumbnail( $id )){
        $thumbnail .= get_the_post_thumbnail( 
            $id,
            $size,
            array(
                'class'         =>  $class,
                'loading'       =>  $loading
            )
        );
    } else{
        $getContent = get_the_content( null, false, $id );
        $cover .= '';

        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $getContent, $cover);

        if(!empty($cover[1])){
            $lazyload = get_option('fast_main')['lazyload'];
            if(!empty($lazyload) && $lazyload === 'true'){
                $thumbnail .= '<img width="350" height="300" src="'. FAST_URI . '/asset/img/lazy.jpg' .'" data-src="'. $cover[1] .'" class="'. $class .'" alt="'.get_the_title($id).'" loading="'.$loading.'"/>';
            } else{
                $thumbnail .= '<img width="350" height="300" src="'. $cover[1] .'" class="'. $class .'" alt="'.get_the_title($id).'" loading="'.$loading.'"/>';
            }
        } else{
            $thumbnail .= '<div class="'.$class.'"></div>';
        }
    }

    return $thumbnail;
}




/**
 * Custom Robots
 * 
 * @package silohon-fast
 */
add_filter( 'wp_robots', 'fast_custom_robots_tag' );
function fast_custom_robots_tag( $robots ){

    $robots = array(
        'index'                 =>  true,
        'follow'                =>  true,
        'max-image-preview'     =>  'large',
        'max-snippet'           =>  '-1',
        'max-video-preview'     =>  '-1'
    );

    return $robots;
}



/**
 * Render category
 * 
 * @package silohon-fast
 */
function fast_cat_link(){
    $categories = get_the_category();
    $sparator = ', ';
    $output = '';
    $i = 1;

    if(!empty($categories)){
        foreach( $categories as $category ){
            if( $i > 1 ){
                $output .= $sparator;
            }

            $output = '<a class="fastCatLink" href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="'. esc_html( $category->name ) .'">' . esc_html( $category->name ) . '</a>';
        }
    }

    echo $output;
}

function fast_cat_no_link(){
    $categories = get_the_category();
    $sparator = ', ';
    $output = '';
    $i = 1;

    if(!empty($categories)){
        foreach( $categories as $category ){
            if( $i > 1 ){
                $output .= $sparator;
            }

            $output = esc_html( $category->name );
        }
    }

    echo $output;
}




/**
 * Render Tag
 * 
 * @package silohon-fast
 */
function fast_render_tag( $id ){
    $tags = get_the_tags($id);
    $output = '';

    if ($tags) {
        
        $output .= '<div class="tagOutput">';
        $output .= '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M7.0498 7.0498H7.0598M10.5118 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V10.5118C3 11.2455 3 11.6124 3.08289 11.9577C3.15638 12.2638 3.27759 12.5564 3.44208 12.8249C3.6276 13.1276 3.88703 13.387 4.40589 13.9059L9.10589 18.6059C10.2939 19.7939 10.888 20.388 11.5729 20.6105C12.1755 20.8063 12.8245 20.8063 13.4271 20.6105C14.112 20.388 14.7061 19.7939 15.8941 18.6059L18.6059 15.8941C19.7939 14.7061 20.388 14.112 20.6105 13.4271C20.8063 12.8245 20.8063 12.1755 20.6105 11.5729C20.388 10.888 19.7939 10.2939 18.6059 9.10589L13.9059 4.40589C13.387 3.88703 13.1276 3.6276 12.8249 3.44208C12.5564 3.27759 12.2638 3.15638 11.9577 3.08289C11.6124 3 11.2455 3 10.5118 3ZM7.5498 7.0498C7.5498 7.32595 7.32595 7.5498 7.0498 7.5498C6.77366 7.5498 6.5498 7.32595 6.5498 7.0498C6.5498 6.77366 6.77366 6.5498 7.0498 6.5498C7.32595 6.5498 7.5498 6.77366 7.5498 7.0498Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';
        $output .= '<div class="tagLoop">';

        foreach( $tags as $tag ){
            $output .= '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" title="' . esc_html($tag->name) . '" class="tagLink">#' . esc_html($tag->name) . '</a> ';
        }

        $output .= '</div>';
        $output .= '</div>';
    }
    
    echo $output;
}





/**
 * The Excerpt
 * 
 * @package silohon-fast
 */
add_filter( 'excerpt_more', function(){
    return '...';
});

add_filter( 'the_excerpt', function(){
    return '<p class="fastExcerpt">'. get_the_excerpt() .'</p>';
});

add_filter( 'excerpt_length', function(){
    $length = get_option('fast_article');
    if( !empty( $length['len'])){
        return $length['len'];
    } else{
        return 15;
    }
});




/**
 * Custom Layload Img Silohon Fast Load
 * 
 * @package silohon-fast
 */
$lazy = get_option('fast_main')['lazyload'];
if(!empty($lazy) && $lazy === 'true' && ! is_admin()){
    add_filter( 'the_content', 'lazy_load_conten_img' );
    add_filter( 'widget_text', 'lazy_load_conten_img' );

    add_filter( 'wp_get_attachment_image_attributes', 'fast_img_attchment_attributes', 10, 2 );

    function lazy_load_conten_img( $content ){
        $content = preg_replace( '/(<img.+?)(src)(\s*=\s*["\']([^"\']*)["\'])/i', '$1data-$2$3', $content );
        return $content;
    }

    function fast_img_attchment_attributes( $atts, $attachment ){
        $atts[ 'data-src' ] = $atts[ 'src' ];
        $atts[ 'src' ] = FAST_URI . '/asset/img/lazy.jpg';

        if( isset( $atts[ 'srcset' ])){
            unset( $atts[ 'srcset' ] );
        }

        return $atts;
    }
}