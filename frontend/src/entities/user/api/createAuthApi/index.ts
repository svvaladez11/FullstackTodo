import axios, { AxiosInstance } from "axios";
import useUserStore from "@/entities/user/model/useUserStore";
import {BackendResponse} from "@/shared/types/api/api-request";
import {RespondWithToken} from "@/entities/user/types/api/getAuthenticatedUser";

export default (): AxiosInstance => {
    const store = useUserStore();

    const authApi = axios.create({
        baseURL: import.meta.env.VITE_API_BASE_URL,
    });

    authApi.interceptors.request.use(config => {
        if (localStorage.getItem('access_token')) {
            config.headers.Authorization = `Bearer ${localStorage.getItem('access_token')}`;
        }
        return config;
    });

    authApi.interceptors.response.use(
        res => res,
        async error => {
            const originalRequest = error.config;

            if (
                error.response?.status === 401 &&
                localStorage.getItem('access_token') &&
                !originalRequest._retry
            ) {
                originalRequest._retry = true;

                try {
                    const { data } = await axios.post<_, BackendResponse<RespondWithToken>>(
                        "/v1/users/refresh",
                        {},
                        {
                            baseURL: import.meta.env.VITE_API_BASE_URL,
                            headers: {
                                Authorization: `Bearer ${localStorage.getItem('access_token')}`
                            }
                        }
                    );

                    store.setUser({
                        user: JSON.parse(localStorage.getItem('user')),
                    });
                    store.setToken({
                        token: data.access_token,
                    });

                    originalRequest.headers.Authorization =
                        `Bearer ${data.token}`;

                    return authApi(originalRequest);
                } catch {
                    store.clearState();
                    localStorage.removeItem('user');
                    localStorage.removeItem('access_token');
                    return Promise.reject(error);
                }
            }

            return Promise.reject(error);
        }
    );

    return authApi;
};
