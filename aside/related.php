<?php
/**
 * Related Posts Silohon Fast Load
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */ 

$countCheck = get_option('fast_article');
$count = !empty( $countCheck['recount']) ? $countCheck['recount'] : 4;

$related = get_posts(
    array(
        'category__in'          =>  wp_get_post_categories($post->ID),
        'numberposts'           =>  $count,
        'post__not_in'          =>  array($post->ID),
    )
);

if( $related ){ ?>

    <aside class="dblok">
        <div class="section_cat">
            <span class="in_single_tag">Related Posts</span>
        </div>

        <div class="tblockStyle">
            <?php 
            foreach( $related as $post ){
                setup_postdata( $post ); ?>

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
                                <span class="sparator">/</span>
                                <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                            </div>

                            <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                                <?php the_title('<h2 class="secondTitle">', '</h2>') ?>
                            </a>
                        </div>
                    </div>
                </article>

                <?php
            }
            

            wp_reset_postdata();
            ?>
        </div>
    </aside>

<?php
}