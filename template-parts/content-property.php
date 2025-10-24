<article class="post">
    <header class="post--header glass-bright">
        <?php echo get_the_post_thumbnail( null, 'post-header-thumbnail', [ 'class' => 'post-thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy' ] ); ?>
        <div class="glass-reflex"></div>
        <div class="tags">
            <?php
                $type = get_post_meta(get_the_ID(), 'eb_property_type', true) ?: 'Sin tipo';
                echo '<span class="tag-type small-text glass-backdrop glass-bright"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.5391 8.67606V15.5524C20.5512 15.8014 20.4327 16.0559 20.1845 16.196L13.0531 20.2197C12.4152 20.5797 11.6357 20.5807 10.9969 20.2223L3.82016 16.1968C3.5659 16.0542 3.44711 15.7917 3.46487 15.5374V8.69449C3.44687 8.44374 3.56156 8.18452 3.80996 8.0397L10.9664 3.86752C11.6207 3.48606 12.4299 3.4871 13.0832 3.87025L20.1945 8.04063C20.4357 8.18211 20.5503 8.43167 20.5391 8.67606Z" stroke="currentColor"/><path d="M3.82019 9.25312C3.3487 8.98865 3.34307 8.31197 3.81009 8.03969L10.9665 3.86751C11.6209 3.48605 12.43 3.48709 13.0834 3.87024L20.1946 8.04062C20.6596 8.31329 20.6539 8.98739 20.1845 9.25227L13.0531 13.276C12.4152 13.636 11.6357 13.637 10.9969 13.2786L3.82019 9.25312Z" stroke="currentColor"/></svg>Tipo: ';
                echo $type;
                echo '</span>';

                $operation = get_post_meta( get_the_ID(), 'eb_operation', true );
                echo '<span class="tag-type small-text glass-backdrop glass-bright"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>';
                echo $operation === 'sale' ? 'En venta' : ( $operation === 'rental' ? 'En renta' : '' );
                echo '</span>';
            ?>
        </div>
    </header>
    <div class="post--body">
        <div class="post--body__header">
            <a href="<?php the_permalink();?>" class="post--permalink">
                <?php the_title('<h3 class="post--title">', '</h3>'); ?>
            </a>
            <?php $location = get_post_meta( get_the_ID(), 'eb_location', true ); ?>
            <p class="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <?php echo $location; ?>
            </p>
        </div>
        <div class="post--metadata">
            <ul class="rooms">
                <?php
                    $bedrooms = get_post_meta(get_the_ID(), 'eb_bedrooms', true);
                    if (!empty($bedrooms) && $bedrooms != 0) {
                        echo '<li class="bedroom"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" fill="currentColor" width="19px" height="19px" viewBox="0 0 512 512"><path d="M384 240H96V136a40.12 40.12 0 0140-40h240a40.12 40.12 0 0140 40v104zM48 416V304a64.19 64.19 0 0164-64h288a64.19 64.19 0 0164 64v112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M48 416v-8a24.07 24.07 0 0124-24h368a24.07 24.07 0 0124 24v8M112 240v-16a32.09 32.09 0 0132-32h80a32.09 32.09 0 0132 32v16M256 240v-16a32.09 32.09 0 0132-32h80a32.09 32.09 0 0132 32v16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/></svg>';
                        echo $bedrooms;
                        echo '</li>';
                    }

                    $bathrooms = get_post_meta(get_the_ID(), 'eb_bathrooms', true);
                    if (!empty($bathrooms) && $bathrooms != 0) {
                        echo '<li><svg fill="currentColor" width="16" height="16" viewBox="0 0 512 512" id="Layer_1" enable-background="new 0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m496 288c-38.154 0-437.487 0-448 0v-56h32c8.837 0 16-7.164 16-16v-40c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-16v-138.745c0-25.903 31.562-39.064 49.941-20.686l16.94 16.94c-13.424 23.401-10.164 53.835 9.805 73.805l8 8c6.247 6.248 16.379 6.249 22.627 0l64-64c6.249-6.248 6.249-16.379 0-22.627l-8-8c-20.35-20.351-50.837-23.06-73.817-9.817l-16.928-16.928c-11.57-11.57-26.952-17.942-43.313-17.942-33.776 0-61.255 27.479-61.255 61.255v226.745c-8.837 0-16 7.164-16 16s7.163 16 16 16v32c0 43.889 19.742 83.247 50.806 109.681l-22.338 23.229c-9.803 10.193-2.445 27.09 11.53 27.09 4.199 0 8.394-1.644 11.534-4.91l26.218-27.263c19.844 10.326 42.376 16.173 66.25 16.173h192c23.874 0 46.406-5.847 66.25-16.173l26.218 27.263c6.106 6.35 16.234 6.585 22.623.442 6.369-6.125 6.566-16.254.441-22.623l-22.338-23.229c31.064-26.433 50.806-65.791 50.806-109.68v-32c8.837 0 16-7.164 16-16s-7.163-16-16-16zm-310.89-223.738-40.845 40.845c-8.246-11.427-7.23-27.515 3.048-37.794 10.378-10.377 26.461-11.259 37.797-3.051zm278.89 287.738c0 61.757-50.243 112-112 112h-192c-61.757 0-112-50.243-112-112v-32h416z"/></g></svg>';
                        echo $bathrooms;
                        echo '</li>';
                    }
                ?>
            </ul>
            <ul class="sizes">
                <?php
                    $construction = get_post_meta(get_the_ID(), 'eb_construction_size', true);
                    if (!empty($construction) && $construction != 0) {
                        echo '<li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16"><path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/><path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/></svg>';
                        echo format_numeric($construction); 
                        echo " m²</li>";
                    }

                    $lot = get_post_meta(get_the_ID(), 'eb_lot_size', true);
                    if (!empty($lot) && $lot != 0) {
                        echo '<li class="lot"><svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,14 L19.5,14 C20.8807119,14 22,15.1192881 22,16.5 L22,19.5 C22,20.8807119 20.8807119,22 19.5,22 L4.5,22 C3.11928813,22 2,20.8807119 2,19.5 L2,4.5 C2,3.11928813 3.11928813,2 4.5,2 L7.5,2 C8.88071187,2 10,3.11928813 10,4.5 L10,14 Z M8.91464715,20 L5.5,20 C5.22385763,20 5,19.7761424 5,19.5 C5,19.2238576 5.22385763,19 5.5,19 L9,19 L9,17 L6.5,17 C6.22385763,17 6,16.7761424 6,16.5 C6,16.2238576 6.22385763,16 6.5,16 L9,16 L9,14 L5.5,14 C5.22385763,14 5,13.7761424 5,13.5 C5,13.2238576 5.22385763,13 5.5,13 L9,13 L9,11 L6.5,11 C6.22385763,11 6,10.7761424 6,10.5 C6,10.2238576 6.22385763,10 6.5,10 L9,10 L9,8 L5.5,8 C5.22385763,8 5,7.77614237 5,7.5 C5,7.22385763 5.22385763,7 5.5,7 L9,7 L9,5 L6.5,5 C6.22385763,5 6,4.77614237 6,4.5 C6,4.22385763 6.22385763,4 6.5,4 L8.91464715,4 C8.70872894,3.41740381 8.15310941,3 7.5,3 L4.5,3 C3.67157288,3 3,3.67157288 3,4.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 L7.5,21 C8.15310941,21 8.70872894,20.5825962 8.91464715,20 Z M10,15 L10,19.5 C10,20.062803 9.81402759,20.5821697 9.50018309,21 L19.5,21 C20.3284271,21 21,20.3284271 21,19.5 L21,16.5 C21,15.6715729 20.3284271,15 19.5,15 L10,15 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z M17,17 L17,19 L19,19 L19,17 L17,17 Z"/></svg>';
                        echo format_numeric($lot); 
                        echo ' m²</li>';
                    }
                    $parking = get_post_meta(get_the_ID(), 'eb_parking_spaces', true);
                    if (!empty($parking) && $parking != 0) {
                        echo "<li>🚗 {$parking}</li>";
                    }
                ?>
            </ul>
            <?php $price = get_post_meta( get_the_ID(), 'eb_price', true ); ?>
            <div class="price"><span>Precio</span><h3><?php echo $price; ?></h3></div>
        </div>
    </div>
</article>