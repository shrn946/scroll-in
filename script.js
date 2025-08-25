gsap.registerPlugin(SplitText, ScrollTrigger);

document.fonts.ready.then(() => {
  const opts = (typeof siOptions !== "undefined") ? siOptions : {};

  function animateSplit(selector, settings) {
    document.querySelectorAll(selector).forEach(el => {
      let split = new SplitText(el, { type: "chars" });

      gsap.from(split.chars, {
        ...settings,
        duration: opts.speed || 1,
        stagger: opts.stagger || 0.04,
        delay: opts.delay || 0,
        scrollTrigger: {
          trigger: el,
          start: opts.start || "top 85%",
          end: "top center",
          scrub: true,
          toggleActions: (opts.once == 1) ? "play none none none" : "play none none reset"
        }
      });
    });
  }

  // ? Only one class now
  animateSplit(".scroll-in", {
    opacity: 0,
    y: 20,
    ease: "power2.out"
  });
});
