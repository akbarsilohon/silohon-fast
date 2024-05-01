<?php
/**
 * Footer file Silohon Fast load Wordpress Theme
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */ ?>

<footer class="fas_footer">
    <div class="ftop">
        <div class="container">
            <?php 
                wp_nav_menu(
                    array(
                        'theme_location'        =>  'footer',
                        'container'             =>  'ul',
                        'menu_class'            =>  'menuFooter',
                        'menu_id'               =>  'menuFooter',
                        'fallback_cb'           =>  false
                    )
                );
            ?>
        </div>
    </div>
    <div class="fbot">
        <p class="botText">&copy; Copyright <?php echo bloginfo( 'name' ); ?> <?php echo the_time('Y'); ?></p>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>