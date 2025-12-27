export interface ICache<T> {
    get(): Partial<T>
    set(cache: Partial<T>): void
    add<K extends keyof T>(key: K, value: T[K]): void
    has<K extends keyof T>(key: K): boolean
    getItem<K extends keyof T>(key: K): T[K] | undefined
    clear(): void
}
