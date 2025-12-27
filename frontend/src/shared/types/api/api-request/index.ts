import {AxiosInstance, AxiosRequestConfig} from "axios";

export type ErrorData = {
    message: string
};
type RequestMethod = 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE';
interface ApiRequest<D = any> {
    url: string
    method: RequestMethod
    apiCacheKey?: string
    data?: any
    config?: AxiosRequestConfig<D>
    api?: AxiosInstance
}
export interface ServerApiRequest<D = any> extends ApiRequest<D> {
    apiCache?: { [p: string]: any }
}
export type ServerApiResponse<T = any> = Promise<{
    responseData: T | null
    error: ErrorData | null
    isLoading: boolean
}>