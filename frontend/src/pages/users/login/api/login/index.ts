import {LoginFormState} from "@/features/LoginForm/types/model/use-login-form";
import apiRequest from "@/shared/api/api-request";
import {AxiosInstance, AxiosResponse} from "axios";
import {BackendResponse} from "@/shared/types/api/api-request";
import {type RespondWithToken} from "@/entities/user";

export default async (api: AxiosInstance, data: LoginFormState) => {
    return await apiRequest<LoginFormState, AxiosResponse<BackendResponse<RespondWithToken>>>({
        url: "/v1/users/login",
        method: "POST",
        api: api,
        data: data,
    })();
};
