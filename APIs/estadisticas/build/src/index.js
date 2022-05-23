"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const estudiantes_json_1 = __importDefault(require("../data/estudiantes.json"));
const app = (0, express_1.default)();
const port = 9911;
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
app.get('/estadistica/promedio-notas', (_req, res) => {
    res.send(manageData());
});
app.listen(port, () => {
    console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});
function manageData() {
    let estudiantes_perdieron = [];
    let estudiantes_pasaron = [];
    let periodos = new Set();
    for (const estudiante of estudiantes_json_1.default) {
        periodos.add(estudiante.periodo);
        if (estudiante.nota < 3) {
            const valor_previo = estudiantes_perdieron[estudiante.periodo];
            if (valor_previo) {
                estudiantes_perdieron[estudiante.periodo]++;
            }
            else {
                estudiantes_perdieron[estudiante.periodo] = 1;
            }
        }
        else {
            const valor_previo_pasaron = estudiantes_pasaron[estudiante.periodo];
            if (valor_previo_pasaron) {
                estudiantes_pasaron[estudiante.periodo]++;
            }
            else {
                estudiantes_pasaron[estudiante.periodo] = 1;
            }
        }
    }
    const resultado = [];
    for (const periodo of periodos) {
        let estudiantes_perdieron_periodo = estudiantes_perdieron[periodo];
        estudiantes_perdieron_periodo = !estudiantes_perdieron_periodo ? 0 : estudiantes_perdieron_periodo;
        let estudiantes_pasaron_periodo = estudiantes_pasaron[periodo];
        estudiantes_pasaron_periodo = !estudiantes_pasaron_periodo ? 0 : estudiantes_pasaron_periodo;
        const estadistica_periodo = {
            periodo: periodo,
            'cantidad-estudiantes-perdieron': estudiantes_perdieron_periodo,
            'cantidad-estudiantes-pasaron': estudiantes_pasaron_periodo
        };
        resultado.push(estadistica_periodo);
    }
    return resultado;
}
//# sourceMappingURL=index.js.map