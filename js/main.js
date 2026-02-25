window.addEventListener('load', () => {
            const tl = gsap.timeline({ defaults: { ease: "power4.out" } });

            tl.to("#hero-title", { opacity: 1, y: -20, duration: 1.5 })
              .to("#hero-sub", { opacity: 1, y: -20, duration: 1 }, "-=1")
              .to("#hero-btn", { opacity: 1, y: -10, duration: 1 }, "-=0.8");

            // Scroll Animation for cards
            gsap.from(".product-card", {
                scrollTrigger: {
                    trigger: ".product-card",
                    start: "top 80%",
                },
                y: 100,
                opacity: 0,
                duration: 1,
                stagger: 0.2
            });
        });