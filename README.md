# desafioBuscaminas

### JSON: 
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

### Credenciales de admin: 
  **User:** admin@gmail
  **Password:** p6jbfQF6


## Funciones disponibles: 

### GET:
  **/admin:** Muestra todos los usuarios de la base de datos.
  **/admin/correo:** Muestra los datos del usuario con el correo correspondiente

### POST: 
  **/admin:** Introduce en la base de datos al usuario que le pasemos a traves del JSON. 

### PUT: 
  **/admin/correo:** Actualiza los datos del usuario con el correo de la URL, los nuevos datos los obtiene del JSON. 

### DELETE: 
  **/admin/correo:** Elimina de la base de datos el usuario con el correo correspondiente de la URL. 
