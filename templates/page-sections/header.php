<header class="block">
    <div class="content">
        <div class="backdrop"></div>
        <?php
        if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( null, 'full', [ 'class' => 'background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
            }

            the_title( '<h1 class="page-title">', '</h1>' );

            // Only show the modified date on pages or content-page template part
            if ( is_page() && basename( get_page_template() ) === 'page.php' || basename( get_template_part() ) === 'content-page' ) {
                if ( get_the_modified_time( 'd/m/Y' ) ) {
                    echo '<p class="latest-modified">'
                        . esc_html__( 'Este archivo fue modificado por última vez el ', 'inmobiliaria' )
                        . get_the_modified_time( 'd/m/Y' )
                        . '</p>';
                }
            }

            
        ?>
    </div>
</header>