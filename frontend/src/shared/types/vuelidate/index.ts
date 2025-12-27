import {helpers} from "@vuelidate/validators";
import {Errors} from "@/shared/types/store-modules/vuelidate";
import {Ref} from "vue";

export const letters = helpers.withParams(
    {type: 'letters'},
    value => !helpers.req(value) || /^[\p{L}\p{N}\s]+$/u.test(<string>value),
);
export const phoneNumber = helpers.withParams(
    {type: 'phoneNumber'},
    value => !helpers.req(value) || /^\+?\d[\d\s\-().]{6,}\d$/.test(<string>value),
);
export const login = helpers.withParams(
    { type: 'login' },
    value => !helpers.req(value) || loginRegExp.test(value as string),
)
export const specialCharacters = helpers.withParams(
    {type: 'specialCharacters'},
    value => !helpers.req(value) || /[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+/.test(value as string),
)
export const uppercase = helpers.withParams(
    {type: 'uppercase'},
    value => !helpers.req(value) || /[A-Z]/.test(value as string),
)
export const lowercase = helpers.withParams(
    {type: 'lowercase'},
    value => !helpers.req(value) || /[a-z]/.test(value as string),
)
export const digits = helpers.withParams(
    {type: 'digits'},
    value => !helpers.req(value) || /\d/.test(value as string),
)
export const password = helpers.withParams(
    {type: 'password'},
    value => !helpers.req(value) || /^[A-Za-z0-9!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]+$/.test(value as string),
)
export const serverError = (name: string, errors: Ref<Errors>) => helpers.withParams(
    {type: 'serverError'},
    () => !errors.value[name],
)

export const loginRegExp = /^[A-Za-z0-9\-_]+$/