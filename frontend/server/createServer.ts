import express from "express"
import {setupViteDev} from "#server/middlewares/viteDev";
import {setupSSR} from "#server/middlewares/ssr";
import {setupLiveReload} from "#server/middlewares/livereload";

export default async <TCache extends Record<string, unknown> = Record<string, unknown>>(
    isProduction: boolean,
    cache: TCache,
): Express => {
    const app = express();

    let vite;
    if(!isProduction) {
        vite = await setupViteDev(app);
    }

    setupSSR({
        app,
        cache,
        isProduction,
        vite,
    });

    return app;
}