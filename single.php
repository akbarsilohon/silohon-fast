<?php
/**
 * Single post Handler
 * 
 * Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

get_header();

$option = get_option('fast_article');

?>

    <div class="container fastPosts">
        <article id="post-<?php the_ID(); ?>" class="dblok" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="ontop">
                <div class="singleCat"><?php fast_cat_link(); ?></div>
                <?php the_title('<h1 class="singleTitle" itemprop="headline">', '</h1>'); ?>

                <?php
                    /**
                     * Render meta img for single post
                     * 
                     * @package silohon-fast
                     */ 
                    fast_generate_img_meta_seo(get_the_ID());
                ?>
                <meta itemprop="datePublished" content="<?php the_time('c'); ?>">
                <meta itemprop="dateModified" content="<?php the_modified_date('c'); ?>">

                <div class="authorMeta">
                    <?php
                        $ids = get_post_field( 'post_author', get_the_ID());
                        $names = get_the_author_meta( 'display_name', $ids );
                        $web = get_author_posts_url( $ids );
                        $avatar = get_avatar_url( $ids, array('size' => 150));

                        echo '<img width="150" height="150" alt="'.$names.'" class="slsAuth_img" src="'. $avatar .'">';
                    ?>

                    <div class="bodyMeta">
                        <a href="<?php echo home_url('/author/') . get_the_author_meta( 'user_nicename', $ids ); ?>" title="<?php echo $names; ?>" class="slsUthUri">
                            By: <span class="slsAuthName"> <?php echo $names; ?></span>
                        </a>
                        <span class="dates"><?php echo the_time('F D Y'); ?></span>
                    </div>

                    <div style="display: none;" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <meta itemprop="url" content="<?php echo home_url('/author/') . get_the_author_meta( 'user_nicename', $ids ); ?>">
                        <meta itemprop="name" content="<?php echo $names; ?>">
                    </div>
                </div>

                <?php
                    if(!empty($option['thumb']) && $option['thumb'] === 'true' && has_post_thumbnail()){
                        echo fast_generate_thumbnail( get_the_ID(), 'full', 'singlePost_thumbnail', 'eager' );
                    }
                ?>
            </div>


            <div class="fastContent">
                <?php the_content(); ?>
            </div>

            <?php 
                if(!empty($option['tag']) && $option['tag'] === 'true' ){ ?>
                    <div class="tagList">
                        <?php fast_render_tag(get_the_ID()); ?>
                    </div>
                    <?php
                }
            ?>
        </article>

        <?php $related = $option['related'];
        if(!empty( $related ) && $related === 'true' ){
            FAST_PART('aside/related');
        } ?>

        <?php
        /**
         * Render Comments form
         * 
         * @package silohon-fast
         */
            $commentOpen = $option['comment'];
            if(!empty($commentOpen) && $commentOpen === 'true' && comments_open()){
                comments_template();
            }
        ?>
    </div>

<?php
get_footer();