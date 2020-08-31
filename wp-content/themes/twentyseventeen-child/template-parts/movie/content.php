<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (is_sticky() && is_home()) :
        echo twentyseventeen_get_svg(array('icon' => 'thumb-tack'));
    endif;
    ?>

    <div class="full-width-layout">

        <div class="row row-cols-2">

            <div class="col">


                <?php if ('' !== get_the_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('full'); ?>
                        </a>
                    </div><!-- .post-thumbnail -->
                <?php endif; ?>

            </div>

            <div class="col">

                <?php
                if ('post' === get_post_type()) {
                    echo '<div class="entry-meta">';
                    if (is_single()) {
                        twentyseventeen_posted_on();
                    } else {
                        echo twentyseventeen_time_link();
                        twentyseventeen_edit_link();
                    };
                    echo '</div><!-- .entry-meta -->';
                };

                if (is_single()) {
                    the_title('<h1 class="entry-title">', '</h1>');
                } elseif (is_front_page() && is_home()) {
                    the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                } else {
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                }
                ?>

                <span> <strong>Release Year</strong></span> : <span><?= get_post_meta(get_the_ID(), 'release_year', TRUE); ?></span>
                <br />
                <span> <strong>Time</strong></span> : <span><?= get_post_meta(get_the_ID(), 'time', TRUE); ?> Minutes</span>

            </div>

        </div>

    </div>

    <h2>Trailer</h2>

    <iframe width="560" height="315" src="<?= get_post_meta(get_the_ID(), 'trailer_youtube', TRUE); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <div class="entry-content">
        <?php
        the_content(
                sprintf(
                        /* translators: %s: Post title. */
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen'), get_the_title()
                )
        );

        wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . __('Pages:', 'twentyseventeen'),
                    'after' => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after' => '</span>',
                )
        );
        ?>
    </div><!-- .entry-content -->

    <?php
    if (is_single()) {
        twentyseventeen_entry_footer();
    }
    ?>

</article><!-- #post-<?php the_ID(); ?> -->
