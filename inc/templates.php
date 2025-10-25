<?php
/**
 * Theme Templates and Asset Loader
 *
 * Handles enqueueing of CSS and JS assets for different page templates and conditions.
 * 
 * This file provides helper functions to enqueue styles and scripts with automatic
 * versioning, and selectively loads assets for:
 * - Single posts and pages (including featured images, related posts, and comments)
 * - Post listing pages (home, archives, search)
 * - 404 error page
 * - Front page
 *
 * The goal is to optimize performance by loading only the necessary assets
 * for each page type, reducing unnecessary HTTP requests.
 *
 * @package Inmobiliaria
 * @since 1.0.0
 */

/**
 * Helper: Enqueue style file with automatic versioning
 *
 * @param string $handle
 * @param string $path
 * @param string $media
 * @return void
 */
function inmobiliaria_enqueue_style( $handle, $path, $media = 'all' ) {
    $uri = get_template_directory_uri();
    wp_enqueue_style( $handle, $uri . $path, [], get_asset_version( $path ), $media );
}

/**
 * Helper: Enqueue script file with automatic versioning
 *
 * @param string $handle
 * @param string $path
 * @return void
 */
function inmobiliaria_enqueue_script( $handle, $path ) {
    $uri = get_template_directory_uri();
    wp_enqueue_script( $handle, $uri . $path, [], get_asset_version( $path ), true );
}

/**
 * Enqueues styles and scripts for single posts and pages.
 *
 * Loads page-specific assets when viewing single posts or pages.
 * Includes optional styles for featured images, related posts,
 * and comments, as well as JS effects such as parallax and blur typing.
 * Related posts and comment styles are loaded conditionally.
 *
 * @since 1.0.0
 * @return void
 */
