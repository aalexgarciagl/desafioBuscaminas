# Desafio Buscaminas Desarrollo Web Entorno Servidor.
### Alejandro García Gil.

## Credenciales de admin: 
  **User:** admin@gmail
  **Password:** admin1234

## JSON: 
```json
{
  "correo": "alejandro@gmail",
  "pass": "alejandro1234",
  "newUserName":"Juan",
  "newUserCorreo":"",
  "newUserPass": "juan1234",
  "newEsAdmin": "",
  "casilla": 1
}
```
Los campos **"Correo"** y **"pass"** sirven para introducir los credenciales de inicio de sesión.
Lo campos **"newUserName"**, **"newUserCorreo"**,**"newUserPass"** y **"newEsAdmin"** sirven para modificar los datos de alguna persona o para insertar nuevas personas a la base de datos.
El campo **"casilla"** sirve para seleccionar la casilla que queremos marcar a la hora de jugar. 


## Funciones admin
Para que las siguientes rutas funcionen, el usuario que le pasemos por los campos del JSON **"correo"** y **"pass"** debera tener permisos de adminisitrador.
### Listar usuarios: 
**GET/localhost/admin**
### Listar usuario por correo: 
**GET/localhost/admin/{correo}**
### Modificar usuario: 
**PUT/localhost/admin/{correo}** + **JSON**
### Eliminar usuario: 
**DELETE/localhost/admin/{correo}**
### Registrar usuario: 
**POST/localhost/admin/** + **JSON**
