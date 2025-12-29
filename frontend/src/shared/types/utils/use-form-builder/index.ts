export type InputTypes = 'text' | 'password' | 'mask' | 'number' | 'otp';
export type TextAreaTypes = 'textarea';

export type Field = {
    name: string;
    type: InputTypes | TextAreaTypes;
    placeholder: string;
    mask?: string;
    length?: number;
};

export type FieldOptions = {
    mask?: string;
    length?: number;
};