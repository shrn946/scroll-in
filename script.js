gsap.registerPlugin(SplitText, ScrollTrigger);

document.fonts.ready.then(() => {
  const opts = (typeof siOptions !== "undefined") ? siOptions : {};

  function animateSplit(selector, settings) {
    document.querySelectorAll(selector).forEach(el => {
      let split = new SplitText(el, { type: "chars" });

      gsap.from(split.chars, {
        ...settings,
        duration: opts.speed || 1.2,
        stagger: opts.stagger || 0.05,
        delay: opts.delay || 0,
        scrollTrigger: {
          trigger: el,
          start: opts.start || "top 85%",
          end: "top 20%",
          scrub: true,
          toggleActions: (opts.once == 1) ? "play none none none" : "play none none reset"
        },
        onUpdate: function () {
          this.targets().forEach(t => t.style.filter = "blur(0px)");
        }
      });
    });
  }

  //  Enhanced scroll-in effect
  animateSplit(".scroll-in", {
    opacity: 0,
    y: 80,
    skewY: 10,
    skewX: 5,
    rotationX: 10,
    rotationZ: 8,
    scale: 0.7,
    filter: "blur(10px)",
    transformOrigin: "50% 50% -50px",
    ease: "power3.out"
  });
});
