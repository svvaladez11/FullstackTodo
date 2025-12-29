import {inject, Reactive, Ref} from "vue";
import register from "@/pages/users/registration/api/register";
import {Validation, ValidationArgs} from "@vuelidate/core";
import {useToast} from "primevue";
import type {ApiResult} from "@/shared/types/api/api-request";
import {RegisterFormState} from "@/features/RegisterForm/types/model/use-register-form";
import {useRouter} from "vue-router";
import {routerPush} from "@/shared/lib/router";

export default () => {
    const api = inject("api");
    const toast = useToast();
    const router = useRouter();

    const showSuccess = () => {
        toast.add({
            severity: "success",
            summary: "Успешно!",
            detail: "Аккаунт успешно создан.",
            life: 3000,
        });
    };

    const showNetworkError = () => {
        toast.add({
            severity: "error",
            summary: "Ошибка!",
            detail: "Серверная ошибка, повторите попытку позже.",
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
        state: Reactive<RegisterFormState>,
        v$: Ref<Validation<ValidationArgs<RegisterFormState>,RegisterFormState>>,
    ) => {
        let result: ApiResult<RegisterFormState>;
        const isValid= await v$.value.$validate();
        if (isValid) {
            result = await register(api, state);
        } else {
            showValidationError();
            return;
        }

        const errorIsNull = !result.error;
        if (errorIsNull) {
            showSuccess();
            await routerPush(router, { name: "users.login"});
        } else {
            showNetworkError();
        }
    };

    return {submit};
};
