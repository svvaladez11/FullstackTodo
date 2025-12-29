import { useFormBuilder } from "@/shared/utils/useFormBuilder";
import {RegisterFormState} from "@/features/RegisterForm/types/model/use-register-form";

export default () => {
    const builder = useFormBuilder<RegisterFormState>();

    builder
        .addField("login", "text", "Введите логин")
        .makeRequired("Логин обязателен")
        .makeLogin("Некорректный логин")
        .makeMinLength(6, "Логин должен быть минимум 6 символов")
        .makeMaxLength(32, "Логин не должен превышать 32 символа");

    builder
        .addField("password", "password", "Введите пароль")
        .makeRequired("Пароль обязателен")
        .makePassword("Пароль слишком простой")
        .makeMinLength(12, "Пароль должен быть минимум 12 символов")
        .makeUpperCase("Пароль должен содержать хотя бы одну заглавную букву")
        .makeLowerCase("Пароль должен содержать хотя бы одну строчную букву")
        .makeDigits("Пароль должен содержать хотя бы одну цифру")
        .makeSpecialCharacters("Пароль должен содержать хотя бы один специальный символ");

    builder
        .addField("password_confirm", "password", "Подтвердите пароль")
        .makeRequired("Подтверждение обязательно")
        .makeSameAs("password", "Пароли не совпадают");

    return builder.build();
};
