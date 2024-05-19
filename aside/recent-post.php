<?php
/**
 * Render recent posts in single post
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$countCheck = get_option('fast_article');
$count = !empty( $countCheck['recount']) ? $countCheck['recount'] : 4;

$recent = new WP_Query(
    array(
        'posts_per_page'        =>  $count,
        'post_type'             =>  'post',
        'post_status'           =>  'publish'
    )
);

if( $recent->have_posts()){
    $i = 0; ?>

<aside class="dblok">
    <div class="section_cat">
        <span class="in_single_tag">Recent Posts</span>
    </div>

    <ul class="FastList_post">
        <?php 
        while( $recent->have_posts()){
            $recent->the_post();
            $i ++; ?>

            <li class="listPost_index">
                <div class="caunt_number">
                    #<?php echo $i; ?>
                </div>
                <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="listUri">
                    <?php the_title('<h2 class="post_list-title">', '</h2>'); ?>
                </a>
            </li>

            <?php
        }
        ?>
    </ul>
</aside>

<?php
}

wp_reset_postdata();
wp_reset_query();