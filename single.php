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

get_header(); ?>

    <div class="container fastPosts">
        <article id="post-<?php the_ID(); ?>" class="dblok" itemscope itemtype="https://schema.org/NewsArticle">
            <div class="ontop">
                <div class="singleCat"><?php fast_cat_link(); ?></div>
                <?php the_title('<h2 class="singleTitle" itemprop="headline">', '</h2>'); ?>

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
                    if( has_post_thumbnail()){
                        the_post_thumbnail( 'full', array(
                            'class'     =>  'singlePost_thumbnail',
                            'loading'   =>  'eager'
                        ) );
                    }
                ?>
            </div>


            <div class="fastContent">
                <?php the_content(); ?>
            </div>

            <div class="tagOutput">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M7.0498 7.0498H7.0598M10.5118 3H7.8C6.11984 3 5.27976 3 4.63803 3.32698C4.07354 3.6146 3.6146 4.07354 3.32698 4.63803C3 5.27976 3 6.11984 3 7.8V10.5118C3 11.2455 3 11.6124 3.08289 11.9577C3.15638 12.2638 3.27759 12.5564 3.44208 12.8249C3.6276 13.1276 3.88703 13.387 4.40589 13.9059L9.10589 18.6059C10.2939 19.7939 10.888 20.388 11.5729 20.6105C12.1755 20.8063 12.8245 20.8063 13.4271 20.6105C14.112 20.388 14.7061 19.7939 15.8941 18.6059L18.6059 15.8941C19.7939 14.7061 20.388 14.112 20.6105 13.4271C20.8063 12.8245 20.8063 12.1755 20.6105 11.5729C20.388 10.888 19.7939 10.2939 18.6059 9.10589L13.9059 4.40589C13.387 3.88703 13.1276 3.6276 12.8249 3.44208C12.5564 3.27759 12.2638 3.15638 11.9577 3.08289C11.6124 3 11.2455 3 10.5118 3ZM7.5498 7.0498C7.5498 7.32595 7.32595 7.5498 7.0498 7.5498C6.77366 7.5498 6.5498 7.32595 6.5498 7.0498C6.5498 6.77366 6.77366 6.5498 7.0498 6.5498C7.32595 6.5498 7.5498 6.77366 7.5498 7.0498Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
                <div class="tagLoop">
                    <?php  fast_render_tag(get_the_ID()); ?>
                </div>
            </div>
        </article>

        <?php FAST_PART('aside/related'); ?>
    </div>

<?php
get_footer();