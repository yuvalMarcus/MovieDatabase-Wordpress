<?php
/**
 * Template Name: Movie Categories *
 */
get_header();
?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <h2>Movies Categories</h2>
            
            <?php
            $terms = get_terms(array(
                'taxonomy' => 'movies',
                'hide_empty' => false,
                    ));
            ?>

            <div class="full-width-layout">
                <div class="row row-cols-3">

                    <?php foreach ($terms as $term) : ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $term->name ?></h5>
                                    <p class="card-text"><?= $term->description ?></p>
                                    <a href="<?=get_site_url()?>/movies/<?= $term->slug ?>" class="btn btn-primary">Enter</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
