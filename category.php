<?php
/**
 * Template handler part category
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 */

get_header();

if(have_posts()) { ?>

    <div class="container fastPosts">
        <div class="section_cat">
            <span class="in_single_tag"><?php echo single_cat_title(); ?></span>
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
                    <?php  fast_render_tag(get_the_ID()); ?>
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