const layers = document.querySelectorAll('.background-parallax');
    const visibleLayers = new Set();

    const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
        visibleLayers.add(entry.target);
        } else {
        visibleLayers.delete(entry.target);
        }
    });
    }, { threshold: 0 });

  layers.forEach(layer => observer.observe(layer));

  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
        const scrollY = window.scrollY;
        visibleLayers.forEach(layer => {
            const speed = parseFloat(layer.getAttribute('data-speed'));
            const offsetTop = layer.parentElement.offsetTop;
            const distance = scrollY - offsetTop;
            layer.style.transform = `translateY(${distance * speed}px)`;
        });
        ticking = false;
        });
        ticking = true;
    }
});