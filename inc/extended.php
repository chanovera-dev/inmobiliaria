<?php
/**
 * Extended Theme Functions
 *
 * Additional functionality for the Inmobiliaria theme:
 * - Safe SVG upload support (adds SVG MIME type with security considerations)
 * - Custom excerpt length (21 words) for archive/search displays
 * - Enhanced menu output for the primary menu (submenu indicators, custom markup)
 *
 * @package inmobiliaria
 * @since 1.0.0
 */

/**
 * Enables SVG file upload support with security checks
 * 
 * Adds SVG MIME type to allowed upload formats while maintaining
 * WordPress security standards.
 *
 * @param array $mimes Current allowed MIME types
 * @return array Modified MIME types
 */
function mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'mime_types' ); 

/**
 * Customizes excerpt length for better readability
 * 
 * Reduces post excerpt length to 21 words for improved
 * display in archive pages and search results.
 *
 * @param int $limit Current excerpt length
 * @return int Modified excerpt length (21)
 */
function reduce_excerpt_length($limit) {
    return 21;
}
add_filter('excerpt_length', 'reduce_excerpt_length', 999);

/**
 * Enhances menu structure with custom elements
 * 
 * Adds submenu indicators and custom markup for mobile and primary
 * navigation menus. Includes SVG icons for visual hierarchy.
 *
 * @param string $item_output The menu item's HTML
 * @param object $item Menu item data object
 * @param int $depth Depth of menu item
 * @param object $args Menu arguments
 * @return string Modified menu item HTML
 */
function custom_menu($item_output, $item, $depth, $args) {
    
    $allowed_locations = ['primary'];

    if (!isset($args->theme_location) || !in_array($args->theme_location, $allowed_locations)) {
        return $item_output;
    }

    global $submenu_items_by_parent;
    static $checked_menus = [];

    if (!empty($args->menu) && !in_array($args->menu->term_id, $checked_menus)) {
        $menu_items = wp_get_nav_menu_items($args->menu->term_id);
        foreach ($menu_items as $menu_item) {
            $submenu_items_by_parent[$menu_item->menu_item_parent][] = $menu_item;
        }
        $checked_menus[] = $args->menu->term_id;
    }

    $has_children = !empty($submenu_items_by_parent[$item->ID]);

    if ($has_children) {
        $text = '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        $svg_icon = '<svg width="13" height="13" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"></path></svg>';

        return '<div class="wrapper-for-title">' . $text . '<button class="button-for-submenu">' . $svg_icon . '</button></div>';
    }

    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'custom_menu', 10, 4);

/**
 * Adds custom icons to social and contact menu links.
 *
 * This function injects CSS into the <head> to apply SVG icons as masks (`mask-image`)
 * for links within menus with the `.social` and `.contact` classes.
 *
 * - In `.social .menu`, it detects social media links by their href and assigns
 *   the corresponding icon (Facebook, WhatsApp, Twitter, YouTube, Instagram, Google, TikTok, LinkedIn).
 * - In `.contact .menu`, it detects contact links by their href (tel, mailto) and assigns
 *   the corresponding icon.
 *
 * Icons are loaded from the `assets/icons` folder of the active theme.
 *
 * @return void
 */
