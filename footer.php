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
    $optionMain = get_option('fast_main');
    if(!empty($optionMain['lazyload']) && $optionMain['lazyload'] === 'true'){ ?>

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
    } 
    
    if(!empty($optionMain['scroll_top']) && $optionMain['scroll_top'] === 'true'){
        $color = get_option('color_option');
        $fill = !empty($color['main']) ? $color['main'] : '#e5ac1b'; ?>
        <style>
            #fastScroll{
                position: fixed;
                bottom: 50px;
                right: 50px;
                z-index: 1000;
                color: white;
                cursor: pointer;
                transition: 0.3s ease-in-out;
                width: 40px;
                height: 40px;
                display: none;
            }
            #fastScroll.active{
                display: block;
            }
            @media(max-width: 768px){
                #fastScroll{
                    bottom: 20px;
                    right: 20px;
                }
            }
        </style>
        <div id="fastScroll">
            <a href="#header" class="scrollTop">
                <svg fill="<?php echo $fill; ?>" width="40px" height="40px" viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-arrow-square-up-f"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M10.707 5.293a.997.997 0 0 0-1.414 0L5.05 9.536a1 1 0 0 0 1.414 1.414L9 8.414V14a1 1 0 0 0 2 0V8.414l2.536 2.536a1 1 0 0 0 1.414-1.414l-4.243-4.243zM4 0h12a4 4 0 0 1 4 4v12a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z"></path></g></svg>
            </a>
        </div>

        <script>
            document.addEventListener('scroll', () => {
                if(window.pageYOffset > 150){
                    document.getElementById('fastScroll').classList.add('active');
                }else{
                    document.getElementById('fastScroll').classList.remove('active');
                }
            });
        </script>
    <?php } ?>

<?php wp_footer(); ?>

</body>
</html>