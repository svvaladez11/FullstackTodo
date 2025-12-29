import {Validation, ValidationArgs} from "@vuelidate/core";
import {Reactive, Ref} from "vue";
import type {RegisterFormState} from "@/features/RegisterForm/types/model/use-register-form";

export interface IEmits {
    "on-submit": [
        state: Reactive<RegisterFormState>,
        v$: Ref<Validation<ValidationArgs<RegisterFormState>,RegisterFormState>>
    ]
}