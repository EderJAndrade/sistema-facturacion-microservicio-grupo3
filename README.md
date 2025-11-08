# Sistema de Facturación Microservicio - Grupo 3

Proyecto desarrollado en **Laravel 12** como parte de la materia **Arquitectura de Software**. Implementa un **microservicio RESTful** para la gestión de clientes del sistema de facturación, utilizando el patrón **Modelo-Vista-Controlador (MVC)** y autenticación con **Laravel Sanctum**.

---

## Objetivo del Proyecto

Desarrollar un microservicio que gestione los clientes de un sistema de facturación mediante una API RESTful, con operaciones CRUD protegidas y validaciones de datos.

---

## Requerimientos Previos

Antes de ejecutar el proyecto tener instalado: 
- PHP 8.2.12
- Composer
- Laravel 12
- XAMPP 8.2.12 (MySQL)
- Node.js
- Postman (Pruebas de la API).

---

## Configuración del API

Laravel 12 incluye Laravel Sanctum por defecto mediante el comando:  
- php artisan install:api  

Esto crea automáticamente las configuraciones necesarias para la autenticación por tokens y las rutas iniciales para el microservicio.

En la pregunta:
-  One new database migration has been published. Would you like to run all pending database migrations?
Responder: **yes**

Luego se creó el controlador y las solicitudes:
- php artisan make:controller Api/ClienteController --api --model=Cliente
- php artisan make:request StoreClienteRequest
- php artisan make:request UpdateClienteRequest

**Importante**
Solo ejecutar esos comandos si se crea un proyecto desde cero, si se clona desde el repsitorio de GitHub no es necesario ejecutarlos.

---

## Instalación del Proyecto

1. Clonar el repositorio desde GitHub:
    - git clone https://github.com/EderJAndrade/sistema-facturacion-microservicio-grupo3.git

2. Ingresar al directorio del proyecto:
    - cd sistema-facturacion-microservicio-grupo3

3. Instalar las dependencias de Laravel:
    - composer install

4. Copiar el archivo de entorno y configurarlo:
    - cp .env.example .env

5. Generar la clave de aplicación:
    - php artisan key:generate

---

## Configuración de la Base de Datos

1. Crear la base de datos en MySQL:
    - CREATE DATABASE IF NOT EXISTS sistema_facturacion_microservicio_grupo3 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    - CREATE USER IF NOT EXISTS 'micro_g3_user'@'localhost' IDENTIFIED BY 'Gr3Micro!';
    - GRANT ALL PRIVILEGES ON sistema_facturacion_microservicio_grupo3.* TO 'micro_g3_user'@'localhost';
    - FLUSH PRIVILEGES;

2. En el archivo .env configurar la conexión:
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=sistema_facturacion_microservicio_grupo3
    - DB_USERNAME=micro_g3_user
    - DB_PASSWORD=Gr3Micro!

---

## Migraciones

Ejecutar las migraciones con:
- php artisan migrate:fresh --seed  

Este comando limpia y vuelve a crear todas las tablas.

---

## Estructura del Proyecto

app/Http/Controllers/Api
- ClienteController.php

app/Http/Requests
- StoreClienteRequest.php
- UpdateClienteRequest.php

app/Models/  
- Cliente.php

database/migrations/  
- create_clientes_table.php
- create_personal_access_tokens_table.php

routes/
- api.php

---

## Endpoints Principales (API Clientes)

Iniciar el proyecto con el comando:
- php artisan serve

**En Postman**

**Crear un nuevo cliente**
- **POST** /api/clientes
*Headers*
- Accept: application/json
*Body - raw - JSON*

{
    "nombre": "Eder Andrade",
    "email": "ederandrade@grupo3.com",
    "password": "1234567890",
    "ruc": "1234567890001",
    "telefono": "0987654321",
    "direccion": "Quito, Ecuador",
    "tipo_cliente": "Individual",
    "limite_credito": 500.00
}

**Iniciar Sesión**
- **POST** /api/login
*Body - raw - JSON*

{
    "email": "ederandrade@grupo3.com",
    "password": "1234567890"
}

Devuelve el token de autorización

**Listar todos los clientes**
- **GET** /api/clientes
*Authorization*
- Type: Bearer Token
- Token: "Pegar el token generado en el login"
*Headers*
- Accept: application/json

Para mostrar un cliente específico usar:
- /api/clientes/{id}

**Actualizar un cliente**
- **PUT** /api/clientes/{id}
*Authorization*
- Type: Bearer Token
- Token: Pegar el token generado en el login
*Headers*
- Accept: application/json
*Body - raw - JSON*

{
    "limite_credito": 1000,
    "direccion": "Sangolquí, Ecuador",
    "tipo_cliente": "Empresa"
}

**Eliminar un cliente**
- **DELETE** /api/clientes/{id}
*Authorization*
- Type: Bearer Token
- Token: Pegar el token generado en el login
*Headers*
- Accept: application/json

**Reemplazar {id} por el número correspondiente**
Por ejemplo: /api/clientes/1

---

## Validaciones Personalizadas

Los archivos **StoreClienteRequest** y **UpdateClienteRequest** contienen las reglas de validación y los mensajes personalizados, por ejemplo:
- “El campo correo electrónico debe tener un formato válido.”
- “El nombre es obligatorio.”
- “La contraseña debe tener al menos 6 caracteres.”

---

## Autores

**Universidad de las Fuerzas Armadas ESPE** 

**Grupo 3 - Arquitectura de Software**  
- Aguilar Mijas Laura Estefanía  
- Andrade Alvarado Eder Jonathan  
- Bucay Pallango Carlos Avelino  
- Cisneros Cárdenas Freddy Gabriel  
- Pita Clemente Karina Annabel   

Docente: *Vilmer David Criollo Chanchicocha*  

**2025**