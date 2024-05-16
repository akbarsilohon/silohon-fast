<?php
/**
 * Render HTML Output for style 1
 * 
 * @package silohon
 * 
 * @link https://gitbub.com/akbarsilohon/silohon-fast.git
 */

global $post, $data;
$category_id = $data['cat'];

$args = array(
    'posts_per_page'        =>  $data['count'],
    'post_type'             =>  'post',
    'post_status'           =>  'publish',
    'no_found_rows'         =>  true,
    'ignore_sticky_posts'   =>  true,
    'cat'                   =>  $category_id
);

if( !empty( $data['order'] ) && $data['order'] == 'rand' ){
    $args['orderby'] = 'rand';
}

$style1 = new WP_Query( $args );
$CatName = get_the_category_by_ID( $category_id );
$CatUri = get_category_link( $category_id ); ?>

<section class="fastSection">
    <div class="section_cat">
        <span class="in_single_tag">
            <a href="<?php echo $CatUri; ?>" title="<?php echo $CatName; ?>"><?php echo $CatName; ?></a>
        </span>
    </div>

    <?php 
    if($style1->have_posts()){
        $i = 0;
        $count = $style1->post_count;
        while( $i < min( 1, $count ) && $style1->have_posts()){
            $style1->the_post();
            $i++; ?>

            <article id="post-<?php the_ID(); ?>" class="dblock">
                <div class="grid-2-250">
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="fastSmall">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'mediumThumbnmail', 'lazy'); ?>
                    </a>
                    <div class="bodyBlock">
                        <div class="meta">
                            <span class="theauthor">
                                By 
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?>
                                </a>
                            </span>
                            <span class="sparator">/</span>
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

        <div class="grid2">
            <?php
            $i = 0;
            while($style1->have_posts()){
                $style1->the_post();
                $i++; ?>

                <article id="post-<?php the_ID(); ?>" class="g90-auto">
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
            }
            ?>
        </div>

        <?php
    }
    ?>

</section>

<?php
wp_reset_postdata();
wp_reset_query();