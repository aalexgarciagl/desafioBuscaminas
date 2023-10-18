# desafioBuscaminas


### JSON: 
```json
{
  "correo": "Correo para Login",
  "pass": "contraseña para login",
  "newUserName":"campo para actualizar o añadir datos",
  "newUserCorreo":"campo para actualizar o añadir datos",
  "newUserPass": "campo para actualizar o añadir datos",
  "newEsAdmin": "campo para actualizar o añadir datos"
}
```


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
