import {LoginFormState} from "@/features/LoginForm/types/model/use-login-form";
import apiRequest from "@/shared/api/api-request";
import {AxiosInstance, AxiosResponse} from "axios";
import {BackendResponse} from "@/shared/types/api/api-request";
import {ResponseWithUser} from "@/entities/user/types/api/getAuthenticatedUser";

export default async (api: AxiosInstance) => {
    return await apiRequest({
        url: "/v1/users/logout",
        method: "POST",
        api: api,
    })();
};
