import { ref, Ref } from "vue";
import { AxiosResponse } from "axios";
import type {
    ApiRequest,
    BackendResponse,
    ErrorData,
    ApiResult,
    ResponseData,
} from "@/shared/types/api/api-request";

export default <TData = any, R = AxiosResponse<BackendResponse<TData>>, D = any>(
    params: ApiRequest<D>
): (() => Promise<ApiResult<TData>>) => {

    const apiCache = params.apiCache ?? null;
    const hasCache = !!apiCache && !!params.apiCacheKey;
    const isCached = hasCache && apiCache!.hasOwnProperty(params.apiCacheKey!);

    const responseData: Ref<ResponseData<TData> | null> = ref(null);
    const error: Ref<ErrorData | null> = ref(null);
    const isLoading = ref(false);

    let request!: () => Promise<ApiResult<TData>>;

    isLoading.value = true;

    // Возвращаем кешированный результат, если есть
    if (isCached) {
        responseData.value = apiCache![params.apiCacheKey!] as ResponseData<TData>;
        isLoading.value = false;

        return async () => ({
            responseData: responseData.value,
            error: error.value,
            isLoading: isLoading.value,
        });
    }

    const handleResponse = (res: AxiosResponse<BackendResponse<TData>>) => {
        const result: ResponseData<TData> = {
            data: res.data,
            code: res.status,
        };

        responseData.value = result;

        if (hasCache) {
            apiCache![params.apiCacheKey!] = result;
        }

        if (!res.data.success) {
            error.value = {
                message: res.data.message || "Server error",
                code: res.status,
            };
        }
    };

    switch (params.method) {
        case "GET":
            request = async () => {
                try {
                    const res = await params.api.get<BackendResponse<TData>, R, D>(
                        params.url,
                        params.config
                    );

                    handleResponse(res);
                } catch (err: any) {
                    error.value = {
                        message: err.response?.data?.message || err.message || "Network error",
                        code: err.response?.status || 500,
                    };
                } finally {
                    isLoading.value = false;
                }

                return {
                    responseData: responseData.value,
                    error: error.value,
                    isLoading: isLoading.value,
                };
            };
            break;

        case "POST":
            request = async () => {
                try {
                    const res = await params.api.post<BackendResponse<TData>, R, D>(
                        params.url,
                        params.data,
                        params.config
                    );

                    handleResponse(res);
                } catch (err: any) {
                    error.value = {
                        message: err.response?.data?.message || err.message || "Network error",
                        code: err.response?.status || 500,
                    };
                } finally {
                    isLoading.value = false;
                }

                return {
                    responseData: responseData.value,
                    error: error.value,
                    isLoading: isLoading.value,
                };
            };
            break;

        default:
            throw new Error(`Unsupported method: ${params.method}`);
    }

    return request;
};
