<?php
/**
 * File handler view for page
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

get_header(); ?>

<div class="container fastPosts">
    <article id="post-<?php the_ID(); ?>" class="dblok">
        <div class="ontop">
            <?php the_title('<h2 class="singleTitle" style="margin-bottom:2rem;">', '</h2>'); ?>
        </div>

        <div class="fastContent">
            <?php the_content(); ?>
        </div>
    </article>
</div>

<?php
get_footer();