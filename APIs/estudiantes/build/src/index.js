"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const estudiantes_json_1 = __importDefault(require("../data/estudiantes.json"));
const app = (0, express_1.default)();
const port = 9910;
app.get('/estudiantes', (_req, res) => {
    res.send(estudiantes_json_1.default);
});
app.listen(port, () => {
    console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});
//# sourceMappingURL=index.js.map