function page_template() {
    $assets_path = '/assets';

    if ( is_page() or is_single() ) {
        $page_css       = "$assets_path/css/page.css";
        $single_css     = "$assets_path/css/single.css";
        $related_css    = "$assets_path/css/posts.css";
        $shapes_css     = "$assets_path/css/shapes.css";
        $comments_css   = "$assets_path/css/comments.css";
        $page_thumbnail = "$assets_path/css/page-thumbnail.css";
        $parallax_hero  = "$assets_path/js/parallax-hero.js";

        inmobiliaria_enqueue_style( 'page', $page_css );

        $post_id = get_queried_object_id();
        if ( $post_id && has_post_thumbnail( $post_id ) ) {
            inmobiliaria_enqueue_style( 'page-thumbnail', $page_thumbnail );
            inmobiliaria_enqueue_script( 'parallax-hero', $parallax_hero );
        }

        if ( is_single() ) {
            inmobiliaria_enqueue_style( 'single', $single_css );
            inmobiliaria_enqueue_style( 'related-posts', $related_css );
            inmobiliaria_enqueue_style( 'shapes', $shapes_css );
            // $related_posts = get_posts( [
            //     'post__not_in' => [ $post_id ],
            //     'posts_per_page' => 1,
            //     'category__in' => wp_get_post_categories( $post_id ),
            //     'tag__in' => wp_get_post_tags( $post_id, [ 'fields' => 'ids' ] ),
            // ] );

            // if ( ! empty( $related_posts ) ) {
            //     inmobiliaria_enqueue_style( 'related-posts', $related_css );
            // }

            if ( comments_open() ) {
                inmobiliaria_enqueue_style( 'custom-comments', $comments_css );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'page_template' );

/**
 * Enqueues styles and scripts for post listings pages.
 *
 * Loads specific CSS and JS assets for the blog home, archives, 
 * and search results pages. Includes pagination styles only 
 * when pagination links are present.
 *
 * @since 1.0.0
 * @return void
 */
function posts_styles() {
    $assets_path = '/assets';

    if ( is_home() or is_archive() or is_search() ) {
        $breadcrumbs_css = "$assets_path/css/breadcrumbs.css";
        $posts_css       = "$assets_path/css/posts.css";
        $shapes_css      = "$assets_path/css/shapes.css";
        $pagination_css  = "$assets_path/css/pagination.css";

        inmobiliaria_enqueue_style( 'breadcrumbs', $breadcrumbs_css );
        inmobiliaria_enqueue_style( 'posts', $posts_css );
        inmobiliaria_enqueue_style( 'shapes', $shapes_css );
        
        if ( paginate_links() ) {
            inmobiliaria_enqueue_style( 'pagination', $pagination_css );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'posts_styles' );

/**
 * Enqueues styles specifically for 404 error page
 * 
 * Loads custom CSS file only when viewing 404 page
 * to optimize performance and reduce unnecessary loading
 *
 * @since 1.0.0
 * @return void
 */
function page404_styles() {
    $assets_path = '/assets';

    if ( is_404() ) {
        $error404_css = "$assets_path/css/error404.css";
        inmobiliaria_enqueue_style( 'error404', $error404_css );
    }
}
add_action( 'wp_enqueue_scripts', 'page404_styles' );

/**
 * Frontpage template styles
 * 
 * Loads custom CSS file only when viewing the front page
 * to optimize performance and reduce unnecessary loading
 *
 * @since 1.0.0
 * @return void
 */
function frontpage_template() {
    $assets_path = '/assets';

    if ( is_front_page() || is_page_template( 'front-page.php' ) ) {
        $shapes_css              = "$assets_path/css/shapes.css";
        $frontpage_css           = "$assets_path/css/frontpage.css";
        $hero_css                = "$assets_path/css/frontpage/hero.css";
        $featured_properties_css = "$assets_path/css/frontpage/featured-properties.css";
        $featured_properties_js  = "$assets_path/js/slideshow.js";
        $filter_properties_js    = "$assets_path/js/slideshow-related-properties.js";
        $filter_properties_css   = "$assets_path/css/frontpage/filter-properties.css";
        $choose_us_css           = "$assets_path/css/frontpage/why-choose-us.css";
        $testimonies_css         = "$assets_path/css/frontpage/testimonies.css";

        inmobiliaria_enqueue_style( 'shapes', $shapes_css );
        inmobiliaria_enqueue_style( 'frontpage', $frontpage_css );
        inmobiliaria_enqueue_style( 'hero', $hero_css );
        inmobiliaria_enqueue_style( 'featured-properties', $featured_properties_css );
        inmobiliaria_enqueue_style( 'filter-properties', $filter_properties_css );
        inmobiliaria_enqueue_style( 'why-choose-us', $choose_us_css );
        inmobiliaria_enqueue_style( 'testimonies', $testimonies_css );

        inmobiliaria_enqueue_script( 'featured-properties-slideshow', $featured_properties_js );
        inmobiliaria_enqueue_script( 'filter-properties-slideshow', $filter_properties_js );
    }
}
add_action( 'wp_enqueue_scripts', 'frontpage_template' );

/**
 * Enqueues specific styles and scripts for property-related templates.
 *
 * This function loads custom CSS and JavaScript files for:
 * - Property archive pages (archive-property.php), including filters,
 *   pagination, and AJAX-powered property loading.
 * - Single property pages (single-property.php), including gallery,
 *   related property slideshow, and parallax effects.
 *
 * It uses custom enqueue helpers (inmobiliaria_enqueue_style/script)
 * and localizes the AJAX script with the admin-ajax URL.
 *
 * @since 1.0.0
 * @package inmobiliaria
 */
function properties_templates() {
    $assets_path = '/assets';

    if ( is_page_template( 'archive-property.php' ) ) {
        $breadcrumbs_css = "$assets_path/css/breadcrumbs.css";
        $properties_css  = "$assets_path/css/properties.css";
        $sidebar_css     = "$assets_path/css/properties-sidebar.css";
        $shapes_css      = "$assets_path/css/shapes.css";
        $pagination_css  = "$assets_path/css/pagination.css";
        $filters         = "$assets_path/js/filters.js";
        $reset           = "$assets_path/js/reset-properties-filter.js";

        inmobiliaria_enqueue_style( 'breadcrumbs', $breadcrumbs_css );
        inmobiliaria_enqueue_style( 'properties', $properties_css );
        inmobiliaria_enqueue_style( 'sidebar', $sidebar_css );
        inmobiliaria_enqueue_style( 'shapes', $shapes_css );
        inmobiliaria_enqueue_style( 'pagination', $pagination_css );
        inmobiliaria_enqueue_script( 'filters', $filters );
        inmobiliaria_enqueue_script( 'reset', $reset );

        wp_enqueue_script('ajax-properties', get_template_directory_uri() . '/assets/js/ajax-properties.js', ['jquery'], null, true);
        wp_localize_script('ajax-properties', 'ajax_object', [ 'ajaxurl' => admin_url('admin-ajax.php'), ]);
    }

    if ( is_singular( 'property' ) ) {
        $breadcrumbs_css = "$assets_path/css/breadcrumbs.css";
        $property_css    = "$assets_path/css/property.css";
        $shapes_css      = "$assets_path/css/shapes.css";
        $galery_js       = "$assets_path/js/galery.js";
        $slideshow       = "$assets_path/js/slideshow-related-properties.js";
        $parallax        = "$assets_path/js/parallax.js";

        inmobiliaria_enqueue_style( 'breadcrumbs', $breadcrumbs_css );
        inmobiliaria_enqueue_style( 'property', $property_css );
        inmobiliaria_enqueue_style( 'shapes', $shapes_css );
        inmobiliaria_enqueue_script( 'galery', $galery_js );
        inmobiliaria_enqueue_script( 'slideshow-related-product', $slideshow );
        inmobiliaria_enqueue_script( 'parallax', $parallax );

    }
}
add_action( 'wp_enqueue_scripts', 'properties_templates' );