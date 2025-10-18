<div id="main" class="site-main" role="main"> 
    <article class="page" id="<?php the_ID(); ?>">
        <header class="block page">
            <div class="content heading">
                <div class="backdrop"></div>
                <?php
                if ( has_post_thumbnail() ) {
                        echo get_the_post_thumbnail( null, 'full', [ 'class' => 'background-hero', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
                    }

                    the_title( '<h1 class="page-title"><div class="backdrop"></div><div class="glass-reflex"></div>', '</h1>' );

                    if ( get_the_modified_time('d/m/Y') ) {
                        echo '<p class="latest-modified">' . esc_html__( 'Este archivo fue modificado por última vez el ', 'outlet' ) . get_the_modified_time('d/m/Y') . '</p>';
                    }
                ?>
            </div>
        </header>
        <section class="block">
            <div class="is-layout-constrained">
                <?php the_content(); ?>
            </div>
        </section>
    </article>
</div>