<?php
/**
 * The template for displaying the front page
 *
 * This is the template that displays the front page by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package inmobiliaria
 * @since 1.0.0
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
        $directory = get_template_directory() . '/templates';

        $sections = [
            'frontpage/hero',
            'frontpage/featured-properties',
            'frontpage/filter-properties',
            'frontpage/why-choose-us',
            'frontpage/testimonies',
            'frontpage/call-to-action',
            'frontpage/about-us',
            // 'frontpage/blog',
            // 'frontpage/contact',
            // 'frontpage/interactive-map',
        ];

        foreach ( $sections as $section => $condition ) {
            if ( is_int( $section ) ) {
                $section   = $condition;
                $condition = true;
            }

            if ( $condition && file_exists( "$directory/$section.php" ) ) {
                include "$directory/$section.php";
            }
        }
    ?>
</main>

<?php get_footer(); ?>