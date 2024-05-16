<?php
/**
 * Render HTML Output for style 3
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
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

$style3 = new WP_Query($args);
$CatName = get_the_category_by_ID( $category_id );
$CatUri = get_category_link( $category_id ); ?>


<section class="fastSection">
    <div class="section_cat">
        <span class="in_single_tag">
            <a href="<?php echo $CatUri; ?>" title="<?php echo $CatName; ?>"><?php echo $CatName; ?></a>
        </span>
    </div>

    <?php if($style3->have_posts()){
        $i = 0; ?>

        <ul class="FastList_post">
            <?php while($style3->have_posts()){
                $style3->the_post();
                $i++; ?>

                <li class="listPost_index">
                    <div class="caunt_number">
                        #<?php echo $i; ?>
                    </div>
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="listUri">
                        <?php the_title('<h2 class="post_list-title">', '</h2>'); ?>
                    </a>
                </li>

                <?php
            } ?>
        </ul>

        <?php
    } ?>
</section>



<?php
wp_reset_postdata();
wp_reset_query();