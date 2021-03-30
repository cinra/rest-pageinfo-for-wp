"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
/* eslint-disable */
const aspida_1 = require("aspida");
const api = ({ baseURL, fetch }) => {
    const prefix = (baseURL === undefined ? '' : baseURL).replace(/\/$/, '');
    const PATH0 = '/page-info';
    const GET = 'GET';
    return {
        page_info: {
            _uri: (val1) => {
                const prefix1 = `${PATH0}/${val1}`;
                return {
                    get: (option) => fetch(prefix, prefix1, GET, option).json(),
                    $get: (option) => fetch(prefix, prefix1, GET, option).json().then(r => r.body),
                    $path: (option) => `${prefix}${prefix1}${option && option.query ? `?${aspida_1.dataToURLString(option.query)}` : ''}`
                };
            }
        }
    };
};
exports.default = api;
