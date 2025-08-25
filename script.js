gsap.registerPlugin(SplitText, ScrollTrigger);

document.fonts.ready.then(() => {
  function animateSplit(selector) {
    document.querySelectorAll(selector).forEach(el => {
      let split = new SplitText(el, { type: "chars" });

      gsap.from(split.chars, {
        opacity: 0,                    // fade from invisible
        x: () => gsap.utils.random(-5, 5), // subtle horizontal motion
        scale: 0.9,                    // slight zoom-in
        duration: 1,
        stagger: 0.08,
        ease: "power2.out",
        scrollTrigger: {
          trigger: el,
          start: "top 85%",
          end: "top 20%",
          scrub: true,
          toggleActions: "play none none reset"
        }
      });
    });
  }

  // Fade-in with subtle horizontal motion
  animateSplit(".scroll-in");
});
