import type { Express } from 'express'
import { createServer } from 'vite'

export async function setupViteDev(app: Express) {
    const vite = await createServer({
        server: { middlewareMode: true },
        appType: 'custom',
        base: process.env.BASE,
    })

    app.use(vite.middlewares)

    return vite
}
