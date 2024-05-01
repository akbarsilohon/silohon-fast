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
            $thumbnail .= '<img width="350" height="300" src="'. $cover[1] .'" class="'. $class .'" alt="'.get_the_title($id).'" loading="'.$loading.'"/>';
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
        foreach ($tags as $tag) {
            $output .= '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" title="' . esc_html($tag->name) . '" class="tagLink">#' . esc_html($tag->name) . '</a> ';
        }
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
    return 25;
});