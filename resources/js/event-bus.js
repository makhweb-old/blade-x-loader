import consts from "./consts";

export default class EventBus {
    static events = {
        INIT: `${consts.PACKAGE_NAME}:init`,
        BEFORE_VISIT: `${consts.PACKAGE_NAME}:before-visit`,
        AFTER_VISIT: `${consts.PACKAGE_NAME}:after-visit`,
        ERROR: `${consts.PACKAGE_NAME}:error`,
    };

    static dispatchEvent(name, payload = null) {
        const event = new CustomEvent(name, {
            detail: payload,
        });

        // Dispatch the event
        document.dispatchEvent(event);
    }
}
