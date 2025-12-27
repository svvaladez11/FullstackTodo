import fs from 'node:fs'
import path from 'node:path'
import type { ViteDevServer } from 'vite'
import type { Context } from '@/main'
import { ICache } from "#server/types"

export class PageRenderer<TCache extends Record<string, unknown> = Record<string, unknown>> {

    private readonly prodTemplate: string

    constructor(
        private cache: ICache<TCache>,
        private isProduction: boolean,
        private vite?: ViteDevServer,
    ) {
        this.prodTemplate = this.isProduction
            ? fs.readFileSync(path.resolve(process.cwd(), 'dist/client/index.html'), 'utf-8')
            : ''
    }

    private async loadTemplate(url: string): Promise<string> {
        if (!this.isProduction && this.vite) {
            let template = fs.readFileSync(path.resolve(process.cwd(), 'index.html'), 'utf-8')
            template = await this.vite.transformIndexHtml(url, template)
            return template
        } else {
            return this.prodTemplate
        }
    }

    private async loadRenderer(): Promise<(ctx: Context) => Promise<any>> {
        if (!this.isProduction && this.vite) {
            const mod = await this.vite.ssrLoadModule('/src/entry-server.ts')
            return mod.render
        } else {
            const mod = await import(path.resolve(process.cwd(), 'dist/server/entry-server.js'))
            return mod.render
        }
    }

    public async renderPage(url: string): Promise<string> {
        const template = await this.loadTemplate(url)
        const render = await this.loadRenderer()

        const context: Context = {
            ssr: true,
            apiCache: this.cache,
            url,
        }

        const rendered = await render(context)

        return template
            .replace('<!--app-head-->', rendered.headTags || '')
            .replace(
                '<!--app-html--> ',
                !rendered.html ? `<title>Опа, ошибочка вышла...</title>` : rendered.html
            )
            .replace(
                '<!--app-server-data-->',
                `window.appServerData = { apiCache: ${JSON.stringify(context.apiCache.get())} };`
            )
    }
}
