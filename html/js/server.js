const express = require('express');
const mysql = require('mysql');

const app = express();
const port = 3000;

// Configuración de la conexión a la base de datos MySQL
const db = mysql.createConnection({
    host: '127.0.0.1:3306',
    user: 'tienda',
    password: 'tienda2024*',
    database: 'formulario_db'
});

// Conexión a la base de datos
db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log('Conexión establecida con la base de datos MySQL');
});

// Ruta para guardar los datos del formulario en la base de datos
app.post('/guardar-solicitud', (req, res) => {
    const { cliente, email, telefono, servicio } = req.body;

    const sql = 'INSERT INTO solicitudes (cliente, email, telefono, servicio) VALUES (?, ?, ?, ?)';
    db.query(sql, [cliente, email, telefono, servicio], (err, result) => {
        if (err) {
            res.status(500).send('Error al guardar la solicitud');
        } else {
            res.send('Solicitud guardada correctamente');
        }
    });
});

// Ruta para obtener todas las solicitudes almacenadas en la base de datos
app.get('/solicitudes', (req, res) => {
    const sql = 'SELECT * FROM solicitudes';
    db.query(sql, (err, results) => {
        if (err) {
            res.status(500).send('Error al obtener las solicitudes');
        } else {
            res.json(results);
        }
    });
});

app.listen(port, () => {
    console.log(`Servidor backend escuchando en http://localhost:${port}`);
});