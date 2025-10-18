<?php
/* Template Name: Propiedades */
require_once locate_template('templates/archive-property/fetch-properties.php');

$locations = get_property_locations();
set_query_var('locations', $locations);
get_header(); ?>
<main id="main" class="site-main" role="main">
    <?php require_once locate_template('templates/breadcrumbs.php' ); ?>
    <div class="block properties--wrapper">
        <div class="content properties">
            <sidebar class="properties--sidebar">
                <?php get_template_part('templates/archive-property/filter', 'properties'); ?>
            </sidebar>
            <div class="properties--list">
                <?php get_template_part('templates/archive-property/properties', 'list'); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>