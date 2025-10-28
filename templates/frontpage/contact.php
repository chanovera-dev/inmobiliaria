<section id="contact" class="block">
    <img class="background-parallax" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/panoramica-monterrey.webp" width="1920" height="1080" alt="" loading="lazy" data-speed= "0.25">
    <div class="content">
        <div class="contact-data">
            <div class="contact-form-wrapper glass-bright glass-backdrop">
                <div class="glass-reflex"></div>
                <h2 class="title-section">¿Cómo podemos ayudarte?</h2>
                <h3 class="subtitle-section">¿Buscas ayuda? Platica con nuestro equipo</h3>
                <?php echo do_shortcode( '[contact-form-7 id="bfb4d80" title="Formulario de contacto 1"]' ); ?>
            </div>
            <div class="contact--list">
                <div class="chat">
                    <h3>Chatea con nosotros</h3>
                    <span>Habla en tiempo real con nuestro amigable equipo.</span>
                    <?php
                        if ( has_nav_menu( 'contact-chat' ) ) {
                            wp_nav_menu( array(
                                'container_class' => 'contact-chat',
                                'theme_location'  => 'contact-chat',
                            ) );
                        }
                    ?>
                </div>
                <div class="call">
                    <h3>Llámanos</h3>
                    <span>Llama a nuestro equipo L - D 10:00 am a 7:00 pm</span>
                    <?php
                        if ( has_nav_menu( 'contact-call' ) ) {
                            wp_nav_menu( array(
                                'container_class' => 'contact-call',
                                'theme_location'  => 'contact-call',
                            ) );
                        }
                    ?>
                </div>
                <div class="visit-us">
                    <h3>Visítanos</h3>
                    <span>Habla con nosotros en persona en nuestro sede de Monterrey, NL</span>
                    <?php
                        if ( has_nav_menu( 'contact-address' ) ) {
                            wp_nav_menu( array(
                                'container_class' => 'contact-address',
                                'theme_location'  => 'contact-address',
                            ) );
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>