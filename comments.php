<?php
/**
 * Render Comments form
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

if(post_password_required()){
    return;
} ?>

<div class="fast_comments">
    <div class="section_cat">
        <span class="in_single_tag">Comments</span>
    </div>
    <div class="comments_loop">
        <?php wp_list_comments(
            array(
                'walker'        =>  false,
                'style'         =>  'div',
                'type'          =>  'all',
                'avatar_size'   =>  100,
                'format'        =>  'html5',
                'short_ping'    =>  false,
                'echo'          =>  true
            )
        ); ?>
    </div>
    <?php comment_form(); ?>
</div>