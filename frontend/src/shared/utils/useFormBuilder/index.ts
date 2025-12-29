import {computed, h, reactive, Ref, ref} from "vue";
import {useVuelidate, Validation, ValidationArgs} from "@vuelidate/core";
import {email, helpers, maxLength, minLength, required, sameAs} from "@vuelidate/validators";
import {
    digits,
    letters,
    login,
    lowercase,
    password,
    specialCharacters,
    uppercase,
    phoneNumber
} from "@/shared/types/vuelidate";
import BaseForm from "@/shared/ui/BaseForm/BaseForm.vue";
import {
    type InputTypes,
    type TextAreaTypes,
    type Field,
    type FieldOptions,
} from "@/shared/types/utils/use-form-builder";

export const useFormBuilder = <T extends Record<string, string>>() => {
    const fields = ref<Array<Field & FieldOptions>>([]);
    const state = reactive<T>({} as T);
    const rules = reactive<
        Record<
            string,
            ValidationRuleWithParams<object, any> |
            ValidationRuleWithoutParams<any>
        >
    >({});
    const computedRules = computed(() => rules);

    const builder = {
        addField: (name: keyof T, type: InputTypes | TextAreaTypes, placeholder: string, options?: FieldOptions) => {
            fields.value.push({name: name as string, type, placeholder, ...options});
            state[name] = "" as any;
            return builder;
        },

        makeRequired: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, required)
                : required;
            rules[last] = rules[last]
                ? {...rules[last], required: rule}
                : {required: rule};
            return builder;
        },

        makeEmail: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, email)
                : email;
            rules[last] = rules[last]
                ? {...rules[last], email: rule}
                : {email: rule};
            return builder;
        },

        makeLogin: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, login)
                : login;
            rules[last] = rules[last]
                ? {...rules[last], login: rule}
                : {login: rule};
            return builder;
        },

        makePhoneNumber: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, phoneNumber)
                : phoneNumber;
            rules[last] = rules[last]
                ? {...rules[last], phoneNumber: rule}
                : {phoneNumber: rule};
            return builder;
        },

        makeLetters: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, letters)
                : letters;
            rules[last] = rules[last]
                ? {...rules[last], letters: rule}
                : {letters: rule};
            return builder;
        },

        makeMinLength: (length: number, message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, minLength(length))
                : minLength(length);
            rules[last] = rules[last]
                ? {...rules[last], minLength: rule}
                : {minLength: rule};
            return builder;
        },

        makeMaxLength: (length: number, message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, maxLength(length))
                : maxLength(length);
            rules[last] = rules[last]
                ? {...rules[last], maxLength: rule}
                : {maxLength: rule};
            return builder;
        },

        makeSpecialCharacters: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, specialCharacters)
                : specialCharacters;
            rules[last] = rules[last]
                ? {...rules[last], specialCharacters: rule}
                : {specialCharacters: rule};
            return builder;
        },

        makeUpperCase: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, uppercase)
                : uppercase;
            rules[last] = rules[last]
                ? {...rules[last], uppercase: rule}
                : {uppercase: rule};
            return builder;
        },

        makeLowerCase: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, lowercase)
                : lowercase;
            rules[last] = rules[last]
                ? {...rules[last], lowercase: rule}
                : {lowercase: rule};
            return builder;
        },

        makeDigits: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, digits)
                : digits;
            rules[last] = rules[last]
                ? {...rules[last], digits: rule}
                : {digits: rule};
            return builder;
        },

        makePassword: (message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const rule = message
                ? helpers.withMessage(message, password)
                : password;
            rules[last] = rules[last]
                ? {...rules[last], password: rule}
                : {password: rule};
            return builder;
        },

        makeSameAs: (name: keyof T, message?: string) => {
            const last = fields.value[fields.value.length - 1].name as keyof T;
            const sameElement = computed(() => state[name]);
            const rule = message
                ? helpers.withMessage(message, sameAs(sameElement))
                : sameAs(sameElement);
            rules[last] = rules[last]
                ? {...rules[last], sameAs: rule}
                : {sameAs: rule};
            return builder;
        },

        build: () => {
            const v$ = useVuelidate(computedRules, state) as Ref<Validation<ValidationArgs<T>,T>>;
            const component = h(BaseForm, {fields: fields.value, state, v$});
            return {component, state, v$};
        },

        clear: () => {
            fields.value = [];
            Object.keys(state).forEach(key => delete state[key]);
            Object.keys(rules).forEach(key => delete rules[key]);
        },
    };

    return builder;
};
