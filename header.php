<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php /* Title tag fallback if the theme does not support title-tag */ ?>
    <?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>

    <?php /* Output meta description if available (escaped) */ ?>
    <?php $site_description = get_bloginfo( 'description', 'display' ); ?>
    <?php if ( $site_description ) : ?>
        <meta name="description" content="<?php echo esc_attr( $site_description ); ?>">
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

    <?php /* Skip link for accessibility */ ?>
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'inmobiliaria' ); ?></a>
    <?php if ( has_nav_menu( 'social' ) || has_nav_menu( 'contact' ) ): ?>
    <section class="block">
        <div class="content">
            <?php
                // Only display the menu if a menu is assigned to the 'n' location
                if ( has_nav_menu( 'social' ) ) {
                    wp_nav_menu( array(
                        'container_class' => 'social',
                        'theme_location'  => 'social',
                    ) );
                }

                if ( has_nav_menu( 'contact' ) ) {
                    wp_nav_menu( array(
                        'container_class' => 'contact',
                        'theme_location'  => 'contact',
                    ) );
                }
            ?>
        </div>
    </section>
    <?php endif; ?>
    <header id="main-header" role="banner" aria-label="<?php echo esc_attr__( 'Main header', 'inmobiliaria' ); ?>">
        <div class="block">
            <div class="content">  
                <div class="site-brand">
                    <?php
                        // Prefer get_custom_logo() so we can control output and avoid unexpected echoes
                        $custom_logo = get_custom_logo();
                        if ( $custom_logo ) {
                            echo $custom_logo; // get_custom_logo returns safe HTML
                            echo esc_html( 'Outlet de Casas', 'inmobiliaria' );
                        } else {
                            $home_url = esc_url( home_url( '/' ) );
                            $aria_label = esc_attr__( 'Link to home page', 'inmobiliaria' );
                            $site_name = esc_html( get_bloginfo( 'name' ) );

                            // Use printf with escaped values to avoid accidental unescaped output
                            printf( '<a class="site-title" href="%1$s" aria-label="%2$s">%3$s</a>', $home_url, $aria_label, $site_name );
                        }
                    ?>
                </div>
                <?php
                    $menu_html = wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'container'       => 'nav',
                        'container_class' => 'main-navigation',
                        'echo'            => false,
                        'fallback_cb'     => false,
                    ) );

                    if ( $menu_html ) {
                        // insertar el backdrop justo después de la apertura del <nav ...>
                        $backdrop = '<div class="backdrop" aria-hidden="true"></div>';
                        $menu_html = preg_replace(
                            '/(<nav\b[^>]*class=["\\\'][^"\\\']*main-navigation[^"\\\']*["\\\'][^>]*>)/i',
                            '$1' . $backdrop,
                            $menu_html,
                            1
                        );
                        echo $menu_html;
                    }
                ?>
                <button class="menu-mobile__button" onclick="toggleMenuMobile()" aria-label="Botón para menú">
                    <span class="bar"></span>
                </button>
            </div>
        </div>
    </header>