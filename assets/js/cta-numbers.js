document.addEventListener("DOMContentLoaded", function () {
    const section = document.querySelector('#cta');
    const counters = section.querySelectorAll('#cta.block .content .numbers .number');
    let started = false; // Para evitar que se ejecute más de una vez

    const startCounting = () => {
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/,/g, ''), 10);
            let current = 0;
            const duration = 2000;
            const interval = 30;
            const steps = Math.ceil(duration / interval);
            const increment = target / steps;

            const update = () => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            };

            const timer = setInterval(update, interval);
        });
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !started) {
                started = true;
                startCounting();
                observer.unobserve(section); // Deja de observar después de la primera vez
            }
        });
    }, {
        threshold: 0.5 // Se activa cuando al menos el 50% del elemento es visible
    });

    if (section) {
        observer.observe(section);
    }
});