import {type Field} from "@/shared/types/utils/use-form-builder";
import {Validation, ValidationArgs} from "@vuelidate/core";

export interface IProps {
    fields: Field[];
    state: Record<string, any>;
    v$: Validation<ValidationArgs<any>, any>;
}

export interface IEmits {
    onSubmit: [];
}
