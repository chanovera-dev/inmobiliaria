document.addEventListener("DOMContentLoaded", function () {

    function initCounter(sectionSelector, countersSelector) {
        const section = document.querySelector(sectionSelector);
        if (!section) return;

        const counters = section.querySelectorAll(countersSelector);
        let started = false;

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
                    observer.unobserve(section);
                }
            });
        }, {
            threshold: 0.5
        });

        observer.observe(section);
    }
    initCounter('#cta', '#cta.block .content .numbers .number');
    initCounter('#about-us', '#about-us.block > .content > div .number');
});