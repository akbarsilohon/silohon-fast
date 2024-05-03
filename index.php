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
                            <span class="catBox">
                                <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5.676,8.237-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,1,1,1.414-1.414l2.323,2.323,5.294-4.853a1,1,0,1,1,1.352,1.474Z"></path></g></svg>
                                <div class="catBoxs">
                                    <?php fast_cat_no_link(); ?>
                                </div>
                            </span>
                        </div>
                    </a>
                </article>

                <?php
            }
        ?>

        <div class="tblockStyle">

            <div class="section_cat">
                <span class="in_single_tag">New Article</span>
            </div>

            <?php 
            $i = 0;
            while( $indexQuery->have_posts() ){
                $indexQuery->the_post();
                $i ++; ?>

                <article id="post-<?php the_ID() ?>" class="dblock">
                    <div class="grid-2-250">
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
    
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                    <?php  fast_render_tag(get_the_ID()); ?>
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