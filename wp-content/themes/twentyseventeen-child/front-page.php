<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Show the selected front page content.
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('twentyseventeen-panel '); ?> >

                    <?php
                    if (has_post_thumbnail()) :
                        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'twentyseventeen-featured-image');

                        // Calculate aspect ratio: h / w * 100%.
                        $ratio = $thumbnail[2] / $thumbnail[1] * 100;
                        ?>

                        <div class="panel-image" style="background-image: url(<?php echo esc_url($thumbnail[0]); ?>);">
                            <div class="panel-image-prop" style="padding-top: <?php echo esc_attr($ratio); ?>%"></div>
                        </div><!-- .panel-image -->

                    <?php endif; ?>

                    <div class="panel-content">
                        <div class="wrap">

                            <h2>Movie Search</h2>

                            <div class="container-search">

                                <div class="box-search">

                                    <input type="text" id="search" name="search" class="" placeholder="Free Search">

                                    <div class="loading-data" style="display: none;"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i><span class="sr-only">Loading...</span></div>

                                    <div class="close-data" style="display: none;"><i class="fa fa-times fa-2x fa-fw"></i><span class="sr-only">Close</span></div>

                                </div>

                                <div class="content-box" style="display: none">

                                </div>

                            </div>

                            <p>
                                <a href="<?= get_site_url() ?>/search/">Enter to full search</a>
                            </p>

                            <h2>Popular Movies</h2>

                            <div data-name="Responsive Settings" class="glider-contain multiple">
                                <div class="gradient-border-bottom">
                                    <div class="gradient-border">
                                        <div class="glider" id="glider-resp">

                                            <?php
// Set the arguments for the query
                                            $args = array(
                                                'numberposts' => 8, // -1 is for all
                                                'post_type' => 'movie', // or 'post', 'page'
                                                'orderby' => 'title', // or 'date', 'rand'
                                                'order' => 'ASC', // or 'DESC'
                                                    //'category' 		=> $category_id,
                                                    //'exclude'		=> get_the_ID()
                                                    // ...
                                                    // http://codex.wordpress.org/Template_Tags/get_posts#Usage
                                            );

// Get the posts
                                            $myposts = get_posts($args);

