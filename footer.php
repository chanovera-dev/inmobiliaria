        <footer id="main-footer"class="block">
            <div class="content top-footer">
                <?php $locations = get_nav_menu_locations(); ?>
                <div>
                    <img class="logo-title" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-titulo.webp" alt="" srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-titulo.webp, <?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-titulo.webp" sizes="(max-width: 150px)" width="150" height="auto" loading="lazy" decoding="async">
                </div>
                <div>
                    <?php
                        $services_menu_id = $locations['services'] ?? null;
                        $services_menu = wp_get_nav_menu_object( $services_menu_id );
                        $services_items = wp_get_nav_menu_items( $services_menu_id );

                        if ( ! empty( $services_items ) ) {
                            echo '<h3 class="title-section">' . esc_html( $services_menu->name ) . '</h3>';
                            wp_nav_menu([
                                'container'       => 'nav',
                                'container_class' => 'services',
                                'theme_location'  => 'services',
                            ]);
                        }
                    ?>
                </div>
                <div>
                    <?php
                        $contact_menu_id = $locations['contact'] ?? null;
                        $contact_menu = wp_get_nav_menu_object( $contact_menu_id );
                        $contact_items = wp_get_nav_menu_items( $contact_menu_id );

                        if ( ! empty( $contact_items ) ) {
                            echo '<h3 class="title-section">' . esc_html( $contact_menu->name ) . '</h3>';
                            wp_nav_menu([
                                'container'       => 'nav',
                                'container_class' => 'contact',
                                'theme_location'  => 'contact',
                            ]);
                        }
                    ?>
                </div>
                <div>
                    <h3 class="title-section">Horarios de atención</h3>
                    <p>L - D : 10:00 am a 7:00 pm</p>
                </div>
                <div>
                    <?php
                        $social_menu_id = $locations['social'] ?? null;
                        $social_menu = wp_get_nav_menu_object( $social_menu_id );
                        $social_items = wp_get_nav_menu_items( $social_menu_id );

                        if ( ! empty( $social_items ) ) {
                            echo '<h3 class="title-section">' . esc_html( $social_menu->name ) . '</h3>';
                            wp_nav_menu([
                                'container'       => 'nav',
                                'container_class' => 'social',
                                'theme_location'  => 'social',
                            ]);
                        }
                    ?>
                </div>
            </div>
            <div class="content middle-footer">
                <?php esc_html_e( 'Todas las imágenes, planos, medidas y áreas, son referenciales por lo que podrian sufrir cambios al momento de desarrollarse el proyecto, asimismo los elementos decorativos, acabados y mobiliarios son propuestas del departamento de diseño que no se incluyen en la oferta comercial y no comprometen a la empresa inmobiliaria.', 'inmobiliaria' ); ?>
            </div>
            <div class="content bottom-footer">
                <p>
                <?php esc_html_e( 'Derechos Reservados', 'inmobiliaria' ); ?>
                &copy; 
                <?php echo date('Y'); ?>
                • <?php bloginfo( 'name' ); ?> 
                </p>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>