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

export default () => {
    const api = inject("api");
    const toast = useToast();
    const router = useRouter();
    const store = useUserStore();
    const authApi = createAuthApi();

    const showSuccess = () => {
        toast.add({
            severity: "success",
            summary: "Успешно!",
            detail: "Вы успешно вошли в аккаунт.",
            life: 3000,
        });
    };

    const showError = () => {
        toast.add({
            severity: "error",
            summary: "Ошибка!",
            detail: "Пользователь не найден.",
            life: 3000,
        });
    };

    const showValidationError = () => {
        toast.add({
            severity: "error",
            summary: "Ошибка!",
            detail: "Данные введены неверно.",
            life: 3000,
        });
    };

    const submit = async (
        state: Reactive<LoginFormState>,
        v$: Ref<Validation<ValidationArgs<LoginFormState>,LoginFormState>>,
    ) => {
        let loginResult: ApiResult<RespondWithToken>;
        const isValid= await v$.value.$validate();
        if (isValid) {
            loginResult = await login(api, state);
        } else {
            showValidationError();
            return;
        }

        let errorIsNull = !loginResult.error;
        if (!errorIsNull) {
            showError();
            return;
        }

        localStorage.setItem('access_token', loginResult.responseData?.data.data.access_token);
        store.setToken({token: localStorage.getItem('access_token') });

        let getAuthenticatedUserResult: ApiResult<ResponseWithUser>
        getAuthenticatedUserResult = await getAuthenticatedUser(authApi);

        errorIsNull = !getAuthenticatedUserResult.error;
        if (errorIsNull) {
            localStorage.setItem('user', JSON.stringify(getAuthenticatedUserResult.responseData?.data.data.user))
            store.setUser({ user: JSON.parse(localStorage.getItem('user'))});
            showSuccess();
            await routerPush(router, { name: "home"});
        } else {
            showError();
        }

    };

    return {submit};
};
