import { fetchConfig } from "./config";
import consts from "./consts";

import EventBus from "./event-bus";

export default class Core {
    async load(url) {
        return await fetch(url, fetchConfig).then((response) => {
            if (response.ok && response.headers.get("X-PJAX")) {
                return response.text();
            }

            EventBus.dispatchEvent(EventBus.events.ERROR, {
                type: consts.TYPES.ERRORS.API,
                status: response.status,
                message: response.message,
                data: response.data,
            });

            throw Error;
        });
    }

    checkCache(key) {
        if (localStorage.getItem(key) === null) {
            return false;
        }

        try {
            const data = JSON.parse(localStorage.getItem(key));

            return data.expires_at > Date.now();
        } catch (error) {
            // localStorage.clear();

            return false;
        }
    }
}
