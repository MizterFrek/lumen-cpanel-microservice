# Microservicio cPanel

El siguiente microservicio tiene la finalidad de consumir [cPanel UAPI](https://docs.cpanel.net/knowledge-base/security/how-to-use-cpanel-api-tokens/#run-api-functions-with-the-token) para automatizar las acciones que se hacen en la interfaz del host.

> [!NOTE]
> En caso el microservicio deje de funcionar, es probable que sea por alguna modificación o desuso de la versión UAPI utilizada. En caso de consulta, revisar la [documentación de la API](https://api.docs.cpanel.net/cpanel/introduction) para la comprensión del proyecto.

### Capacidades del Microservicio

- Crear base de datos y asignarlo a usuario Mysql predeterminado;
- Asignar un subdominio a una ruta archivo predeterminado.
  
> [!IMPORTANT]
>Está inhabilitado la creación de un subdominio nombrado "cpanel" por defecto, debido a que sobreescribiría el host de alojamiento de todo el servidor. Si se desean agregar mas subdominios para impedir su creación se puede hacer en la variable de entorno __DOMAINS_NOT_ALLOWED__.

## EndPoints

| Method | Route | Request | Function |
| ------ | ------ | ------ | ------ |
| GET | / | (none) | Retorna ok para verificar que la conexión es correcta |
| POST | ZnIdazdOwfzOU1Ks | tenant: `required` | Crea una base de datos y lo asigna a el usuario predeterminado |
| POST | uW7un5T0CqPsrKek | subdomain: `required` | Crea un subdominio y lo asigna al path predeterminado |

## Responses

### Success response interface

```js
{
  status: true, 
  message: 'OK',
  code: 200     
}
```

### Error response interface

```js
{
  status: false,          
  error: 'Page not found',
  code: 404               
}
```

## Variables de entorno

| Variable | Uso |
| ------ | ------ |
| ACCEPTED_SECRETS | Token de autorización para el consumo de el microservicio |
| DOMAINS_NOT_ALLOWED | Lista de subdominios que no se deben permitir su creación |
| CPANEL_SUBDOMAIN_PATH | Directorio de los Archivos de cPanel donde apuntará el subdominio que se va a  crear |
| CPANEL_URL | URL con subdominio de cPanel donde se ejecutaran las APIs |
| CPANEL_PORT | Número de Puerto para las peticiones API de cPanel |
| CPANEL_USERNAME | Usuario con el que se hace login a cPanel |
| CPANEL_TOKEN | Registra el Token de autenticación para las peticiones API |
| PREFIX_DATABASE | Prefix de las bases de datos que tiene configurado cPanel |
| DB_MANAGER_USERNAME | Usuario Mysql que se asignará a todas las bases de datos a crear |
| DB_MANAGER_PASSWORD | Password del Usuario Mysql que se asignará a todas las bases de datos a crear |

##### Ejemplo de uso de variables de entorno
```sh
ACCEPTED_SECRETS=******************************
CPANEL_SUBDOMAIN_PATH=public_html/directorio
CPANEL_URL=https://cpanel.dominio.com
CPANEL_PORT=2083
CPANEL_USERNAME=cpanel-username
CPANEL_TOKEN=**************************************
PREFIX_DATABASE=prefix_database_
DB_MANAGER_USERNAME=prefix_database_dominio_user
DB_MANAGER_PASSWORD=****************
DOMAINS_NOT_ALLOWED=domain1,domain2,domain3
```

## Framework

El presente microservicio está construido con Laravel Lumen.
La documentación del framework se puede encontrar en la página web de [Lumen](https://lumen.laravel.com/docs).

## Licencia
El framework Lumen es un software de código abierto con licencia [licencia MIT](https://opensource.org/licenses/MIT).
