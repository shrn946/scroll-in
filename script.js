gsap.registerPlugin(SplitText, ScrollTrigger);

document.fonts.ready.then(() => {
  function animateSplit(selector) {
    document.querySelectorAll(selector).forEach(el => {
      let split = new SplitText(el, { type: "chars" });

      gsap.from(split.chars, {
        opacity: 0,          // fade from invisible
        y: 20,               // subtle upward movement
        scale: 0.9,          // slight zoom in
        duration: 1,         // duration of animation
        stagger: 0.08,       // per-character delay for prominence
        ease: "power2.out",  // smooth easing
        scrollTrigger: {
          trigger: el,
          start: "top 85%",
          end: "top 20%",
          scrub: true,        // scroll-synced
          toggleActions: "play none none reset"
        }
      });
    });
  }

  // Simple fade-in with subtle flair
  animateSplit(".scroll-in");
});
