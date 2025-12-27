import {Ref, ref} from "vue";
import {AxiosResponse} from "axios";
import {ServerApiRequest, ErrorData} from "@/shared/types/api/api-request";

export default <
    T = any,
    R = AxiosResponse<T>,
    D = any
>(params: ServerApiRequest<D>) => {
    // define apiCache
    const apiCache = params.apiCache;
    const keyIsExists = params.apiCacheKey && apiCache?.hasOwnProperty(params.apiCacheKey) || false;


    // define axios realization
    const axios = params.api;

    // define properties
    const responseData: Ref<T | null> = ref(null);
    const error: Ref<ErrorData | null> = ref(null);
    const isLoading: Ref<boolean> = ref(false);


    let request: () => Promise<{
        error: typeof error.value,
        isLoading: typeof isLoading.value,
        responseData: typeof responseData.value
    }>;


    isLoading.value = true;

    // if result is cached, then save it in responseData
    if (keyIsExists) {
        responseData.value = apiCache[params.apiCacheKey] as T;


        isLoading.value = false;

        request = async () => {
            return {
                responseData: responseData.value,
                error: error.value,
                isLoading: isLoading.value
            };
        };
    } else {

        switch (params.method) {
            case "GET":
                request = async () => {

                    try {
                        const response = await axios.get<T, R, D>(params.url, params.config);
                        responseData.value = response.data;
                        apiCache[params.apiCacheKey] = response.data;
                    } catch (err) {
                        error.value = err.response?.data?.message || err.message || 'Произошла ошибка';
                    } finally {
                        isLoading.value = false;
                    }

                    return {
                        responseData: responseData.value,
                        error: error.value,
                        isLoading: isLoading.value
                    };
                }
        }
    }

    return request;
}
