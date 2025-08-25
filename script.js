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
        delay: opts.delay || 0,   // ✅ new option
        scrollTrigger: {
          trigger: el,
          start: opts.start || "top 85%",
          end: "top center",      // ✅ finish before end of scroll
          scrub: true,            // ✅ keep old style
          toggleActions: (opts.once == 1) ? "play none none none" : "play none none reset"
        }
      });
    });
  }

  // 🔹 Default styles
  animateSplit(".scroll-in-fade", {
    opacity: 0,
    y: 20,
    ease: "power2.out"
  });

  animateSplit(".scroll-in-slide", {
    opacity: 0,
    x: -50,
    ease: "back.out(1.7)"
  });

  animateSplit(".scroll-in-rotate", {
    opacity: 0,
    rotationX: 90,
    rotationY: 45,
    transformOrigin: "50% 50% -30px",
    ease: "expo.out"
  });

  animateSplit(".scroll-in-scale", {
    opacity: 0,
    scale: 0.3,
    ease: "elastic.out(1, 0.5)"
  });

  // 🔹 Extra styles
  animateSplit(".scroll-in-blur", {
    opacity: 0,
    filter: "blur(10px)",
    y: 30,
    ease: "power2.out",
    onUpdate: function () {
      this.targets().forEach(t => t.style.filter = "blur(0px)");
    }
  });

  animateSplit(".scroll-in-flip", {
    opacity: 0,
    rotationY: 180,
    transformOrigin: "50% 50% -50px",
    ease: "back.out(2)"
  });

  animateSplit(".scroll-in-drop", {
    opacity: 0,
    y: -80,
    ease: "bounce.out"
  });

  animateSplit(".scroll-in-wave", {
    opacity: 0,
    y: 50,
    rotationZ: 10,
    ease: "sine.out"
  });

  animateSplit(".scroll-in-skew", {
    opacity: 0,
    skewX: 30,
    ease: "power3.out"
  });
});
