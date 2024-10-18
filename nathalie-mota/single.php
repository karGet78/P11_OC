<?php

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while (have_posts()) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                    <div class="entry-meta">
                        <span class="posted-on"><?php echo get_the_date(); ?></span>
                        <span class="byline"> <?php the_author_posts_link(); ?></span>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    }
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'your-theme-slug'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <div class="entry-categories"><?php esc_html_e('Categories: ', 'your-theme-slug'); the_category(', '); ?></div>
                    <div class="entry-tags"><?php the_tags('Tags: ', ', ', ''); ?></div>
                </footer>
            </article>

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            the_post_navigation(array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'your-theme-slug') . '</span> ' .
                    '<span class="screen-reader-text">' . __('Next post:', 'your-theme-slug') . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'your-theme-slug') . '</span> ' .
                    '<span class="screen-reader-text">' . __('Previous post:', 'your-theme-slug') . '</span> ' .
                    '<span class="post-title">%title</span>',
            ));

        endwhile;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar(); 
get_footer();
?>
