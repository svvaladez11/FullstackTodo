import {inject, Reactive, Ref} from "vue";
import login from "@/pages/users/login/api/login";
import {Validation, ValidationArgs} from "@vuelidate/core";
import {useToast} from "primevue";
import type {ApiResult} from "@/shared/types/api/api-request";
import {useRouter} from "vue-router";
import {routerPush} from "@/shared/lib/router";
import {LoginFormState} from "@/features/LoginForm/types/model/use-login-form";
import {useUserStore} from "@/entities/user";
import getAuthenticatedUser from "@/entities/user/api/getAuthenticatedUser";
import {type RespondWithToken, type ResponseWithUser} from "@/entities/user";
import createAuthApi from "@/entities/user/api/createAuthApi";
import logout from "@/entities/user/api/logout";

export default () => {
    const store = useUserStore();
    const authApi = createAuthApi();

    const submit = async () => {
        await logout(authApi);

        localStorage.removeItem('access_token');
        store.setToken({token: null });

        localStorage.removeItem('user')
        store.setUser({ user: null});

    };

    return {submit};
};
