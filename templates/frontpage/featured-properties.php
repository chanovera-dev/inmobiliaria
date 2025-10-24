<section id="featured-properties" class="block">
    <div class="container">
        <div class="title-section--wrapper">
            <h2 class="title-section glass-bright">Propiedades que te encantarán</h2>
            <button onclick="window.location.href='<?php echo site_url(); ?>/contacto'" class="btn primary go-to-contact" aria-name="Link to go contact page">Contacta a un asesor</button>
            <button onclick="window.location.href='<?php echo site_url(); ?>/propiedades'" class="btn without-line go-to-properties" aria-name="Link to go properties page">Ver todas las propiedades</button>
        </div>
        <div class="slideshow-wrapper">
            <div class="slideshow">
                <?php
                    $args = [
                    'post_type'      => 'property',
                    'posts_per_page' => 5,
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                    'meta_query'     => [
                        [
                            'key'     => 'featured',
                            'value'   => 1,
                            'compare' => '='
                        ]
                    ]
                ];

                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) :
                        while ( $query->have_posts() ) :
                            $query->the_post();
                            get_template_part( 'template-parts/slideshow', 'card' );
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>No hay propiedades disponibles.</p>';
                    endif;
                ?>
            </div>
            <div class="slideshow-bullets-wrapper">
                <button class="slideshow-prev btn-pagination glass-backdrop glass-bright"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg></button>
                <ul class="slideshow-bullets"></ul>
                <button class="slideshow-next btn-pagination glass-backdrop glass-bright"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg></button>
            </div>
        </div>
    </div>
</section>