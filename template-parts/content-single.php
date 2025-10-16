<div id="main" class="site-main" role="main">
    <article class="page" id="<?php the_ID(); ?>">
        <header class="block">
            <div class="content heading">
                <div class="blobpit"></div>
                <?php
                if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail( null, 'full', [ 'class' => 'background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
                    }

                    the_title( '<h1 class="page-title">', '</h1>' );
                    echo '<div class="metadata"><div class="date">' . get_the_date() . '</div>';
                    if ( get_comments_number() > 0 ) :
                        echo '<div class="comments">';
                                if ( get_comments_number() == 1 ) {
                                    echo get_comments_number(); echo '<span></span>' . esc_html( 'Comentario', 'stroyka' );
                                } else {
                                    echo get_comments_number(); echo '<span></span>' . esc_html( 'Comentarios', 'stroyka' );
                                }
                        echo '</div>';
                    endif;
                ?>
            </div>
        </header>
        <section class="block">
            <div class="is-layout-constrained">
                <?php the_content(); ?>
            </div>
            <div class="content content-tags">
                <?php
                    $tags = get_the_tags();
                    if ( $tags ) {
                        foreach ( $tags as $tag ) {
                            echo '<a class="tag button small-button" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag" viewBox="0 0 16 16"><path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0"/><path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1m0 5.586 7 7L13.586 9l-7-7H2z"/></svg>' . esc_html( $tag->name ) . '</a>';
                        }
                    }
                ?>
            </div>
            <div class="content content-author">
                <?php
                    echo get_avatar( get_the_author_meta('email'), '70' ) . '
                    <h3 class="author-name">'; the_author(); echo '</h3>' . '
                    <span class="author-description">'; the_author_meta('description'); echo '</span>';
                ?>
            </div>
        </section>
        <section class="block container--posts container--related-posts">
            <?php
                $categories = wp_get_post_categories(get_the_ID());
                $tags = wp_get_post_tags(get_the_ID());
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 4,
                    'post__not_in'   => array(get_the_ID()),
                    'orderby'        => 'rand',
                    'tax_query'      => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $categories,
                        ),
                        array(
                            'taxonomy' => 'post_tag',
                            'field'    => 'term_id',
                            'terms'    => wp_list_pluck($tags, 'term_id'),
                        ),
                    ),
                );

                $related_posts = new WP_Query($args);

                if ($related_posts->have_posts()) :
            ?>
            <div class="content related-posts--title">
                <h2><?php echo esc_html_e( 'Contenido relacionado', 'outlet' ); ?></h2>
            </div>
            <div class="content related-posts--list">
                <?php 
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                        get_template_part( 'template-parts/content', 'archive' );
                    endwhile;
                ?>
            </div>
            <?php
                wp_reset_postdata();
                endif;
            ?>
        </section>
        <?php if ( comments_open() ): ?>
        <section class="block">
            <div class="content content-comments">
                <?php comments_template(); ?>
            </div>
        </section>
        <?php endif; ?>
    </article>
</div>