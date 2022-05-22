import express, { Express, Request, Response } from 'express';
import estudiantes from '../data/estudiantes.json';

const app: Express = express();
const port = 9911;

app.get('/estadistica/promedio-notas', (_req: Request, res: Response) => {
  res.send(manageData());
});

app.listen(port, () => {
  console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});

function manageData() {

  let estudiantes_perdieron = [];
  let estudiantes_pasaron = [];
  let periodos = new Set();

  for (const estudiante of estudiantes) {
    periodos.add(estudiante.periodo);
    if(estudiante.nota < 3 ) {
      const valor_previo = estudiantes_perdieron[estudiante.periodo];
      if(valor_previo) {
        estudiantes_perdieron[estudiante.periodo] ++;
      } else {
        estudiantes_perdieron[estudiante.periodo] = 1;
      }
    } else {
      const valor_previo_pasaron = estudiantes_pasaron[estudiante.periodo];
      if(valor_previo_pasaron) {
        estudiantes_pasaron[estudiante.periodo] ++;
      } else {
        estudiantes_pasaron[estudiante.periodo] = 1;
      }
    }
  }
  const resultado = [];

  for (const periodo of periodos) {
    let estudiantes_perdieron_periodo = estudiantes_perdieron[periodo as number];
    estudiantes_perdieron_periodo = !estudiantes_perdieron_periodo ? 0 : estudiantes_perdieron_periodo;
    let estudiantes_pasaron_periodo = estudiantes_pasaron[periodo as number];
    estudiantes_pasaron_periodo = !estudiantes_pasaron_periodo ? 0 : estudiantes_pasaron_periodo;

    const estadistica_periodo = {
      periodo: periodo,
      'cantidad-estudiantes-perdieron': estudiantes_perdieron_periodo,
      'cantidad-estudiantes-pasaron': estudiantes_pasaron_periodo
    }

    resultado.push(estadistica_periodo);
  }

  return resultado;
}