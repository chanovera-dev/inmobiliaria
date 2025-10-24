<section id="filter-properties" class="block">
    <div class="content">
        <h2 class="title-section">Encuentra lo que buscas</h2>
    </div>
    <?php

            // --- WP_Query de propiedades relacionadas ---
            $args = array(
                'post_type'      => 'property',
                'post_status'    => 'publish',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'no_found_rows'  => true,
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                echo '<div class="content properties-min">';
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/content', 'property');
                }
                echo '</div>';
            } else {
                echo '<p>No se encontraron propiedades relacionadas en la zona.</p>';
            }

            wp_reset_postdata();
        ?>
</section>