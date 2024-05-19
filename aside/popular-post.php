<?php
/**
 * Render Outpus HTML for popular posts
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */


$countCheck = get_option('fast_article');
$count = !empty( $countCheck['recount']) ? $countCheck['recount'] : 4;

$popular = new WP_Query(
    array(
        'post_type'             =>  'post',
        'posts_per_page'        =>  $count,
        'meta_key'              =>  'silohon_post_views',
        'orderby'               =>  'meta_value_num',
        'order'                 =>  'DESC'
    )
);

if( $popular->have_posts()){ ?>

    <aside class="dblok">
        <div class="section_cat">
            <span class="in_single_tag">Popular Posts</span>
        </div>

        <div class="grid2">
        <?php
            while( $popular->have_posts()){
                $popular->the_post(); ?>

            <article id="post-<?php the_ID() ?>" class="g90-auto">
                <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smallUri">
                    <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'thumSmall', 'lazy'); ?>
                </a>
                <div class="smallBody">
                    <div class="meta">
                        <span class="theauthor">
                            By 
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?>
                            </a>
                        </span>
                        <span class="sparator">></span>
                        <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                    </div>
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                        <?php the_title('<h2 class="smallTitle">', '</h2>') ?>
                    </a>
                </div>
            </article>

                <?php
            } ?>
        </div>
    </aside>

<?php
}

wp_reset_postdata();
wp_reset_query();