import {makeApp, Context} from "@/main";

async function runApp(): Promise<void> {
    const context: Context = {
        ssr: false,
        apiCache: (window as Window & { appServerData: any})?.appServerData?.apiCache,
    }

    const {app, router} = await makeApp(context);

    router.afterEach((to,from) => {
        window.scrollTo(0, 0);
    })

    await router.isReady();

    app.mount('#app');

    if (context.apiCache) {
        setTimeout(() => {
            Object.keys(context.apiCache).forEach((key) => delete context.apiCache[key]);
        }, 5 * 60 * 1000);
    }
}

runApp();