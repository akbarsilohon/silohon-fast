<?php
/**
 * Index file
 * 
 * Silohon Fast load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

get_header();

$page = get_option('posts_per_page');
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

$indexQuery = new WP_Query(
    array(
        'post_type'         =>  'post',
        'post_status'       =>  'publish',
        'posts_per_page'    =>  $page,
        'paged'             =>  $paged
    )
);

$i = 0;

if($indexQuery->have_posts()){ ?>

    <div class="container fastPosts">
        <?php 
            $count = $indexQuery->post_count;
            while( $i < min( 1, $count ) && $indexQuery->have_posts()){
                $indexQuery->the_post();
                $i ++; ?>

                <article id="post-<?php the_ID(); ?>" class="fastCover">
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" rel="bookmark" class="fastRelative">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'full', 'imgCover', 'eager' ); ?>
                        <div class="bodyAbsolute">
                            <div class="meta">
                                <span class="author">By <?php the_author(); ?></span>
                                <span class="sparator">></span>
                                <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                            </div>
                            <?php the_title('<h2 class="coverTitle">', '</h2>'); ?>
                        </div>
                    </a>
                </article>

                <?php
            }
        ?>

        <div class="fg2 mg3">
            <?php 
            $i = 0;
            while( $indexQuery->have_posts() ){
                $indexQuery->the_post();
                $i ++; ?>

                <article id="post-<?php the_ID() ?>" class="dblok">
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="fastSmall">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'mediumThumbnmail', 'lazy'); ?>
                    </a>

                    <div class="bodyBlock">
                        <div class="meta">
                            <?php fast_cat_link() ?>
                            <span class="sparator">></span>
                            <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                        </div>
                        <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                            <?php the_title('<h2 class="secondTitle">', '</h2>') ?>
                        </a>
                    </div>

                    <?php the_excerpt(); ?>

                    <div class="tagOutput">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M7.0498 7.0498H7.0598M10.5118 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V10.5118C3 11.2455 3 11.6124 3.08289 11.9577C3.15638 12.2638 3.27759 12.5564 3.44208 12.8249C3.6276 13.1276 3.88703 13.387 4.40589 13.9059L9.10589 18.6059C10.2939 19.7939 10.888 20.388 11.5729 20.6105C12.1755 20.8063 12.8245 20.8063 13.4271 20.6105C14.112 20.388 14.7061 19.7939 15.8941 18.6059L18.6059 15.8941C19.7939 14.7061 20.388 14.112 20.6105 13.4271C20.8063 12.8245 20.8063 12.1755 20.6105 11.5729C20.388 10.888 19.7939 10.2939 18.6059 9.10589L13.9059 4.40589C13.387 3.88703 13.1276 3.6276 12.8249 3.44208C12.5564 3.27759 12.2638 3.15638 11.9577 3.08289C11.6124 3 11.2455 3 10.5118 3ZM7.5498 7.0498C7.5498 7.32595 7.32595 7.5498 7.0498 7.5498C6.77366 7.5498 6.5498 7.32595 6.5498 7.0498C6.5498 6.77366 6.77366 6.5498 7.0498 6.5498C7.32595 6.5498 7.5498 6.77366 7.5498 7.0498Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <div class="tagLoop">
                            <?php  fast_render_tag(get_the_ID()); ?>
                        </div>
                    </div>
                </article>

                <?php
            }
            ?>
        </div>

        <div class="fastPagination">
            <?php 
                echo paginate_links(
                    array(
                        'mid_size'      =>  2,
                        'show_all'      =>  false,
                        'prev_next'     =>  true
                    )
                );
            ?>
        </div>
    </div>

<?php
}

get_footer();