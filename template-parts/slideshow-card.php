<article class="propiedad-card">
    <a href="<?php the_permalink(); ?>">
        <div class="block">
            <?php
                echo get_the_post_thumbnail( null, 'full', [ 'class' => 'thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy', 'data-speed' => '0.25' ] );
            ?>
            <div class="content">
                <div class="details">
                    <p>
                        <?php
                            $bedrooms     = get_post_meta( get_the_ID(), 'eb_bedrooms', true );
                            $bathrooms    = get_post_meta( get_the_ID(), 'eb_bathrooms', true );
                            $parking      = get_post_meta( get_the_ID(), 'eb_parking', true );
                            $construction = get_post_meta( get_the_ID(), 'eb_construction', true );
                            $lot          = get_post_meta( get_the_ID(), 'eb_lot', true );
                            $type         = get_post_meta( get_the_ID(), 'eb_property_type', true );

                            if (!empty($bedrooms) && $bedrooms != 0) {
                                echo '<span class="bedroom"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" fill="currentColor" width="19px" height="19px" viewBox="0 0 512 512"><path d="M384 240H96V136a40.12 40.12 0 0140-40h240a40.12 40.12 0 0140 40v104zM48 416V304a64.19 64.19 0 0164-64h288a64.19 64.19 0 0164 64v112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M48 416v-8a24.07 24.07 0 0124-24h368a24.07 24.07 0 0124 24v8M112 240v-16a32.09 32.09 0 0132-32h80a32.09 32.09 0 0132 32v16M256 240v-16a32.09 32.09 0 0132-32h80a32.09 32.09 0 0132 32v16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/></svg>';
                                echo $bedrooms;
                                echo ( $bedrooms < 2 ) ? ' recámara' : ' recámaras';
                                echo '</span>';
                            }
                            if (!empty($bathrooms) && $bathrooms != 0) {
                                echo '<span><svg fill="currentColor" width="16" height="16" viewBox="0 0 512 512" id="Layer_1" enable-background="new 0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m496 288c-38.154 0-437.487 0-448 0v-56h32c8.837 0 16-7.164 16-16v-40c0-8.836-7.163-16-16-16s-16 7.164-16 16v24h-16v-138.745c0-25.903 31.562-39.064 49.941-20.686l16.94 16.94c-13.424 23.401-10.164 53.835 9.805 73.805l8 8c6.247 6.248 16.379 6.249 22.627 0l64-64c6.249-6.248 6.249-16.379 0-22.627l-8-8c-20.35-20.351-50.837-23.06-73.817-9.817l-16.928-16.928c-11.57-11.57-26.952-17.942-43.313-17.942-33.776 0-61.255 27.479-61.255 61.255v226.745c-8.837 0-16 7.164-16 16s7.163 16 16 16v32c0 43.889 19.742 83.247 50.806 109.681l-22.338 23.229c-9.803 10.193-2.445 27.09 11.53 27.09 4.199 0 8.394-1.644 11.534-4.91l26.218-27.263c19.844 10.326 42.376 16.173 66.25 16.173h192c23.874 0 46.406-5.847 66.25-16.173l26.218 27.263c6.106 6.35 16.234 6.585 22.623.442 6.369-6.125 6.566-16.254.441-22.623l-22.338-23.229c31.064-26.433 50.806-65.791 50.806-109.68v-32c8.837 0 16-7.164 16-16s-7.163-16-16-16zm-310.89-223.738-40.845 40.845c-8.246-11.427-7.23-27.515 3.048-37.794 10.378-10.377 26.461-11.259 37.797-3.051zm278.89 287.738c0 61.757-50.243 112-112 112h-192c-61.757 0-112-50.243-112-112v-32h416z"/></g></svg>';
                                echo $bathrooms;
                                echo ( $bathrooms < 2 ) ? ' baño' : ' baños';
                                echo '</span>';
                            }
                            if (!empty($parking) && $parking != 0) {
                                echo '<span class="parking"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" fill="currentColor" width="21" height="21" viewBox="0 0 512 512"><path d="M469.71 234.6c-7.33-9.73-34.56-16.43-46.08-33.94s-20.95-55.43-50.27-70S288 112 256 112s-88 4-117.36 18.63-38.75 52.52-50.27 70-38.75 24.24-46.08 33.97S29.8 305.84 32.94 336s9 48 9 48h86c14.08 0 18.66-5.29 47.46-8 31.6-3 62.6-4 80.6-4s50 1 81.58 4c28.8 2.73 33.53 8 47.46 8h85s5.86-17.84 9-48-2.04-91.67-9.33-101.4zM400 384h56v16h-56zM56 384h56v16H56z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"/><path d="M364.47 309.16c-5.91-6.83-25.17-12.53-50.67-16.35S279 288 256.2 288s-33.17 1.64-57.61 4.81-42.79 8.81-50.66 16.35C136.12 320.6 153.42 333.44 167 335c13.16 1.5 39.47.95 89.31.95s76.15.55 89.31-.95c13.56-1.65 29.62-13.6 18.85-25.84zM431.57 243.05a3.23 3.23 0 00-3.1-3c-11.81-.42-23.8.42-45.07 6.69a93.88 93.88 0 00-30.08 15.06c-2.28 1.78-1.47 6.59 1.39 7.1a455.32 455.32 0 0052.82 3.1c10.59 0 21.52-3 23.55-12.44a52.41 52.41 0 00.49-16.51zM80.43 243.05a3.23 3.23 0 013.1-3c11.81-.42 23.8.42 45.07 6.69a93.88 93.88 0 0130.08 15.06c2.28 1.78 1.47 6.59-1.39 7.1a455.32 455.32 0 01-52.82 3.1c-10.59 0-21.52-3-23.55-12.44a52.41 52.41 0 01-.49-16.51z"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20" d="M432 192h16M64 192h16M78 211s46.35-12 178-12 178 12 178 12"/></svg>';
                                echo $parking; 
                                echo ( $parking < 2 ) ? ' estacionamiento' : ' estacionamientos';
                                echo '</span>';
                            }
                            if (!empty($construction) && $construction != 0) {
                                echo '<li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16"><path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022M6 8.694 1 10.36V15h5zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5z"/><path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1zM8 7h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zM8 5h1v1H8zm2 0h1v1h-1zm2 0h1v1h-1zm0-2h1v1h-1z"/></svg>';
                                echo format_numeric($construction); 
                                echo " m² de construcción</li>";
                            }
                            if (!empty($lot) && $lot != 0) {
                                echo '<li class="lot"><svg fill="currentColor" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10,14 L19.5,14 C20.8807119,14 22,15.1192881 22,16.5 L22,19.5 C22,20.8807119 20.8807119,22 19.5,22 L4.5,22 C3.11928813,22 2,20.8807119 2,19.5 L2,4.5 C2,3.11928813 3.11928813,2 4.5,2 L7.5,2 C8.88071187,2 10,3.11928813 10,4.5 L10,14 Z M8.91464715,20 L5.5,20 C5.22385763,20 5,19.7761424 5,19.5 C5,19.2238576 5.22385763,19 5.5,19 L9,19 L9,17 L6.5,17 C6.22385763,17 6,16.7761424 6,16.5 C6,16.2238576 6.22385763,16 6.5,16 L9,16 L9,14 L5.5,14 C5.22385763,14 5,13.7761424 5,13.5 C5,13.2238576 5.22385763,13 5.5,13 L9,13 L9,11 L6.5,11 C6.22385763,11 6,10.7761424 6,10.5 C6,10.2238576 6.22385763,10 6.5,10 L9,10 L9,8 L5.5,8 C5.22385763,8 5,7.77614237 5,7.5 C5,7.22385763 5.22385763,7 5.5,7 L9,7 L9,5 L6.5,5 C6.22385763,5 6,4.77614237 6,4.5 C6,4.22385763 6.22385763,4 6.5,4 L8.91464715,4 C8.70872894,3.41740381 8.15310941,3 7.5,3 L4.5,3 C3.67157288,3 3,3.67157288 3,4.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 L7.5,21 C8.15310941,21 8.70872894,20.5825962 8.91464715,20 Z M10,15 L10,19.5 C10,20.062803 9.81402759,20.5821697 9.50018309,21 L19.5,21 C20.3284271,21 21,20.3284271 21,19.5 L21,16.5 C21,15.6715729 20.3284271,15 19.5,15 L10,15 Z M17,16 L19,16 C19.5522847,16 20,16.4477153 20,17 L20,19 C20,19.5522847 19.5522847,20 19,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,17 C16,16.4477153 16.4477153,16 17,16 Z M17,17 L17,19 L19,19 L19,17 L17,17 Z"/></svg>';
                                echo format_numeric($lot); 
                                echo ' m² de terreno</li>';
                            }
                        ?>
                        <span class="type">
                            <?php
                                echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.5391 8.67606V15.5524C20.5512 15.8014 20.4327 16.0559 20.1845 16.196L13.0531 20.2197C12.4152 20.5797 11.6357 20.5807 10.9969 20.2223L3.82016 16.1968C3.5659 16.0542 3.44711 15.7917 3.46487 15.5374V8.69449C3.44687 8.44374 3.56156 8.18452 3.80996 8.0397L10.9664 3.86752C11.6207 3.48606 12.4299 3.4871 13.0832 3.87025L20.1945 8.04063C20.4357 8.18211 20.5503 8.43167 20.5391 8.67606Z" stroke="currentColor"/><path d="M3.82019 9.25312C3.3487 8.98865 3.34307 8.31197 3.81009 8.03969L10.9665 3.86751C11.6209 3.48605 12.43 3.48709 13.0834 3.87024L20.1946 8.04062C20.6596 8.31329 20.6539 8.98739 20.1845 9.25227L13.0531 13.276C12.4152 13.636 11.6357 13.637 10.9969 13.2786L3.82019 9.25312Z" stroke="currentColor"/></svg>Tipo: ';
                                echo $type;
                            ?>
                        </span>
                    </p>
                </div>
                <div class="title-wrapper">
                    <h2 class="title-card">
                        <?php the_title(); ?>
                    </h2>
                </div>
                <div class="excerpt-wrapper">
                    <?php the_excerpt(); ?>
                </div>

                <div class="price-wrapper">
                    <div class="price">
                        <?php echo get_post_meta(get_the_ID(), 'eb_price', true) ?: 0; ?>
                    </div>
                </div>
            </div>
            <div class="time-mark"></div>
        </div>
    </a>
</article>