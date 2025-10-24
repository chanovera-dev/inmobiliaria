<article class="property">
    <header class="property--header glass-bright">
        <?php echo get_the_post_thumbnail( null, 'property-header-thumbnail', [ 'class' => 'property-thumbnail', 'alt'   => get_the_title(), 'loading' => 'lazy' ] ); ?>
        <div class="glass-reflex"></div>
        <?php
            $type = get_post_meta(get_the_ID(), 'eb_property_type', true) ?: 'Sin tipo';
            echo '<span class="btn btn-small type"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.5391 8.67606V15.5524C20.5512 15.8014 20.4327 16.0559 20.1845 16.196L13.0531 20.2197C12.4152 20.5797 11.6357 20.5807 10.9969 20.2223L3.82016 16.1968C3.5659 16.0542 3.44711 15.7917 3.46487 15.5374V8.69449C3.44687 8.44374 3.56156 8.18452 3.80996 8.0397L10.9664 3.86752C11.6207 3.48606 12.4299 3.4871 13.0832 3.87025L20.1945 8.04063C20.4357 8.18211 20.5503 8.43167 20.5391 8.67606Z" stroke="currentColor"/><path d="M3.82019 9.25312C3.3487 8.98865 3.34307 8.31197 3.81009 8.03969L10.9665 3.86751C11.6209 3.48605 12.43 3.48709 13.0834 3.87024L20.1946 8.04062C20.6596 8.31329 20.6539 8.98739 20.1845 9.25227L13.0531 13.276C12.4152 13.636 11.6357 13.637 10.9969 13.2786L3.82019 9.25312Z" stroke="currentColor"/></svg>Tipo: ';
            echo $type;
            echo '</span>';
        ?>
        <?php
            $operation = get_post_meta( get_the_ID(), 'eb_operation', true );
            echo '<span class="btn btn-small type"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg>';
            echo $operation === 'sale' ? 'En venta' : ( $operation === 'rental' ? 'En renta' : '' );
            echo '</span>';
        ?>
    </header>
</article>