import { useFormBuilder } from "@/shared/utils/useFormBuilder";
import { LoginFormState } from "@/features/LoginForm/types/model/use-login-form";

export default () => {
    const builder = useFormBuilder<LoginFormState>();

    builder
        .addField("login", "text", "Введите логин")
        .makeRequired("Логин обязателен")
        .makeLogin("Некорректный логин")
        .makeMinLength(3, "Логин должен быть минимум 3 символа")
        .makeMaxLength(32, "Логин не должен превышать 32 символа");

    builder
        .addField("password", "password", "Введите пароль")
        .makeRequired("Пароль обязателен")
        .makeMinLength(6, "Пароль должен быть минимум 6 символов")
        .makeMaxLength(128, "Пароль слишком длинный");

    return builder.build();
};
