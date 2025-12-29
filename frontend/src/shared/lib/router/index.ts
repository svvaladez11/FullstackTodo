import {Router} from "vue-router";
import {AppRouteLocationRaw} from "@/shared/types/routes";

export const routerPush = async (router: Router, to: AppRouteLocationRaw) => {
    await router.push(to);
}