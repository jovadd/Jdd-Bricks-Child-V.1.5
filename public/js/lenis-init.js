// Check if GSAP and ScrollTrigger are available
if (typeof gsap !== "undefined" && typeof ScrollTrigger !== "undefined") {

    // Initialize Lenis
    const lenis = new Lenis({
        duration: 1.2,
        smooth: true,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
    });
  
    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
  
    requestAnimationFrame(raf);
  
    // Sync Lenis with ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update);
  
    // ScrollTo with Lenis
    window.lenisScrollTo = (target) => {
        lenis.scrollTo(target, {
            offset: 0,
            duration: 1.5,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        });
    };
  
  } else {
    console.warn('GSAP or ScrollTrigger are not loaded. Lenis will not be initialized.');
  }