import type { AxiosInstance, AxiosRequestConfig } from "axios";

// define error types
export type ErrorData = {
    message: string;
    code: number;
};


// define request types
export type RequestMethod =
    | "GET"
    | "POST"
    | "PUT"
    | "PATCH"
    | "DELETE";

export interface ApiRequest<D = any> {
    url: string;
    method: RequestMethod;
    api: AxiosInstance;
    apiCacheKey?: string;
    apiCache?: Record<string, any> | null;
    data?: D;
    config?: AxiosRequestConfig<D>;
}

// define response types
export type BackendResponse<T> = {
    success: boolean;
    data: T;
    message: string;
    errors: Record<string, string[]>;
};

// define api types
type ResponseData<T> = {
    data: BackendResponse<T>
    code: number
};

export type ApiResult<T> = {
    responseData: ResponseData<T> | null;
    error: ErrorData | null;
    isLoading: boolean;
};