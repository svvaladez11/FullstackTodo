import {Validation, ValidationArgs} from "@vuelidate/core";
import {Reactive, Ref} from "vue";
import type {LoginFormState} from "@/features/LoginForm/types/model/use-login-form";

export interface IEmits {
    "on-submit": [
        state: Reactive<LoginFormState>,
        v$: Ref<Validation<ValidationArgs<LoginFormState>,LoginFormState>>
    ]
}