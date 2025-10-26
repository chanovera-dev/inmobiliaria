<section id="blog" class="block">
    <div class="content">
        <div class="heading">
            <span>Nuestras noticias y artículos</span>
            <h2 class="title-section">Nuestro Últimos Artículos</h2>
        </div>
        <div class="posts">
            <?php
                $args = [
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'posts_per_page' => 4,     
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ];

                $latest_posts = new WP_Query( $args );

                if ( $latest_posts->have_posts() ) :
                    while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
                    get_template_part( 'template-parts/content', 'minipost' );
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>
        </div>
        <button onclick="window.location.href='<?php echo site_url(); ?>/blog'" class="btn primary go-to-blog" aria-label="Link to go blog page">
            Ver todos los artículos
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"></path></svg>
        </button>
    </div>
</section>