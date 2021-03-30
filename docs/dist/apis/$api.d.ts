import { AspidaClient } from 'aspida';
import { Methods as Methods0 } from './page-info/_uri';
declare const api: <T>({ baseURL, fetch }: AspidaClient<T>) => {
    page_info: {
        _uri: (val1: number | string) => {
            get: (option: {
                query: Methods0['get']['query'];
                config?: T | undefined;
            }) => Promise<import("aspida").AspidaResponse<import("..").PageInfo, import("aspida").BasicHeaders, import("aspida").HttpStatusOk>>;
            $get: (option: {
                query: Methods0['get']['query'];
                config?: T | undefined;
            }) => Promise<import("..").PageInfo>;
            $path: (option?: {
                method?: "get" | undefined;
                query: Methods0['get']['query'];
            } | undefined) => string;
        };
    };
};
export declare type ApiInstance = ReturnType<typeof api>;
export default api;
