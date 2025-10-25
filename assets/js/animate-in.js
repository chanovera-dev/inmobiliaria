document.addEventListener('DOMContentLoaded', function () {
  const targets = document.querySelectorAll('.background-cta, .happy-family-on-home');

  if (!targets.length) return;

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting && entry.intersectionRatio >= 0.1) {
          setTimeout(() => {
            entry.target.classList.add('animate-in');
            observer.unobserve(entry.target);
          }, index * 500); // Escalonar con un retraso de 0.5s por elemento
        }
      });
    },
    {
      threshold: 0.1,
    }
  );

  targets.forEach(target => observer.observe(target));
});