<?php
/**
 * Search result Silohon Fast Load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

get_header(); ?>

<div class="container fastPosts">
    <form action="<?php echo home_url('/'); ?>" method="get" class="searchFormBox">
        <input class="searchInput" itemprop="query-input" type="text" name="s" placeholder="Search here.." value="<?php echo $s; ?>"/>
        <input type="submit" value="Search" class="btnsearchMobile" />
    </form>

    <?php if(have_posts()) : ?>
        <div class="tblockStyle">
        
            <?php while(have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID() ?>" class="dblock">
                    <div class="grid-2-250">
                        <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="fastSmall">
                            <?php echo fast_generate_thumbnail(get_the_ID(), 'full', 'mediumThumbnmail', 'lazy'); ?>
                        </a>
                        <div class="bodyBlock">
                            <div class="meta">
                                <?php fast_cat_link() ?>
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

            <?php endwhile; ?>

        </div>
    <?php else : ?>
        <h2 class="secondTitle">Sorry, result not found!</h2>
    <?php endif; ?>
</div>

<?php
get_footer();