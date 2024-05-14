<?php
/**
 * Generate HTML Output for hiro posts
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$get_meta = get_post_meta($post->ID);
if( isset( $get_meta['carousel'][0] )){
    $carousel = false;
    if( !empty( $get_meta['carousel'][0] )){
        $carousel = $get_meta['carousel'][0];
        if( is_serialized( $carousel )){
            $carousel = unserialize( $carousel );
        }
    }
}

/**
 * Rende HTML for carousel items
 * 
 * @package silohon-fast
 */
if(!empty($carousel) && is_array( $carousel )){
    $args = array(
        'post_type'                 => 'post',
        'posts_per_page'            => $carousel['num'],
        'no_found_rows'             => true,
        'ignore_sticky_posts'	    => true
    );

    if( !empty( $carousel['cat'] )){
        $args['cat'] = $carousel['cat'];
    }

    if( !empty( $carousel['order'] ) && $carousel['order'] == 'true' ){
        $args['orderby'] = 'rand';
    }

    $newQuery = new WP_Query( $args );

    if($newQuery->have_posts()){
        $i = 0; ?>

        <section class="carousel">
            <button class="carousel_button left">&#8592;</button>
            <div class="carousel_container">
                <div class="carousel_track">
                    <?php
                    $itemActive = true;
                    $slideCount = 0;
                    while($newQuery->have_posts()){
                        $newQuery->the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" class="carousel_cover <?php if($itemActive) echo 'active'; ?>">
                            <?php echo fast_generate_thumbnail( get_the_ID(), 'full', 'carousel_img', 'eager' ); ?>
                            <div class="carousel_body">
                                <div class="meta">
                                    <span class="author"><?php the_author(); ?></span>
                                    <span class="sparator">></span>
                                    <span class="date"><?php echo the_time('F j, Y'); ?></span>
                                </div>
                                <a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="carousel_link">
                                    <?php echo the_title( '<h2 class="carousel_title">', '</h2>' ); ?>
                                </a>

                                <span class="catBox">
                                    <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24.00 24.00" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5.676,8.237-6,5.5a1,1,0,0,1-1.383-.03l-3-3a1,1,0,1,1,1.414-1.414l2.323,2.323,5.294-4.853a1,1,0,1,1,1.352,1.474Z"></path></g></svg>
                                    <div class="catBoxs">
                                        <?php fast_cat_no_link(); ?>
                                    </div>
                                </span>
                            </div>
                        </article>

                        <?php
                        $itemActive = false;
                        $slideCount++;
                    } ?>
                </div>
            </div>
            <button class="carousel_button right">&#8594;</button>
        </section>

        <div class="carousel_indicators">
            <?php for ($i = 0; $i < $slideCount; $i++) { ?>
                <button class="carousel_indicator <?php echo $i === 0 ? 'active' : ''; ?>"></button>
            <?php } ?>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const track = document.querySelector('.carousel_track');
                const slides = Array.from(track.children);
                const nextButton = document.querySelector('.carousel_button.right');
                const prevButton = document.querySelector('.carousel_button.left');
                const navButtons = Array.from(document.querySelectorAll('.carousel_indicator'));

                const slideWidth = slides[0].getBoundingClientRect().width;

                const removeAllActiveClasses = () => {
                    slides.forEach(slide => {
                        slide.classList.remove('active');
                    });
                };

                const setActiveSlide = (index) => {
                    removeAllActiveClasses();
                    slides[index].classList.add('active');
                    updateNavButtons(index);
                };

                const updateNavButtons = (index) => {
                    navButtons.forEach((button, i) => {
                        if (i === index) {
                            button.classList.add('active');
                        } else {
                            button.classList.remove('active');
                        }
                    });
                };

                nextButton.addEventListener('click', function () {
                    const currentSlide = track.querySelector('.carousel_cover.active');
                    const currentIndex = slides.findIndex(slide => slide === currentSlide);
                    let nextIndex = (currentIndex + 1) % slides.length;
                    setActiveSlide(nextIndex);
                });

                prevButton.addEventListener('click', function () {
                    const currentSlide = track.querySelector('.carousel_cover.active');
                    const currentIndex = slides.findIndex(slide => slide === currentSlide);
                    let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                    setActiveSlide(prevIndex);
                });

                navButtons.forEach((button, index) => {
                    button.addEventListener('click', () => {
                        setActiveSlide(index);
                    });
                });
            });
        </script>


        <?php
    }

    wp_reset_postdata();
    wp_reset_query();
}