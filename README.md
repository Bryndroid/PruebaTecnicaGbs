# API de gestión de tareas

Proyecto de prueba técnica para **Global Solutions Latinoamérica**. Es una API REST desarrollada con Laravel para registrar usuarios, iniciar y cerrar sesión, y gestionar tareas asociadas a cada usuario. La autenticación de la API utiliza tokens de Laravel Sanctum.

## Requisitos

- PHP 8.2 o superior
- Composer
- SQLite (configurado por defecto)
- Node.js y npm (solo para compilar o ejecutar los recursos del frontend)

## Instalación

Desde la carpeta del proyecto:

```bash
composer install
```

Si no existe el archivo `.env`, créalo a partir del ejemplo:

```bash
cp .env.example .env
```

En Windows PowerShell, usa:

```powershell
Copy-Item .env.example .env
```

Genera la clave de la aplicación:

```bash
php artisan key:generate
```

La conexión predeterminada usa SQLite y `database/database.sqlite`. Si ese archivo no existe, créalo antes de migrar:

```powershell
New-Item -ItemType File -Path database\database.sqlite
```

## Base de datos, migraciones y datos de prueba

Ejecuta las migraciones:

```bash
php artisan migrate
```

Carga los datos definidos en `DatabaseSeeder` (usuario de ejemplo y tareas):

```bash
php artisan db:seed
```

Para borrar y reconstruir todas las tablas y volver a cargar los datos de prueba:

```bash
php artisan migrate:fresh --seed
```

También puedes ejecutar factories desde Tinker. Por ejemplo, para crear usuarios:

```bash
php artisan tinker --execute="App\Models\User::factory()->count(10)->create();"
```

Y para crear tareas asociadas al primer usuario existente:

```bash
php artisan tinker --execute="App\Models\Task::factory()->count(10)->create(['user_id' => App\Models\User::firstOrFail()->id]);"
```

## Ejecutar el proyecto

Inicia el servidor de desarrollo:

```bash
php artisan serve
```

La API estará disponible en `http://127.0.0.1:8000/api`. Si necesitas compilar o servir los recursos del frontend, instala sus dependencias y ejecuta Vite:

```bash
npm install
npm run dev
```

## Endpoints de la API

| Método | URI | Acceso |
|---|---|---|
| `POST` | `/api/register` | Público |
| `POST` | `/api/login` | Público |
| `GET` | `/api/logout` | Token requerido |
| `GET` | `/api/tareas` | Token requerido |
| `POST` | `/api/tareas` | Token requerido |
| `GET` | `/api/tareas/{id}` | Token requerido |
| `PUT` | `/api/tareas/{id}` | Token requerido |
| `DELETE` | `/api/tareas/{id}` | Token requerido |

Las rutas protegidas requieren el token de acceso en el encabezado `Authorization: Bearer {token}`.

## Pruebas

Ejecuta las pruebas automatizadas con:

```bash
php artisan test
```
