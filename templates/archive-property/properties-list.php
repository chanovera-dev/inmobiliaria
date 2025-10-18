<?php
    $paged = max(1, get_query_var('paged') ?: get_query_var('page'));
    $args = [
        'post_type' => 'property',
        'posts_per_page' => 12,
        'paged' => $paged,
    ];
    $query = new WP_Query($args);
    if($query->have_posts()):
        while($query->have_posts()): $query->the_post();
            get_template_part('template-parts/content', 'property');
        endwhile;
        echo '<div class="pagination">';
        echo paginate_links([
            'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => $query->max_num_pages,
            'mid_size' => 2,
            'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg>',
            'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg>',
        ]);
        echo '</div>';
    else:
        echo '<p>No se encontraron propiedades.</p>';
    endif;
    wp_reset_postdata();
?>