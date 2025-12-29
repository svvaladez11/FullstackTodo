import type {RouteLocationRaw, RouteRecordRaw} from "vue-router";
import type {routes} from "@/app/consts/routes";

export type AppRouteRecord = Omit<RouteRecordRaw, 'name' | 'children' | 'path'> & {
    path: string
    name: string
} | {
    path: string
    children: readonly AppRouteRecord[]
}

type GetRouteName<T extends AppRouteRecord> =
    T extends { path: string, children: readonly AppRouteRecord[] }
        ? GetRoutesNames<T['children']>
        : T['name']

type GetRoutesNames<T extends readonly AppRouteRecord[]> = GetRouteName<T[number]>

export type TRoutes = typeof routes
export type TRoutesNames = GetRoutesNames<TRoutes>

type GetRoutePath<T extends AppRouteRecord> =
    T extends { path: string, children: readonly AppRouteRecord[] }
        ?  GetRoutesPaths<T['children']>
        : T['path'];

type GetRoutesPaths<T extends readonly AppRouteRecord[]> = GetRoutePath<T[number]>;

export type TRoutesPaths = GetRoutesPaths<TRoutes>;


export type AppRouteLocationRaw = Omit<RouteLocationRaw, 'name' | 'path'> & {
    name?: TRoutesNames
    path?: TRoutesPaths
};