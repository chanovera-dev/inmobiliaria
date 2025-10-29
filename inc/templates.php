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
 * Returns a centralized registry of all theme asset paths.
 *
 * Provides a single source of truth for referencing CSS and JS files used
 * throughout the theme. This ensures consistency, reduces repetition across
 * enqueue functions, and simplifies maintenance when updating asset locations.
 *
 * The returned array is organized into 'css' and 'js' subarrays, where each key
 * corresponds to an asset handle and each value is its relative path from the
 * theme directory.
 *
 * Example:
 * $assets = inmobiliaria_get_assets();
 * wp_enqueue_style( 'frontpage', get_template_directory_uri() . $assets['css']['frontpage'] );
 *
 * @since 1.0.0
 * @package inmobiliaria
 * @return array Associative array of asset paths grouped by type ('css' and 'js').
 */
function inmobiliaria_get_assets() {
    $assets_path = '/assets';

    return [
        'css' => [
            'breadcrumbs'        => "$assets_path/css/breadcrumbs.css",
            'posts'              => "$assets_path/css/posts.css",
            'shapes'             => "$assets_path/css/shapes.css",
            'pagination'         => "$assets_path/css/pagination.css",
            'page-thumbnail'     => "$assets_path/css/page-thumbnail.css",
            'page'               => "$assets_path/css/page.css",
            'single'             => "$assets_path/css/single.css",
            'comments'           => "$assets_path/css/comments.css",
            'frontpage'          => "$assets_path/css/frontpage.css",
            'hero'               => "$assets_path/css/frontpage/hero.css",
            'featured-properties'=> "$assets_path/css/frontpage/featured-properties.css",
            'filter-properties'  => "$assets_path/css/frontpage/filter-properties.css",
            'why-choose-us'      => "$assets_path/css/frontpage/why-choose-us.css",
            'testimonies'        => "$assets_path/css/frontpage/testimonies.css",
            'call-to-action'     => "$assets_path/css/frontpage/call-to-action.css",
            'about-us'           => "$assets_path/css/frontpage/about-us.css",
            'frontpage-blog'     => "$assets_path/css/frontpage/blog.css",
            'frontpage-contact'  => "$assets_path/css/frontpage/contact.css",
            'properties'         => "$assets_path/css/properties.css",
            'sidebar'            => "$assets_path/css/properties-sidebar.css",
            'property'           => "$assets_path/css/property.css",
            'error404'           => "$assets_path/css/error404.css",
        ],
        'js' => [
            'filters'            => "$assets_path/js/filters.js",
            'reset'              => "$assets_path/js/reset-properties-filter.js",
            'ajax-properties'    => "$assets_path/js/ajax-properties.js",
            'galery'             => "$assets_path/js/galery.js",
            'slideshow'          => "$assets_path/js/slideshow.js",
            'slideshow-related'  => "$assets_path/js/slideshow-related-properties.js",
            'parallax'           => "$assets_path/js/parallax.js",
            'animate-in'         => "$assets_path/js/animate-in.js",
            'animation-numbers'  => "$assets_path/js/animation-numbers.js",
            'parallax-hero'      => "$assets_path/js/parallax-hero.js",
            'fp-contact-script'  => "$assets_path/js/fp-contact.js",
        ]
    ];
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
        $a = inmobiliaria_get_assets();

        inmobiliaria_enqueue_style( 'page', $a['css']['page'] );

        $post_id = get_queried_object_id();
        if ( $post_id && has_post_thumbnail( $post_id ) ) {
            inmobiliaria_enqueue_style( 'page-thumbnail', $a['css']['page-thumbnail'] );
            inmobiliaria_enqueue_script( 'parallax-hero', $a['js']['parallax-hero'] );
        }

        if ( is_single() ) {
            inmobiliaria_enqueue_style( 'single', $a['css']['single'] );
            
            $related_posts = get_posts( [
                'post__not_in' => [ $post_id ],
                'posts_per_page' => 1,
                'category__in' => wp_get_post_categories( $post_id ),
                'tag__in' => wp_get_post_tags( $post_id, [ 'fields' => 'ids' ] ),
            ] );

            if ( ! empty( $related_posts ) ) {
                inmobiliaria_enqueue_style( 'posts', $a['css']['posts'] );
                inmobiliaria_enqueue_style( 'shapes', $a['css']['shapes'] );
            }

            if ( comments_open() ) {
                inmobiliaria_enqueue_style( 'custom-comments', $a['css']['comments'] );
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
    if ( is_home() or is_archive() or is_search() ) {
        $a = inmobiliaria_get_assets();
        
        inmobiliaria_enqueue_style( 'breadcrumbs', $a['css']['breadcrumbs'] );
        inmobiliaria_enqueue_style( 'posts', $a['css']['posts'] );
        inmobiliaria_enqueue_style( 'shapes', $a['css']['shapes'] );
        inmobiliaria_enqueue_style( 'pagination', $a['css']['pagination'] );
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
    if ( is_404() ) {
        $a = inmobiliaria_get_assets();

        $error404_css = "$assets_path/css/error404.css";
        inmobiliaria_enqueue_style( 'error404', $a['css']['error404'] );
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
    if ( is_front_page() || is_page_template( 'front-page.php' ) ) {
        $a = inmobiliaria_get_assets();

        wp_dequeue_style( 'page' );
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_script( 'property-filter' );
        wp_dequeue_script( 'reset' );

        inmobiliaria_enqueue_style( 'shapes', $a['css']['shapes'] );
        inmobiliaria_enqueue_style( 'frontpage', $a['css']['frontpage'] );
        inmobiliaria_enqueue_style( 'hero', $a['css']['hero'] );
        inmobiliaria_enqueue_style( 'featured-properties', $a['css']['featured-properties'] );
        inmobiliaria_enqueue_style( 'filter-properties', $a['css']['filter-properties'] );
        inmobiliaria_enqueue_style( 'why-choose-us', $a['css']['why-choose-us'] );
        inmobiliaria_enqueue_style( 'testimonies', $a['css']['testimonies'] );
        inmobiliaria_enqueue_style( 'call-to-action', $a['css']['call-to-action'] );
        inmobiliaria_enqueue_style( 'about-us', $a['css']['about-us'] );
        inmobiliaria_enqueue_style( 'blog', $a['css']['frontpage-blog'] );
        inmobiliaria_enqueue_style( 'contact', $a['css']['frontpage-contact'] );

        inmobiliaria_enqueue_script( 'animate-in', $a['js']['animate-in'] );
        inmobiliaria_enqueue_script( 'featured-properties-slideshow', $a['js']['slideshow'] );
        inmobiliaria_enqueue_script( 'parallax', $a['js']['parallax'] );
        inmobiliaria_enqueue_script( 'animation-numbers', $a['js']['animation-numbers'] );
        // inmobiliaria_enqueue_script( 'contact-script', $a['js']['fp-contact-script'] );

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
    if ( is_page_template( 'archive-property.php' ) ) {
        $a  = inmobiliaria_get_assets();

        inmobiliaria_enqueue_style( 'breadcrumbs', $a['css']['breadcrumbs'] );
        inmobiliaria_enqueue_style( 'properties', $a['css']['properties'] );
        inmobiliaria_enqueue_style( 'sidebar', $a['css']['sidebar'] );
        inmobiliaria_enqueue_style( 'shapes', $a['css']['shapes'] );
        inmobiliaria_enqueue_style( 'pagination', $a['css']['pagination'] );
        inmobiliaria_enqueue_script( 'filters', $a['js']['filters'] );
        inmobiliaria_enqueue_script( 'reset', $a['js']['reset'] );

        wp_enqueue_script('ajax-properties', get_template_directory_uri() . '/assets/js/ajax-properties.js', ['jquery'], null, true);
        wp_localize_script('ajax-properties', 'ajax_object', [ 'ajaxurl' => admin_url('admin-ajax.php'), ]);
    }

    if ( is_singular( 'property' ) ) {
        $a  = inmobiliaria_get_assets();

        inmobiliaria_enqueue_style( 'breadcrumbs', $a['css']['breadcrumbs'] );
        inmobiliaria_enqueue_style( 'property', $a['css']['property'] );
        inmobiliaria_enqueue_style( 'shapes', $a['css']['shapes'] );
        inmobiliaria_enqueue_script( 'galery', $a['js']['galery'] );
        inmobiliaria_enqueue_script( 'slideshow-related-product', $a['js']['slideshow'] );
        inmobiliaria_enqueue_script( 'parallax', $a['css']['parallax'] );
    }
}
add_action( 'wp_enqueue_scripts', 'properties_templates' );