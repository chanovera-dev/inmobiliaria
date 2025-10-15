<div id="main" class="site-main" role="main">
    <article class="page" id="<?php the_ID(); ?>">
        <?php get_template_part( 'templates/page-sections/header' ); ?>
        <section class="block">
            <div class="is-layout-constrained">
                <?php the_content(); ?>
            </div>
        </section>
    </article>
</div>