// If there are posts
                                            if ($myposts):
                                                // Loop the posts
                                                foreach ($myposts as $mypost):
                                                    ?>
                                                    <div>
                                                        <a href="<?php echo get_permalink($mypost->ID); ?>">
                                                            <?= get_the_post_thumbnail($mypost->ID, 'full'); ?>
                                                        </a>
                                                    </div>



                                                    <?php
                                                endforeach;
                                                wp_reset_postdata();
                                                ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                                <button role="button" aria-label="Previous" class="glider-prev" id="glider-prev-resp"><i class="fa fa-chevron-left"></i></i></button>
                                <button role="button" aria-label="Next" class="glider-next" id="glider-next-resp"><i class="fa fa-chevron-right"></i></i></button>
                                <div id="resp-dots"></div>
                            </div>

                            <div class="jumbotron jumbotron-fluid jumbotron-blue">
                                <div class="container">
                                    <h1 class="display-4">Fluid jumbotron</h1>
                                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                                </div>
                            </div>

                            <h2>Popular Categories</h2>

                            <?php
                            $terms = get_terms(array(
                                'taxonomy' => 'movies',
                                'hide_empty' => false,
                            ));
                            ?>

                            <div class="full-width-layout container-categories" style="margin-bottom: 2rem">
                                <div class="row row-cols-2">

                                    <?php foreach ($terms as $term) : ?>
                                        <div class="col">

                                            <div class="card">
                                                <?php $photo = get_field('photo', $term->taxonomy . '_' . $term->term_id)['url']; ?>
                                                <?php if (!empty($photo)) : ?>
                                                    <img src="<?= $photo ?>" class="card-img-top" alt="">
                                                <?php endif; ?>
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $term->name ?></h5>
                                                    <p class="card-text"><?= $term->description ?></p>
                                                    <p class="card-text"><a href="<?= get_site_url() ?>/movies/<?= $term->slug ?>" class="btn btn-primary">Enter</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>


                                </div><!-- .wrap -->
                            </div><!-- .panel-content -->


                            <div class="jumbotron jumbotron-fluid jumbotron-red">
                                <div class="container">
                                    <h1 class="display-4">Fluid jumbotron</h1>
                                    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                                </div>
                            </div>

                            </article><!-- #post-<?php the_ID(); ?> -->

                            <?php
                        endwhile;
                    else :
                        get_template_part('template-parts/post/content', 'none');
                    endif;
                    ?>

                    <?php
                    // Get each of our panels and show the post data.
                    if (0 !== twentyseventeen_panel_count() || is_customize_preview()) : // If we have pages to show.

                        /**
                         * Filter number of front page sections in Twenty Seventeen.
                         *
                         * @since Twenty Seventeen 1.0
                         *
                         * @param int $num_sections Number of front page sections.
                         */
                        $num_sections = apply_filters('twentyseventeen_front_page_sections', 4);
                        global $twentyseventeencounter;

                        // Create a setting and control for each of the sections available in the theme.
                        for ($i = 1; $i < ( 1 + $num_sections ); $i++) {
                            $twentyseventeencounter = $i;
                            twentyseventeen_front_page_section(null, $i);
                        }

                    endif; // The if ( 0 !== twentyseventeen_panel_count() ) ends here.
                    ?>

                    </main><!-- #main -->
                </div><!-- #primary -->

                <script src="<?= get_site_url() ?>/wp-content/themes/twentyseventeen-child/assets/js/formsClass.js" type="text/javascript"></script>
                <script src="<?= get_site_url() ?>/wp-content/themes/twentyseventeen-child/assets/js/XMLHttpRequestClass.js" type="text/javascript"></script>
                <script>

                    (function () {

                        function timeout() {
                            setTimeout(function () {

                                forms.getSearchCallback()(parseInt(new Date().getTime()));
                                timeout();
                            }, 1000);
                        }

                        var forms = new formsClass();

                        var getFormsCallbackBeforeResponse = function (obj) {
                            var loadingElm;

                            document.querySelector('.box-search').classList.add('not-active');
                            loadingElm = document.querySelector('.box-search .loading-data');
                            closeElm = document.querySelector('.box-search .close-data');
                            document.querySelector('.box-search input').disabled = true;

                            loadingElm.style.display = 'block';
                            closeElm.style.display = 'none';
                        };

                        var getFormsCallbackAfterResponse = function (responseData, obj) {
                            var loadingElm;

                            loadingElm = document.querySelector('.box-search .loading-data');

                            closeElm = document.querySelector('.box-search .close-data');

                            forms.setForms(JSON.parse(responseData));

                            loadingElm.style.display = 'none';

                            closeElm.style.display = 'block';

                            document.querySelector('.box-search').classList.remove('not-active');
                            document.querySelector('.box-search input').disabled = false
                            document.querySelector('.box-search input').focus();

                        };

                        var getFormsGetParams = function () {
                            var formData;

                            formData = forms.getFormData();

                            return formData;
                        }

                        var getFormsXMLHttpRequest = new XMLHttpRequestClass('<?= get_site_url() ?>/wp-content/themes/twentyseventeen-child/inc/get_forms.php', getFormsCallbackBeforeResponse, getFormsCallbackAfterResponse, getFormsGetParams);


                        forms.init(getFormsXMLHttpRequest, null);

                        timeout();

                    })();

                </script>

                <script>
                    window.addEventListener('load', function () {
                        new Glider(document.querySelector('#glider-resp'), {
                            // Mobile-first defaults
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            scrollLock: true,
                            dots: '#resp-dots',
                            arrows: {
                                prev: '#glider-prev-resp',
                                next: '#glider-next-resp'
                            },
                            responsive: [
                                {
                                    breakpoint: 775,
                                    settings: {
                                        slidesToShow: 'auto',
                                        slidesToScroll: 'auto',
                                        itemWidth: 150,
                                        duration: 0.25
                                    }
                                }, {
                                    breakpoint: 1024,
                                    settings: {
                                        slidesToShow: 4,
                                        slidesToScroll: 1,
                                        itemWidth: 150,
                                        duration: 0.25
                                    }
                                }
                            ]
                        })
                    });
                </script>
                <?php
                get_footer();
                