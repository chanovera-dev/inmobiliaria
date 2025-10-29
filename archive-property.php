<?php
/**
 * Property Archive Template
 *
 * Template for displaying the property archive page (Custom Post Type: 'property').
 * This file handles the property listing loop, filters, pagination, and AJAX-based dynamic loading.
 *
 * @package inmobiliaria
 * @since 1.0.0
 *
 * Template Name: Propiedades */
$locations = get_property_locations();
set_query_var('locations', $locations);

get_header(); ?>
<main id="main" class="site-main" role="main">
    <?php require_once locate_template('templates/breadcrumbs.php' ); ?>
    <div class="block properties--wrapper">
        <div class="content properties">
            <aside class="properties--sidebar">
                <?php get_template_part('templates/archive-property/filter', 'properties'); ?>
            </aside>
            <div class="properties--list">
                <?php get_template_part('templates/archive-property/properties', 'list'); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>