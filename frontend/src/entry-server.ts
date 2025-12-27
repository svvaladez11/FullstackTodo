import {makeApp, Context} from "@/main";
import {createMemoryHistory} from "vue-router";
import {renderToString} from "@vue/server-renderer";
import {renderHeadToString} from "@vueuse/head";

export async function render(context: Context & { url: string }) {
    const {app, router, head} = await makeApp(context);

    router.history = createMemoryHistory(context.url);

    await router.push(context.url);
    await router.isReady();

    const html = await renderToString(app, {});
    const headToString = await renderHeadToString(head);


    return { html, headTags: headToString.headTags };
}