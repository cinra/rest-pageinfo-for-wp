"use strict";
var __createBinding = (this && this.__createBinding) || (Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    Object.defineProperty(o, k2, { enumerable: true, get: function() { return m[k]; } });
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
}));
var __exportStar = (this && this.__exportStar) || function(m, exports) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(exports, p)) __createBinding(exports, m, p);
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
exports.default = exports.api = void 0;
// apis
var _api_1 = require("./apis/$api");
Object.defineProperty(exports, "api", { enumerable: true, get: function () { return __importDefault(_api_1).default; } });
var _api_2 = require("./apis/$api");
Object.defineProperty(exports, "default", { enumerable: true, get: function () { return __importDefault(_api_2).default; } });
// types
__exportStar(require("./apis/page-info/@types"), exports);
