<?php
/**
 * Index Template - Functional Component Playground
 *
 * This file is used to preview components like hero, typography,
 * forms, cards, tabs, accordion and layout examples with
 *
 * @package inmobiliaria
 * @since 1.0.0
 */

get_header(); ?>
<main id="main" class="site-main" role="main">

    <!-- Description Section -->
    <section class="block description">
        <div class="content">
            <h2><?php esc_html_e( 'Theme Component Playground - Index Page', 'inmobiliaria' ); ?></h2>
            <p>
                <?php 
                /* translators: Description of the component playground on the index page. */
                esc_html_e( 'Welcome to the Inmobiliaria theme playground! This page showcases all the components, layouts, forms, buttons, cards, tabs, accordions, sliders, and other elements available in the theme. Use this page to preview styles, interactivity, and layout before adding real content.', 'inmobiliaria' ); 
                ?>
            </p>
            <p>
                <?php 
                /* translators: Additional info encouraging users to explore theme components. */
                esc_html_e( 'You can experiment with different sections, test forms, view property cards, try tabs and accordions, and see how sliders and pricing tables appear. Everything here is designed to give a full overview of your website’s UI.', 'inmobiliaria' ); 
                ?>
            </p>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="block hero">
        <div class="content">
            <h1 class="title-page"><?php esc_html_e( 'Welcome to Inmobiliaria Theme', 'inmobiliaria' ); ?></h1>
            <p class="subtitle"><?php esc_html_e( 'Interactive component playground with real functionality.', 'inmobiliaria' ); ?></p>
            <a href="#" class="button"><?php esc_html_e( 'Call to Action', 'inmobiliaria' ); ?></a>
        </div>
    </section>

    <!-- Typography Section -->
    <section class="block typography">
        <div class="content">
            <h2><?php esc_html_e( 'Typography', 'inmobiliaria' ); ?></h2>
            <p><?php esc_html_e( 'Normal paragraph text example.', 'inmobiliaria' ); ?></p>
            <?php
                /* translators: Example of bold and italic text with HTML tags. */
                echo wp_kses_post( __( '<p><strong>Bold text</strong> and <em>italic text</em>.</p>', 'inmobiliaria' ) );
            ?>
            <h3><?php esc_html_e( 'Heading 3', 'inmobiliaria' ); ?></h3>
            <h4><?php esc_html_e( 'Heading 4', 'inmobiliaria' ); ?></h4>
            <blockquote><?php esc_html_e( 'Example blockquote for testing.', 'inmobiliaria' ); ?></blockquote>
            <ul>
                <li><?php esc_html_e( 'Unordered item 1', 'inmobiliaria' ); ?></li>
                <li><?php esc_html_e( 'Unordered item 2', 'inmobiliaria' ); ?></li>
            </ul>
            <ol>
                <li><?php esc_html_e( 'Ordered item 1', 'inmobiliaria' ); ?></li>
                <li><?php esc_html_e( 'Ordered item 2', 'inmobiliaria' ); ?></li>
            </ol>
        </div>
    </section>

    <!-- Buttons Section -->
    <section class="block buttons">
        <div class="content">
            <h2><?php esc_html_e( 'Buttons', 'inmobiliaria' ); ?></h2>
            <a href="#" class="btn primary"><?php esc_html_e( 'Primary', 'inmobiliaria' ); ?></a>
            <a href="#" class="btn secondary"><?php esc_html_e( 'Secondary', 'inmobiliaria' ); ?></a>
            <a href="#" class="btn outline"><?php esc_html_e( 'Outline', 'inmobiliaria' ); ?></a>
            <a href="#" class="btn without-line"><?php esc_html_e( 'Without line', 'inmobiliaria' ); ?></a>
            <a href="#" class="btn disable"><?php esc_html_e( 'Disable', 'inmobiliaria' ); ?></a>
        </div>
    </section>

    <!-- Form Section -->
    <section class="block forms">
        <div class="section">
            <h2><?php esc_html_e( 'Form Example', 'inmobiliaria' ); ?></h2>
            <form class="form-example">
                <label for="name"><?php esc_html_e( 'Name', 'inmobiliaria' ); ?></label>
                <input type="text" id="name" placeholder="<?php esc_attr_e( 'Enter your name', 'inmobiliaria' ); ?>">

                <label for="email"><?php esc_html_e( 'Email', 'inmobiliaria' ); ?></label>
                <input type="email" id="email" placeholder="<?php esc_attr_e( 'Enter your email', 'inmobiliaria' ); ?>">

                <label for="message"><?php esc_html_e( 'Message', 'inmobiliaria' ); ?></label>
                <textarea id="message" placeholder="<?php esc_attr_e( 'Your message', 'inmobiliaria' ); ?>"></textarea>

                <label for="type"><?php esc_html_e( 'Property Type', 'inmobiliaria' ); ?></label>
                <select id="type">
                    <option><?php esc_html_e( 'House', 'inmobiliaria' ); ?></option>
                    <option><?php esc_html_e( 'Apartment', 'inmobiliaria' ); ?></option>
                    <option><?php esc_html_e( 'Land', 'inmobiliaria' ); ?></option>
                </select>

                <label>
                    <input type="checkbox"> <?php esc_html_e( 'Subscribe to newsletter', 'inmobiliaria' ); ?>
                </label>

                <button type="submit"><?php esc_html_e( 'Submit', 'inmobiliaria' ); ?></button>
            </form>
        </div>
    </section>

    <!-- Tabs Section -->
    <section class="block tabs">
        <div class="content">
            <h2><?php esc_html_e( 'Tabs', 'inmobiliaria' ); ?></h2>
            <ul class="tab-buttons">
                <li class="active" data-tab="tab1"><?php esc_html_e( 'Tab 1', 'inmobiliaria' ); ?></li>
                <li data-tab="tab2"><?php esc_html_e( 'Tab 2', 'inmobiliaria' ); ?></li>
                <li data-tab="tab3"><?php esc_html_e( 'Tab 3', 'inmobiliaria' ); ?></li>
            </ul>
            <div id="tab1" class="tab-content active"><?php echo wp_kses_post( __( '<p>Content for Tab 1</p>', 'inmobiliaria' ) ); ?></div>
            <div id="tab2" class="tab-content"><?php echo wp_kses_post( __( '<p>Content for Tab 2</p>', 'inmobiliaria' ) ); ?></div>
            <div id="tab3" class="tab-content"><?php echo wp_kses_post( __( '<p>Content for Tab 3</p>', 'inmobiliaria' ) ); ?></div>
        </div>
    </section>

    <!-- Accordion Section -->
    <section class="block accordion">
        <div class="content">
            <h2><?php esc_html_e( 'Accordion', 'inmobiliaria' ); ?></h2>
            <div class="accordion-item">
                <button class="accordion-header"><?php esc_html_e( 'Accordion 1', 'inmobiliaria' ); ?></button>
                <div class="accordion-body"><?php echo wp_kses_post( __( '<p>Content for Accordion 1</p>', 'inmobiliaria' ) ); ?></div>
            </div>
            <div class="accordion-item">
                <button class="accordion-header"><?php esc_html_e( 'Accordion 2', 'inmobiliaria' ); ?></button>
                <div class="accordion-body"><?php echo wp_kses_post( __( '<p>Content for Accordion 2</p>', 'inmobiliaria' ) ); ?></div>
            </div>
        </div>
    </section>

</main><!-- .site-main -->
<?php get_footer(); ?>