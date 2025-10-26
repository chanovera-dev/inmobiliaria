<article class="post">
    <header class="post--header glass-bright">
        <?php echo get_the_post_thumbnail( null, 'post-header-thumbnail', [ 'class' => 'post-thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy' ] ); ?>
        <div class="glass-reflex"></div>
    </header>
    <div class="post--content">
        <span class="post--date"><?php echo get_the_date(); ?></span>
        <?php the_title( '<h3 class="post--title">', '</h3>' ); ?>
        <a class="btn without-line post--permalink" href="<?php the_permalink(); ?>">
            Leer más
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"></path></svg>
        </a>
    </div>
</article>