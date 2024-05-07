<?php
/**
 * Generate HTML Output for hiro posts
 * 
 * @package silohon-fast
 * 
 * @link https://github.com/akbarsilohon/silohon-fast.git
 */

$args = array(
    'post_type'                 => 'post',
    'posts_per_page'            => 5,
    'no_found_rows'             => true,
    'ignore_sticky_posts'	    => true
);

$newQuery = new WP_Query( $args );

if($newQuery->have_posts()){ ?>

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

    <!-- Indikator -->
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

            // Function to remove 'active' class from all slides
            const removeAllActiveClasses = () => {
                slides.forEach(slide => {
                    slide.classList.remove('active');
                });
            };

            // Function to add 'active' class to a specific slide
            const setActiveSlide = (index) => {
                removeAllActiveClasses();
                slides[index].classList.add('active');
                updateNavButtons(index);
            };

            // Update active state of nav buttons
            const updateNavButtons = (index) => {
                navButtons.forEach((button, i) => {
                    if (i === index) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });
            };

            // Move to next slide
            nextButton.addEventListener('click', function () {
                const currentSlide = track.querySelector('.carousel_cover.active');
                const currentIndex = slides.findIndex(slide => slide === currentSlide);
                let nextIndex = (currentIndex + 1) % slides.length;
                setActiveSlide(nextIndex);
            });

            // Move to previous slide
            prevButton.addEventListener('click', function () {
                const currentSlide = track.querySelector('.carousel_cover.active');
                const currentIndex = slides.findIndex(slide => slide === currentSlide);
                let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
                setActiveSlide(prevIndex);
            });

            // Move to specific slide on indicator click
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
?>

<!-- Fast 1 -->
<section class="fastSection">
    <div class="section_cat">
        <span class="in_single_tag">
            <a href="/">Style 1</a>
        </span>
    </div>


    <?php 
    $style1 = new WP_Query(
        array(
            'post_type'         =>  'post',
            'posts_per_page'    =>  9
        )
    );


    if($style1->have_posts()){

        $i = 0;
        $count = $style1->post_count;
        while( $i < min( 1, $count) && $style1->have_posts()){
            $style1->the_post();
            $i++; ?>

            <article id="post-<?php the_ID(); ?>" class="dblock">
                <div class="grid-2-250">
                    <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="fastSmall">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'mediumThumbnmail', 'lazy'); ?>
                    </a>
                    <div class="bodyBlock">
                        <div class="meta">
                            <span class="theauthor">
                                By 
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?>
                                </a>
                            </span>
                            <span class="sparator">/</span>
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

            <?php
        } ?>


        <div class="grid2">
            <?php
                $i = 0;
                while($style1->have_posts()){
                    $style1->the_post();
                    $i ++; ?>

                    <article id="post-<?php the_ID(); ?>" class="g90-auto">
                        <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smallUri">
                            <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'thumSmall', 'lazy'); ?>
                        </a>
                        <div class="smallBody">
                            <div class="meta">
                                <span class="theauthor">
                                    By 
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?>
                                    </a>
                                </span>
                                <span class="sparator">></span>
                                <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                            </div>
                            <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                                <?php the_title('<h2 class="smallTitle">', '</h2>') ?>
                            </a>
                        </div>
                    </article>

                    <?php
                }
            ?>
        </div>


        <?php
    }


    wp_reset_postdata();
    wp_reset_query();
    
    ?>


</section>


<!-- fast 2 -->
<section class="fastSection">
    <div class="section_cat">
        <span class="in_single_tag">
            <a href="/">Style 2</a>
        </span>
    </div>

    <?php
    $style2 = new WP_Query(
        array(
            'post_type'         =>  'post',
            'posts_per_page'    =>  10
        )
    );
    
    if($style2->have_posts()){
        $i = 0;
        $count = $style1->post_count; ?>

        <div class="dblock">
            <div class="grid2">
                <?php
                while($i < min( 2, $count) && $style2->have_posts()){
                    $style2->the_post();
                    $i ++; ?>

                    <a href="<?php echo the_permalink(); ?>" id="post-<?php the_ID(); ?>" title="<?php echo the_title(); ?>" class="smallRelative">
                        <?php echo fast_generate_thumbnail(get_the_ID(), 'full', 'smallAbsolute', 'lazy'); ?>
                        <div class="smallBody_absolute">
                            <?php the_title('<h2 class="smallTitle_absolute">', '</h2>') ?>
                        </div>
                        <span class="authorAbsolute">By <?php the_author(); ?></span>
                    </a>

                    <?php
                }
                ?>
            </div>

            <div class="grid2">
                <?php
                $i = 0;
                while($style2->have_posts()){
                    $style2->the_post();
                    $i++; ?>

                    <article id="post-<?php the_ID(); ?>" class="g90-auto">
                        <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smallUri">
                            <?php echo fast_generate_thumbnail(get_the_ID(), 'medium', 'thumSmall', 'lazy'); ?>
                        </a>
                        <div class="smallBody">
                            <div class="meta">
                                <span class="theauthor">
                                    By 
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="Post by <?php echo esc_attr(get_the_author_meta('display_name', get_the_author_meta('ID'))); ?>"><?php the_author(); ?>
                                    </a>
                                </span>
                                <span class="sparator">></span>
                                <span class="times">On <?php echo the_time('F j, Y'); ?></span>
                            </div>
                            <a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>" class="smUri">
                                <?php the_title('<h2 class="smallTitle">', '</h2>') ?>
                            </a>
                        </div>
                    </article>

                    <?php
                }
                ?>
            </div>
        </div>

        <?php
    }

    wp_reset_postdata();
    wp_reset_query();
    ?>
</section>