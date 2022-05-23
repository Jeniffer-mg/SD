"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const usuarios_json_1 = __importDefault(require("../data/usuarios.json"));
const app = (0, express_1.default)();
const port = 9909;
app.use(express_1.default.json({ limit: '1mb' }));
app.use(express_1.default.urlencoded({ limit: '1mb', extended: true }));
app.use((_req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*'); // NOSONAR
    res.header('Access-Control-Allow-Headers', // NOSONAR
    'Authorization, X-API-KEY, Origin, X-Requested-With,' +
        'Content-Type, Accept, Access-Control-Allow-Request-Method' // NOSONAR
    );
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE'); // NOSONAR
    res.header('Allow', 'GET, POST, OPTIONS, PUT, DELETE'); // NOSONAR
    next();
});
app.post('/login', (req, res) => {
    const body = req.body;
    const username = body.user;
    const password = body.password;
    const usuarioEncontrado = usuarios_json_1.default.find(user => user.user === username);
    if (usuarioEncontrado) {
        if (usuarioEncontrado.password === password) {
            const response = {
                rol: usuarioEncontrado.role
            };
            res.send(response);
        }
        else {
            res.status(401).send({ "mensaje": "Contraseña incorrecta" });
        }
    }
    else {
        res.status(404).send({ "message": "Usuario no encontrado" });
    }
});
app.listen(port, () => {
    console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});
//# sourceMappingURL=index.js.map