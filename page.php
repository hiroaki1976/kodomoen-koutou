<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kodomoen_koutou
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            // The WordPress Loop: Checks if there are posts/pages to display
            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post(); // Sets up post data for each post/page

                    // Display page content
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); // Page Title ?>
                        </header><div class="entry-content">
                            <?php
                            the_content(); // Page Content

                            // Pagination for multi-page posts/pages
                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kodomoen-koutou' ),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div><?php if ( get_edit_post_link() ) : ?>
                            <footer class="entry-footer">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            /* translators: %s: Post title. */
                                            __( 'Edit <span class="screen-reader-text">%s</span>', 'kodomoen-koutou' ),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        wp_kses_post( get_the_title() )
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer><?php endif; ?>
                    </article><?php

                    // If comments are open or there's at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.

            else :
                // If no content is found (shouldn't happen for a static page, but good practice)
                ?>
                <p><?php esc_html_e( 'Sorry, no content found for this page.', 'kodomoen-koutou' ); ?></p>
                <?php

            endif; // End if ( have_posts() )
            ?>

        </main></div><?php
get_footer(); // Loads footer.php