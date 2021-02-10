import consts from "./consts";
import Core from "./core";
import EventBus from "./event-bus";

export default class Autoloader extends Core {
    start() {
        window.onload = () => {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        const url = new URL(
                            target.getAttribute(consts.ATTRIBUTES.HREF)
                        );

                        if (!target.getAttribute(consts.ATTRIBUTES.AUTOLOAD)) {
                            return false;
                        }
                        if (!this.checkCache(url.pathname)) {
                            this.load(url.toString()).then((data) => {
                                this.cache(
                                    url.pathname,
                                    data,
                                    target.getAttribute(
                                        consts.ATTRIBUTES.AUTOLOAD
                                    )
                                );
                            });
                        }
                    }
                });
            });

            EventBus.dispatchEvent(EventBus.events.INIT);
        };

        // Events
        document.addEventListener(
            EventBus.events.INIT,
            this.observe.bind(this)
        );
        document.addEventListener(
            EventBus.events.AFTER_VISIT,
            this.observe.bind(this)
        );
    }

    observe() {
        const arr = document.querySelectorAll(
            `a[${consts.ATTRIBUTES.AUTOLOAD}]`
        );
        if (arr.length) {
            arr.forEach((i) => {
                this.observer.observe(i);
            });
        }
    }
    cache(key, value, lifetime) {
        const time = new Date();
        time.setSeconds(time.getSeconds() + parseInt(lifetime));

        localStorage.setItem(
            key,
            JSON.stringify({
                html: value,
                expires_at: time.getTime(),
            })
        );
    }
}
