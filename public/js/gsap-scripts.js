document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);
  
    const animationSettings = [
      { class: "text-reveal", animation: el => gsap.to(el, {
        clipPath: "polygon(0 0, 100% 0, 100% 100%, 0 100%)",
        y: 0, 
        opacity: 1,
        duration: 1.2,
        delay: getDelay(el),
        scrollTrigger: getTrigger(el)
      })},
      { class: "fade-left", animation: el => gsap.to(el, {
        x: 0, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })},
      { class: "fade-right", animation: el => gsap.to(el, {
        x: 0, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })},
      { class: "fade-in", animation: el => gsap.to(el, {
        y: 0, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })},
      { class: "fade-out", animation: el => gsap.to(el, {
        y: 0, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })},
      { class: "scale-in", animation: el => gsap.to(el, {
        scale: 1, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })},
      { class: "rotate-in", animation: el => gsap.to(el, {
        rotate: 0, opacity: 1, duration: 1.2, delay: getDelay(el), scrollTrigger: getTrigger(el)
      })}
    ];
  
    animationSettings.forEach(({ class: cls, animation }) => {
      const elements = document.querySelectorAll(`.${cls}`);
      if (elements.length) {
        elements.forEach(el => animation(el));
      }
    });
  
    // Batch animation
    const batchElems = document.querySelectorAll(".fade-batch");
    if (batchElems.length) {
      gsap.set(batchElems, { y: 100 });
      ScrollTrigger.batch(batchElems, {
        interval: 0.3,
        batchMax: 4,
        onEnter: batch => gsap.to(batch, {
          opacity: 1,
          y: 0,
          stagger: { each: 0.15, grid: [1, 4] },
          overwrite: true
        }),
        start: "20px bottom",
        end: "bottom top"
      });
  
      ScrollTrigger.addEventListener("refreshInit", () => gsap.set(batchElems, { y: 0 }));
    }
  
    // Helpers
    function getDelay(el) {
      return parseFloat(el.dataset.delay || 0);
    }
  
    function getTrigger(el) {
      return {
        trigger: el,
        start: el.dataset.start || "top 85%",
        toggleActions: "play none none reverse"
      };
    }
  });
  