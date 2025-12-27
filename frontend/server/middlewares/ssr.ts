import type { Express } from 'express'
import type { ViteDevServer } from 'vite'
import { PageRenderer } from '#server/ssr/renderPage'

export function setupSSR<TCache extends Record<string, unknown> = Record<string, unknown>>(
    params: {
        app: Express,
        cache: TCache,
        isProduction: boolean,
        vite?: ViteDevServer,
    }
) {
    params.app.use(async (req, res) => {
        try {
            const render = new PageRenderer(params.cache, params.isProduction, params.vite)
            const html = await render.renderPage(req.originalUrl)
            res.status(200).set({ 'Content-Type': 'text/html' }).end(html)
        } catch (e: any) {
            params.vite?.ssrFixStacktrace(e)
            console.error(e)
            res.status(500).end(e.stack)
        }
    })
}
