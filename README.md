# Address Clock

Aplicación web Laravel que muestra imágenes asociadas a cada minuto del día (reloj de 24×60) con ubicación en mapa. Permite cargar fotos por franja horaria, extraer coordenadas GPS y generar miniaturas.

---

## Requerimientos del sistema

### Aplicaciones y versiones

| Requisito        | Versión mínima |
|------------------|----------------|
| **PHP**          | 8.2 o superior |
| **Composer**     | 2.x            |
| **MySQL**        | 5.7+ o MariaDB 10.3+ |
| **Extensiones PHP** | Ver más abajo |

### Extensiones PHP necesarias

- `bcmath`
- `ctype`
- `curl`
- `dom`
- `fileinfo`
- `json`
- `mbstring`
- `openssl`
- `pdo_mysql` (o el driver de la base de datos que uses)
- `tokenizer`
- `xml`

Para comprobar extensiones instaladas:

```bash
php -m
```

### Dependencias del proyecto

- **Laravel** (framework)
- **Laravel Sanctum** (autenticación API)
- **Spatie Laravel Permission** (roles y permisos)
- **Guzzle** (cliente HTTP)

Las versiones exactas se definen en `composer.json` (Laravel ^12.0, PHP ^8.2, etc.).

---

## Configuración

### 1. Variables de entorno

Copia el archivo de ejemplo y genera la clave de aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

Edita `.env` y ajusta al menos:

| Variable      | Descripción |
|---------------|-------------|
| `APP_NAME`   | Nombre de la aplicación |
| `APP_ENV`    | `local` en desarrollo, `production` en producción |
| `APP_DEBUG`  | `true` en desarrollo, `false` en producción |
| `APP_URL`    | URL pública (ej. `http://localhost:8000` o `https://tudominio.com`) |
| `DB_CONNECTION` | `mysql` (por defecto) |
| `DB_HOST`    | Servidor de base de datos |
| `DB_PORT`    | Puerto (3306 para MySQL) |
| `DB_DATABASE`| Nombre de la base de datos |
| `DB_USERNAME`| Usuario de la base de datos |
| `DB_PASSWORD`| Contraseña de la base de datos |
| `FILESYSTEM_DRIVER` | `local` (almacenamiento por defecto) |

### 2. Directorios de almacenamiento

La aplicación utiliza:

- `storage/app/times/` — imágenes por minuto (generadas por los comandos Artisan).
- `storage/app/download/` — carpeta desde la que `time:load-all` importa archivos (nombres tipo `HHMM.jpg`).

Asegura que existan y tengan permisos de escritura:

```bash
mkdir -p storage/app/times storage/app/download
# En Linux/macOS:
chmod -R 775 storage bootstrap/cache
```

---

## Despliegue en entorno local

### 1. Clonar e instalar dependencias

```bash
git clone <url-del-repositorio> clock
cd clock
composer install
```

### 2. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

Configura en `.env` la base de datos y `APP_URL` (ej. `http://localhost:8000`).

### 3. Base de datos

Crea la base de datos en MySQL y luego:

```bash
php artisan migrate
php artisan db:seed
```

(O solo los seeders que necesites, por ejemplo `CountrySeeder`.)

### 4. Ejecutar la aplicación

Servidor de desarrollo incluido en PHP:

```bash
php artisan serve
```

La aplicación quedará disponible en `http://localhost:8000` (o la URL que tengas en `APP_URL`).

### 5. (Opcional) Enlace simbólico para archivos públicos

Si quieres servir archivos desde `storage/app/public` bajo la ruta `/storage`:

```bash
php artisan storage:link
```

### 6. Comandos Artisan propios

- **`make:time {time} {file}`** — Registra una imagen para un minuto concreto (ej. `php artisan make:time 1430 imagen.jpg`).
- **`time:load-all`** — Importa todas las imágenes desde `storage/app/download/` (archivos nombrados como `HHMM.jpg`).
- **`time:thumb`** — Genera miniaturas para las imágenes en `storage/app/times/`.
- **`time:location`** — Extrae coordenadas GPS de las imágenes originales y actualiza la base de datos.

---

## Despliegue en producción

### 1. Requisitos del servidor

- PHP 8.2+ con las extensiones indicadas.
- Composer instalado de forma global o en el servidor.
- MySQL (o base de datos soportada por Laravel) accesible desde la aplicación.
- Servidor web (Apache o Nginx) con document root apuntando a la carpeta `public` del proyecto.

### 2. Código y dependencias

```bash
git clone <url-del-repositorio> /ruta/del/proyecto
cd /ruta/del/proyecto
composer install --no-dev --optimize-autoloader
```

### 3. Configuración de entorno

```bash
cp .env.example .env
php artisan key:generate
```

En `.env` de producción:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL` con la URL pública real (ej. `https://tudominio.com`).
- Variables de base de datos correctas.

### 4. Base de datos

```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Permisos y caché

```bash
chmod -R 775 storage bootstrap/cache
# El usuario del servidor web debe poder escribir en storage y bootstrap/cache

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 6. Document root del servidor web

El punto de entrada debe ser la carpeta **`public`** del proyecto.

**Ejemplo Nginx:**

```nginx
root /ruta/del/proyecto/public;
index index.php;
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
}
```

**Ejemplo Apache** (con `mod_rewrite` y `AllowOverride All` en el directorio del proyecto):

El archivo `public/.htaccess` ya incluye las reglas necesarias para Laravel.

### 7. (Opcional) Enlace de almacenamiento

Si las imágenes deben servirse por la misma aplicación bajo `/storage`:

```bash
php artisan storage:link
```

### 8. Tareas posteriores al despliegue

- Ejecutar migraciones en futuras actualizaciones: `php artisan migrate --force`.
- Regenerar caché tras cambiar configuración: `php artisan config:cache`.
- Asegurar copias de seguridad de la base de datos y de `storage/app/times/` si son datos importantes.

---

## Rutas principales

| Ruta        | Descripción |
|------------|-------------|
| `/`        | Página principal (reloj + mapa) |
| `/list`    | Listado por horas |
| `/hour/{hr}` | Minutos de una hora |
| `/minute/{hr}/{mi}` | Imágenes de un minuto concreto |
| `/album`   | Vista álbum |
| `/map`     | Mapa con todas las ubicaciones |
| `/api/v1/time/{time}` | API JSON con datos de un minuto |

---

## Licencia

MIT (según `composer.json`).
