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

<?php
    $lazyload = get_option('fast_main')['lazyload'];
    if(!empty($lazyload) && $lazyload === 'true'){ ?>

        <script>
            const images = document.querySelectorAll('[data-src]');
            function preloadImage(e){
                let t = e.getAttribute('data-src');
                t && (e.src = t);
            }
            const imgOptions = {
                threshold: 0,
                rootMargin: '0px 0px -150px 0px'
            }
            imgObserver = new IntersectionObserver(((e,t) => {
                e.forEach((e => {
                    e.isIntersecting && (preloadImage(e.target), t.unobserve(e.target));
                }));
            }), imgOptions), images.forEach((e => {
                imgObserver.observe(e)
            }));
        </script>

        <?php
    } ?>

<?php wp_footer(); ?>

</body>
</html>