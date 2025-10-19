document.addEventListener('click', e => {
    if (e.target.classList.contains('thumb')) {
        const main = document.querySelector('.property-gallery--main img');
        main.src = e.target.src;
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        e.target.classList.add('active');
    }
});