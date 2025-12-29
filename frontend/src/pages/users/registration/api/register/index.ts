import type { RegisterFormState } from "@/features/RegisterForm/types/model/use-register-form";
import apiRequest from "@/shared/api/api-request";
import {AxiosInstance} from "axios";

export default async (api: AxiosInstance, data: RegisterFormState) => {
    return await apiRequest<RegisterFormState>({
        url: "v1/users",
        method: "POST",
        api: api,
        data: data,
    })();
};
