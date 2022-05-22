import express, { Express, Request, Response } from 'express';
import estudiantes from '../data/estudiantes.json';


const app: Express = express();
const port = 9910;

app.get('/estudiantes', (_req: Request, res: Response) => {
  res.send(estudiantes);
});

app.listen(port, () => {
  console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});