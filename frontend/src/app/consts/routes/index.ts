import type {AppRouteRecord} from "@/shared/types/routes";

export const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('@/pages/home/ui/HomePage.vue'),
    },
] as const satisfies readonly AppRouteRecord[];