import express, { Express, Request, Response } from 'express';
import usuarios from '../data/usuarios.json';


const app: Express = express();
const port = 9909;

app.use(express.json({limit: '1mb'}));
app.use(express.urlencoded({limit: '1mb', extended: true}));

app.use((_req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*'); // NOSONAR
    res.header(
        'Access-Control-Allow-Headers', // NOSONAR
        'Authorization, X-API-KEY, Origin, X-Requested-With,' +
        'Content-Type, Accept, Access-Control-Allow-Request-Method' // NOSONAR
    );
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE'); // NOSONAR
    res.header('Allow', 'GET, POST, OPTIONS, PUT, DELETE');// NOSONAR
    next();
});

app.post('/login', (req: Request, res: Response) => {
    const body = req.body;
    const username = body.user as string;
    const password = body.password as string;
    const usuarioEncontrado = usuarios.find(user => user.user === username );
    if(usuarioEncontrado) {
        if(usuarioEncontrado.password === password) {
            const response = {
                rol: usuarioEncontrado.role
            }
            res.send(response);
        } else {
            res.status(401).send({"mensaje": "Contraseña incorrecta"});
        }
    } else {
        res.status(404).send({"message": "Usuario no encontrado"});
    }
});

app.listen(port, () => {
    console.log(`⚡️[server]: Server is running at https://localhost:${port}`);
});