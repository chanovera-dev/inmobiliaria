document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.property-filter-form');
    const results = document.querySelector('.site-main .block.properties--wrapper .content.properties .properties--list');

    if (!form || !results) return;

    // Función para enviar AJAX y actualizar resultados
    const fetchProperties = (paged = 1) => {
        const data = new FormData(form);
        data.append('action', 'filter_properties');
        data.append('paged', paged);

        fetch(ajaxurlObj.ajax_url, {
            method: 'POST',
            body: data
        })
        .then(res => res.text())
        .then(html => {
            results.innerHTML = html;

            // Scroll suave al top del contenedor de resultados
            results.scrollIntoView({ behavior: 'smooth', block: 'start' });

            // Actualizar URL en la barra del navegador
            const url = new URL(window.location);
            if (paged > 1) {
                url.searchParams.set('paged', paged);
            } else {
                url.searchParams.delete('paged');
            }
            window.history.pushState({}, '', url);
        });
    };

    // Envío del formulario
    form.addEventListener('submit', e => {
        e.preventDefault();
        fetchProperties();
    });

    // Delegación de eventos para paginación
    document.addEventListener('click', e => {
        const link = e.target.closest('.pagination a');
        if (!link) return;
        e.preventDefault();

        const page = new URL(link.href).searchParams.get('paged') || 1;
        fetchProperties(page);
    });

    // Manejo del back/forward del navegador
    window.addEventListener('popstate', () => {
        const page = new URL(window.location).searchParams.get('paged') || 1;
        fetchProperties(page);
    });
});