import {ICache} from "#server/types";

export class ApiCache<T extends Record<string, unknown> = Record<string, unknown>> implements ICache<T>{
    private apiCache: Partial<T> = {}

    get(): Partial<T> {
        return this.apiCache
    }

    set(cache: Partial<T>): void {
        this.apiCache = cache
    }

    add<K extends keyof T>(key: K, value: T[K]): void {
        this.apiCache[key] = value
    }

    clear(): void {
        this.apiCache = {}
    }

    has<K extends keyof T>(key: K): boolean {
        return key in this.apiCache
    }

    getItem<K extends keyof T>(key: K): T[K] | undefined {
        return this.apiCache[key]
    }
}