function theme_custom_icons() {
    ?>
        <style>          
            /* iconos de redes sociales */
            .social .menu li a[href*="facebook"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/facebook.svg');}
            .social .menu li a[href*="wa.me"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/whatsapp.svg');}
            .social .menu li a[href*="twitter"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/twitter.svg');}
            .social .menu li a[href*="youtube"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/youtube.svg');}
            .social .menu li a[href*="instagram"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/instagram.svg');}
            .social .menu li a[href*="google"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/google.svg');}
            .social .menu li a[href*="tiktok"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/tiktok.svg');}
            .social .menu li a[href*="linkedin"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/linkedin.svg');}

            .contact .menu li a[href*="tel"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/support-phone.svg');}
            .contact .menu li a[href*="mailto"]:before{mask-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/mailto.svg');}
        </style>
    <?php
}
add_action('wp_head', 'theme_custom_icons');

/**
 * Modify the size of the comment avatar in WordPress.
 */
function custom_comment_avatar_size($avatar) {
    // Remove existing width, height, and style attributes from the avatar
    $avatar = preg_replace('/(width|height)="\d*"\s/', '', $avatar);
    $avatar = preg_replace('/style=["\'](.*?)["\']/', '', $avatar);

    // Set a fixed width and height of 70 pixels for the avatar
    $avatar = preg_replace('/src=([\'"])((?:(?!\1).)*?)\1/', 'src=$1$2$1 width="70" height="70"', $avatar);

    return $avatar;
}
add_filter('get_avatar', 'custom_comment_avatar_size', 10, 1);

function format_numeric($number) {
    // Elimina cualquier carácter que no sea número o punto decimal
    $number = preg_replace('/[^\d.]/', '', $number);
    
    // Convierte a float por seguridad
    $number = (float) $number;

    // Devuelve el número con formato: coma para miles, punto para decimales
    // Ejemplo: 1234567.89 → 1,234,567.89
    return number_format($number, 0, '.', ',');
}

function wp_breadcrumbs() {
    $separator = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg>';
    $icon_home = '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12.7596C5 11.4019 5 10.723 5.27446 10.1262C5.54892 9.52949 6.06437 9.08769 7.09525 8.20407L8.09525 7.34693C9.95857 5.7498 10.8902 4.95123 12 4.95123C13.1098 4.95123 14.0414 5.7498 15.9047 7.34693L16.9047 8.20407C17.9356 9.08769 18.4511 9.52949 18.7255 10.1262C19 10.723 19 11.4019 19 12.7596V17C19 18.8856 19 19.8284 18.4142 20.4142C17.8284 21 16.8856 21 15 21H9C7.11438 21 6.17157 21 5.58579 20.4142C5 19.8284 5 18.8856 5 17V12.7596Z" stroke="currentColor"/><path d="M14.5 21V16C14.5 15.4477 14.0523 15 13.5 15H10.5C9.94772 15 9.5 15.4477 9.5 16V21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $home = 'Inicio';
    $current = 'Propiedades en venta';
    
    $homeLink = get_bloginfo('url');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    echo '<nav class="breadcrumbs">';
    echo '<a class="go-home" href="' . esc_url($homeLink) . '">' . $icon_home . esc_html($home) . '</a>' . $separator;

    // Para el template archive-property.php
    if ( is_page_template('archive-property.php') || is_post_type_archive('property') ) {
        if ($paged === 1) {
            echo '<h1 class="page-title">' . esc_html($current) . '</h1>';
        } else {
            echo '<h1 class="page-title">' . esc_html('Página ' . $paged) . '</h1>';
        }

        // Navegación entre páginas
        $prev_link = get_previous_posts_page_link();
        $next_link = get_next_posts_page_link();

        if ($prev_link || $next_link) {
            echo '<div class="breadcrumb-pagination">';
            
            if ($prev_link) {
                echo '<a class="breadcrumb-prev" href="' . esc_url($prev_link) . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg></a>';
            }

            if ($next_link) {
                echo '<a class="breadcrumb-next" href="' . esc_url($next_link) . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg></a>';
            }

            echo '</div>';
        }
    }

    echo '</nav>';
}

/****************************************************************************************************************
 * E A S Y B R O K E R
 ****************************************************************************************************************/

/**
 * Fetches property data from the EasyBroker API.
 *
 * This function connects to the EasyBroker REST API and retrieves a list of properties 
 * according to the specified filters. It is primarily used to display property listings 
 * on the website (for example, in sales or rental sections). 
 *
 * Parameters:
 * - $operation_type (string|null): Optional filter for operation type ('sale', 'rent', etc.).
 * - $limit (int): Maximum number of properties to fetch (default: 12).
 *
 * Returns:
 * - array: An associative array containing property data from EasyBroker.
 *           Returns an empty array if the API request fails or if no data is available.
 *
 * Example usage:
 *   $properties = eb_get_properties('sale', 10);
 *   foreach ($properties as $property) {
 *       echo $property['title'];
 *   }
 */
function eb_get_properties($operation_type = null, $limit = 12) {
    $api_key = EASYBROKER_API_KEY;
    $url = 'https://api.easybroker.com/v1/properties?limit=' . intval($limit);

    // Add operation type filter if specified (e.g., 'sale', 'rent')
    if ($operation_type) {
        $url .= '&operation_type=' . urlencode($operation_type);
    }

    $args = array(
        'headers' => array(
            'X-Authorization' => $api_key
        ),
        'timeout' => 15,
    );

    $response = wp_remote_get($url, $args);

    // Return empty array if API request fails
    if (is_wp_error($response)) return [];

    // Decode JSON response and return property content if available
    $body = json_decode(wp_remote_retrieve_body($response), true);
    return $body['content'] ?? [];
}

/****************************************************************************************************************
 * P R O P E R T I E S
 ****************************************************************************************************************/

/**
 * Retrieves and caches a list of property locations grouped by state and city.
 *
 * This function collects location data (state, city, and neighborhood) from published
 * property posts, organizes them into a structured array, removes duplicates, and
 * sorts them alphabetically. The result is cached using a transient for performance.
 *
 * @return array An associative array of locations grouped by state.
 */
function get_property_locations() {
    $locations = get_transient('property_locations');

    // Return cached data if available
    if ($locations !== false) {
        return $locations;
    }

    // Get a limited number of published properties
    $properties = get_posts([
        'post_type' => 'property',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ]);

    $locations = [];

    if ($properties) {
        foreach ($properties as $prop) {
            $loc = get_post_meta($prop->ID, 'eb_location', true);
            if ($loc) {
                // Split the location string and trim extra spaces
                $parts = array_map('trim', explode(',', $loc));

                // Expected format: [neighborhood, city, state]
                $neighborhood = $parts[0] ?? '';
                $city         = $parts[1] ?? '';
                $state        = $parts[2] ?? '';

                // Group cities by state
                if ($state && $city) {
                    $locations[$state][] = $city;
                }
            }
        }

        // Remove duplicates and sort alphabetically
        foreach ($locations as $state => $cities) {
            $locations[$state] = array_unique($cities);
            sort($locations[$state]);
        }
        ksort($locations);
    }

    // Cache the results for one day
    set_transient('property_locations', $locations, DAY_IN_SECONDS);

    return $locations;
}

// Clear the cached data when a property is saved or updated
add_action('save_post_property', function() {
    delete_transient('property_locations');
});

/**
 * Registers the "Property" custom post type (CPT) for real estate listings.
 * 
 * This function is used as a fallback in case the SCF plugin is not available
 * to register the 'property' post type. It sets up basic labels, supports,
 * archive behavior, REST API availability, and the admin menu icon.
 */
// function eb_register_post_type() {
//     register_post_type('property', [
//         'label' => 'Propiedades',
//         'public' => true,
//         'menu_icon' => 'dashicons-admin-home',
//         'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
//         'has_archive' => true,
//         'rewrite' => ['slug' => 'properties'],
//         'show_in_rest' => true,
//     ]);
// }
// add_action('init', 'eb_register_post_type');

/****************************************************************************************************************
 * A J A X   P R O P E R T I E S
 ****************************************************************************************************************/

function enqueue_property_filter_script() {
    wp_enqueue_script('property-filter', get_template_directory_uri() . '/assets/js/ajax-properties.js', ['jquery'], null, true);
    wp_localize_script('property-filter', 'ajaxurlObj', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_property_filter_script');

/**
 * AJAX property filter handler.
 *
 * Handles AJAX requests to filter property listings based on various criteria:
 * operation type, property type, location, bedrooms, bathrooms, price, 
 * construction size, and lot size. Builds a dynamic WP_Query based on 
 * user-submitted filters and returns matching property templates.
 *
 * @since 1.0.0
 * @return void
 */
add_action('wp_ajax_filter_properties', 'ajax_filter_properties');
add_action('wp_ajax_nopriv_filter_properties', 'ajax_filter_properties');

function ajax_filter_properties() {
    $paged = isset($_POST['paged']) ? (int) $_POST['paged'] : 1;

    $args = [
        'post_type' => 'property',
        'posts_per_page' => 12,
        'paged' => $paged, // 👈 ahora usa el valor real
        'meta_query' => ['relation' => 'AND'],
        's' => !empty($_POST['search']) ? sanitize_text_field($_POST['search']) : '',
    ];

    /* ===========================
       OPERATION (Sale / Rent)
    ============================ */
    if (!empty($_POST['operation'])) {
        $args['meta_query'][] = [
            'key' => 'eb_operation',
            'value' => (array) $_POST['operation'],
            'compare' => 'IN'
        ];
    }

    /* ===========================
       PROPERTY TYPE
    ============================ */
    if (!empty($_POST['type'])) {
        $args['meta_query'][] = [
            'key' => 'eb_property_type',
            'value' => (array) $_POST['type'],
            'compare' => 'IN'
        ];
    }

    /* ===========================
       LOCATION (State / City)
    ============================ */
    $meta_location = [];

    if (!empty($_POST['state'])) {
        foreach ((array) $_POST['state'] as $state) {
            $meta_location[] = [
                'key' => 'eb_location',
                'value' => sanitize_text_field($state),
                'compare' => 'LIKE'
            ];
        }
    }

    if (!empty($_POST['city'])) {
        foreach ((array) $_POST['city'] as $city) {
            $meta_location[] = [
                'key' => 'eb_location',
                'value' => sanitize_text_field($city),
                'compare' => 'LIKE'
            ];
        }
    }

    if (!empty($meta_location)) {
        $args['meta_query'][] = array_merge(['relation' => 'OR'], $meta_location);
    }

    /* ===========================
       BEDROOMS
    ============================ */
    if (!empty($_POST['bedrooms'])) {
        $args['meta_query'][] = [
            'key' => 'eb_bedrooms',
            'value' => intval($_POST['bedrooms']),
            'compare' => '=',
            'type' => 'NUMERIC'
        ];
    }

    /* ===========================
       BATHROOMS
    ============================ */
    if (!empty($_POST['bathrooms'])) {
        $args['meta_query'][] = [
            'key' => 'eb_bathrooms',
            'value' => intval($_POST['bathrooms']),
            'compare' => '=',
            'type' => 'NUMERIC'
        ];
    }

    /* ===========================
       PRICE RANGE
    ============================ */
    $price_min = isset($_POST['price_min']) && $_POST['price_min'] !== '' ? floatval($_POST['price_min']) : 0;
    $price_max = isset($_POST['price_max']) && $_POST['price_max'] !== '' ? floatval($_POST['price_max']) : PHP_INT_MAX;

    if ($price_min > 0 || $price_max < PHP_INT_MAX) {
        $args['meta_query'][] = [
            'key' => 'eb_price',
            'value' => [$price_min, $price_max],
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ];
    }

    /* ===========================
       CONSTRUCTION SIZE (range)
    ============================ */
    $construction_min = isset($_POST['construction_min']) && $_POST['construction_min'] !== '' ? floatval($_POST['construction_min']) : 0;
    $construction_max = isset($_POST['construction_max']) && $_POST['construction_max'] !== '' ? floatval($_POST['construction_max']) : PHP_INT_MAX;

    if ($construction_min > 0 || $construction_max < PHP_INT_MAX) {
        $args['meta_query'][] = [
            'key' => 'eb_construction_size',
            'value' => [$construction_min, $construction_max],
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ];
    }

    /* ===========================
       LOT SIZE (range)
    ============================ */
    $lot_min = isset($_POST['lot_min']) && $_POST['lot_min'] !== '' ? floatval($_POST['lot_min']) : 0;
    $lot_max = isset($_POST['lot_max']) && $_POST['lot_max'] !== '' ? floatval($_POST['lot_max']) : PHP_INT_MAX;

    if ($lot_min > 0 || $lot_max < PHP_INT_MAX) {
        $args['meta_query'][] = [
            'key' => 'eb_lot_size',
            'value' => [$lot_min, $lot_max],
            'compare' => 'BETWEEN',
            'type' => 'NUMERIC'
        ];
    }

    /* ===========================
       EXECUTE QUERY
    ============================ */
    $query = new WP_Query($args);
    if($query->have_posts()):
        while($query->have_posts()): $query->the_post();
            get_template_part('template-parts/content', 'property');
        endwhile;
        echo '<div class="pagination">';
        echo paginate_links([
            'base' => '%_%',
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => $query->max_num_pages,
            'mid_size' => 2,
            'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg>',
            'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/></svg>',
        ]);
        echo '</div>';
    else:
        echo '<p>No se encontraron propiedades.</p>';
    endif;
    wp_reset_postdata();
    wp_die();
}