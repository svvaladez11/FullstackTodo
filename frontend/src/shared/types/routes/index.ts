import type {RouteLocationRaw, RouteRecordRaw} from "vue-router";
import type {routes} from "@/app/consts/routes";

export type AppRouteRecord = Omit<RouteRecordRaw, 'name' | 'children'> & {
    name: string
    children?: readonly AppRouteRecord[]
}

type GetRouteName<T extends AppRouteRecord> =
    T extends { children: readonly AppRouteRecord[] }
        ? T['name'] | GetRoutesNames<T['children']>
        : T['name']

type GetRoutesNames<T extends readonly AppRouteRecord[]> = GetRouteName<T[number]>

export type TRoutes = typeof routes
export type TRoutesNames = GetRoutesNames<TRoutes>

type GetRoutePath<T extends AppRouteRecord> =
    T extends { children: readonly AppRouteRecord[] }
        ? T['path'] | GetRoutesNames<T['children']>
        : T['path'];

type GetRoutesPaths<T extends readonly AppRouteRecord[]> = GetRoutePath<T[number]>;

export type TRoutesPaths = GetRoutesPaths<TRoutes>;

export type AppRouteLocationRaw = {
    name?: TRoutesNames
    path?: TRoutesPaths
    params?: { [p: string]: any }
    query?: object
    hash?: string
};