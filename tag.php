<?php
/**
 * Template handler part single tag
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 */

get_header();

if(have_posts()){ ?>

    <div class="container fastPosts">
        <div class="section_cat">
            <span class="in_single_tag">#<?php echo single_cat_title(); ?></span>
        </div>

        <div class="tblockStyle">
            <?php while( have_posts()){
                the_post(); ?>

                <article id="post-<?php the_ID() ?>" class="dblock">
                    <div class="grid-2-250">
                        <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="fastSmall">
                            <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'mediumThumbnmail', 'lazy'); ?>
                        </a>
                        <div class="bodyBlock">
                            <div class="meta">
                                <span class="theauthor">
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                </span>
                                <span class="sparator">></span>
                                <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                            </div>
                            <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                                <?php the_title('<h2 class="secondTitle">', '</h2>') ?>
                            </a>
    
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    
                    <div class="catBox">
                        <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5.676,8.237-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,1,1,1.414-1.414l2.323,2.323,5.294-4.853a1,1,0,1,1,1.352,1.474Z"></path></g></svg>
                        <?php fast_cat_link(); ?>
                    </div>

                </article>

                <?php
            } ?>
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