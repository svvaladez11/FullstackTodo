import {App} from "vue";
import {PrimeVue} from "@primevue/core";
import {ToastService} from "primevue";

export default function setupVolt(app: App<Element>) {
    app.use(PrimeVue, {
        unstyled: true
    });
    app.use(ToastService);
}