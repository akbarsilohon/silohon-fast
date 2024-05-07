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

$style2 = new WP_Query( $args );
$CatName = get_the_category_by_ID( $category_id );
$CatUri = get_category_link( $category_id ); ?>

<section class="fastSection">
    <div class="section_cat">
        <span class="in_single_tag">
            <a href="<?php echo $CatUri; ?>"><?php echo $CatName; ?></a>
        </span>
    </div>

    <?php if($style2->have_posts()){
        $i = 0;
        $count = $style2->post_count; ?>

        <div class="dblock">
            <div class="grid2">
                <?php
                while( $i < min( 2, $count ) && $style2->have_posts()){
                    $style2->the_post();
                    $i++; ?>

                    <a href="<?php echo the_permalink(); ?>" id="post-<?php the_ID(); ?>" title="<?php echo the_title(); ?>" class="smallRelative">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'full', 'smallAbsolute', 'lazy'); ?>
                        <div class="smallBody_absolute">
                            <?php the_title('<h2 class="smallTitle_absolute">', '</h2>') ?>
                        </div>
                        <span class="authorAbsolute">By <?php the_author(); ?></span>
                    </a>

                    <?php
                } ?>
            </div>

            <div class="grid2">
                <?php 
                $i = 0;
                while( $style2->have_posts()){
                    $style2->the_post();
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
        </div>

        <?php
    } ?>
</section>