<article class="post">
    <div class="backdrop"></div>
    <?php
        if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail( null, 'post-header-thumbnail', [ 'class' => 'thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy' ] );
        }
    ?>
    <a href="<?php the_permalink(); ?>" class="post--permalink">
        <?php the_title( '<h3 class="post--title">', '</h3>' ); ?>
    </a>
</article>