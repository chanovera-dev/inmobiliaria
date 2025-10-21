document.addEventListener('DOMContentLoaded', () => {

    const mainImg = document.querySelector('.property-gallery--main img');
    const thumbsContainer = document.querySelector('.property-gallery--thumbs');
    const thumbs = Array.from(document.querySelectorAll('.thumb'));
    const btnPrev = document.querySelector('.thumbs-btn.prev');
    const btnNext = document.querySelector('.thumbs-btn.next');

    // Clonar los extremos para loop infinito
    const clonesBefore = thumbs.slice(-3).map(t => t.cloneNode(true));
    const clonesAfter = thumbs.slice(0, 3).map(t => t.cloneNode(true));
    clonesBefore.forEach(clone => thumbsContainer.prepend(clone));
    clonesAfter.forEach(clone => thumbsContainer.append(clone));

    let allThumbs = Array.from(thumbsContainer.querySelectorAll('img'));
    let index = 3; // posición inicial (primer imagen real)
    let visible = getVisibleCount(); // número dinámico de visibles

    // Función que calcula el número de visibles según ancho/orientación
    function getVisibleCount() {
        const isPortrait = window.matchMedia("(orientation: portrait)").matches;
        const width = window.innerWidth;

        if (width < 768) return 3; // móviles
        if (width >= 768 && width < 1024) {
            // tablet: depende de orientación
            return isPortrait ? 3 : 4;
        }
        return 4; // desktop
    }

    function updatePosition(animate = true) {
        thumbsContainer.style.transition = animate ? 'transform 0.4s ease' : 'none';
        const offset = -index * (thumbsContainer.clientWidth / visible);
        thumbsContainer.style.transform = `translateX(${offset}px)`;
    }

    function normalizeIndex() {
        if (index >= thumbs.length + 3) {
            index = 3;
            updatePosition(false);
        } else if (index < 3) {
            index = thumbs.length + 2;
            updatePosition(false);
        }
    }

    function moveNext() {
        index++;
        updatePosition();
        setTimeout(normalizeIndex, 450);
    }

    function movePrev() {
        index--;
        updatePosition();
        setTimeout(normalizeIndex, 450);
    }

    btnNext.addEventListener('click', moveNext);
    btnPrev.addEventListener('click', movePrev);

    // Cambiar imagen principal
    allThumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            mainImg.src = thumb.src;
            allThumbs.forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        });
    });

    // Arrastre con mouse
    let isDown = false;
    let startX, moveX;

    thumbsContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX;
        thumbsContainer.style.cursor = 'grabbing';
    });

    thumbsContainer.addEventListener('mouseup', (e) => {
        isDown = false;
        moveX = e.pageX - startX;
        thumbsContainer.style.cursor = 'grab';
        if (moveX < -50) moveNext();
        else if (moveX > 50) movePrev();
    });

    // Swipe táctil
    let touchStartX = 0;
    thumbsContainer.addEventListener('touchstart', e => touchStartX = e.touches[0].clientX);
    thumbsContainer.addEventListener('touchend', e => {
        const deltaX = e.changedTouches[0].clientX - touchStartX;
        if (deltaX < -50) moveNext();
        else if (deltaX > 50) movePrev();
    });

    // Detectar cambios de tamaño u orientación
    window.addEventListener('resize', handleResize);
    window.addEventListener('orientationchange', handleResize);

    function handleResize() {
        const newVisible = getVisibleCount();
        if (newVisible !== visible) {
            visible = newVisible;
            updatePosition(false);
        }
    }

    // Inicializar
    updatePosition(false);
});