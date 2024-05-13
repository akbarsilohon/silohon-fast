<?php
/**
 * File handler view for page
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

get_header();

$get_meta = get_post_custom( $post->ID );
if(!empty($get_meta['builder_active'])){ ?>

    <div class="container fastPosts">
        <?php

        if(!empty($get_meta['carousel'])){
            /**
             * Render Hero Posts
             * 
             * @package silohon-fast
             */
            FAST_PART( 'template/carousel' );
        }


        /**
         * Swiching style
         * 
         * @package silohon-fast
         */
        FAST_PART('template/swiching');
        ?>
    </div>

    <?php
} else{
    
    /**
     * Render normal page
     * 
     * @package silohon-fast
     */
    
    ?>

    <div class="container fastPosts">
        <article id="post-<?php the_ID(); ?>" class="dblok">
            <div class="ontop">
                <?php the_title('<h1 class="singleTitle" style="margin-bottom:2rem;">', '</h1>'); ?>
            </div>

            <div class="fastContent">
                <?php the_content(); ?>
            </div>
        </article>
    </div>

    <?php
}

get_footer();