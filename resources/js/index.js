import consts from "./consts";

import Autoloader from "./autoloader";
import EventBus from "./event-bus";
import Core from "./core";

export default class BladeXLoader extends Core {
    config = {
        rootID: null
    };

    constructor(config) {
        super();
        Object.assign(this.config, config);

        this.init();

        this.autoloader = new Autoloader();
        this.autoloader.start();
    }

    getRootID() {
        return `#${this.config.rootID}`;
    }

    init() {
        document.addEventListener("click", (e) => {
            if (e.target && e.target.hasAttribute(consts.ATTRIBUTES.TAG)) {
                this.handleClick.bind(this)(e);
            }
        });

        window.addEventListener("popstate", this.handlePopstate.bind(this));
    }

    handleClick(event) {
        event.preventDefault();
        EventBus.dispatchEvent(EventBus.events.BEFORE_VISIT, {
            type: consts.TYPES.EVENTS.CLICK,
            element: event.target,
        });

        const oldUrl = new URL(window.location.href);
        const url = new URL(event.target.getAttribute("href"));

        this.changeUrl(url.pathname);

        if (this.checkCache(url.pathname)) {
            this.restoreFromCache(url.pathname);
        } else {
            this.load(url.toString())
                .then((data) => {
                    this.done(data);
                    this.cache(event.target, url.pathname, data);
                })
                .catch(() => {
                    this.changeUrl(oldUrl);
                });
        }
        this.scrollToTop();
    }

    handlePopstate() {
        EventBus.dispatchEvent(EventBus.events.BEFORE_VISIT, {
            type: consts.TYPES.EVENTS.POPSTATE,
        });

        const url = new URL(window.location.href);

        if (this.checkCache(url.pathname)) {
            this.restoreFromCache(url.pathname);
        } else {
            this.load(url.toString()).then((data) => {
                this.done(data);
            });
        }
    }

    scrollToTop() {
        window.scrollTo(0, 0);
    }

    restoreFromCache(urlPathname) {
        const data = JSON.parse(localStorage.getItem(urlPathname));

        this.done(data.html);
    }

    cache(element, key, value) {
        const lifetime = element.getAttribute(consts.ATTRIBUTES.CACHE);
        if (lifetime) {
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

    changeUrl(url) {
        window.history.pushState(window.location.href, null, url);
    }

    done(data) {
        const el = document.querySelector(this.getRootID());
        el.innerHTML = data;

        EventBus.dispatchEvent(EventBus.events.AFTER_VISIT);
    }
}
