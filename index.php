<?php 
/**
 * Index Template
 * 
 * @package inmobiliaria
 * @since 1.0.0
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <section class="block">
        <div class="content index">
            <?php /* translators: Page title on the index/front page. */ ?>
            <h1 class="title-page"><?php esc_html_e( 'Index', 'inmobiliaria' ); ?></h1>
        </div>
    </section>
</main>

<?php get_footer(); ?>