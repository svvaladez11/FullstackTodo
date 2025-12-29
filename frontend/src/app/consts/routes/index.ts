import type {AppRouteRecord} from "@/shared/types/routes";

export const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('@/pages/home/ui/HomePage.vue'),
    },
    {
        path: '/users',
        children: [
            {
                path: '/registration',
                name: 'users.registration',
                component: () => import('@/pages/users/registration/ui/RegistrationPage.vue'),
            },
            {
                path: '/login',
                name: 'users.login',
                component: () => import('@/pages/users/login/ui/LoginPage.vue'),
            }
        ]
    }
] as const satisfies readonly AppRouteRecord[];