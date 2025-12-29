import {LoginFormState} from "@/features/LoginForm/types/model/use-login-form";
import apiRequest from "@/shared/api/api-request";
import {AxiosInstance, AxiosResponse} from "axios";
import {BackendResponse} from "@/shared/types/api/api-request";
import {ResponseWithUser} from "@/entities/user/types/api/getAuthenticatedUser";

export default async (api: AxiosInstance) => {
    return await apiRequest<_, AxiosResponse<BackendResponse<ResponseWithUser>>>({
        url: "/v1/users/me",
        method: "POST",
        api: api,
    })();
};
