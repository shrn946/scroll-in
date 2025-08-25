gsap.registerPlugin(SplitText, ScrollTrigger);

document.fonts.ready.then(() => {
  function animateSplit(selector) {
    document.querySelectorAll(selector).forEach(el => {
      let split = new SplitText(el, { type: "chars" });

      gsap.from(split.chars, {
        opacity: 0,        // fade from invisible
        duration: 1,       // duration of fade
        stagger: 0.05,     // stagger per character
        scrollTrigger: {
          trigger: el,
          start: "top 85%",
          end: "top 20%",
          scrub: true,      // scroll-synced
          toggleActions: "play none none reset"
        }
      });
    });
  }

  // Simple fade-in reveal
  animateSplit(".scroll-in");
});
