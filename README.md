# Freelancer Manager

Este proyecto es un sistema de gestión de proyectos para freelancers, donde los usuarios pueden registrarse, iniciar sesión, crear y administrar proyectos, así como subir archivos relacionados.

## Tecnologías utilizadas

- **Backend**: PHP (usando patrón MVC, PDO)
- **Frontend**: Angular 15+
- **Base de datos**: MySQL
- **Autenticación**: JWT

## Estructura del proyecto

```
freelancer-manager
├── backend
│   ├── src
│   │   ├── config
│   │   ├── controllers
│   │   ├── models
│   │   ├── middleware
│   │   └── uploads
├── frontend
│   ├── src
│   │   ├── app
│   │   ├── assets
│   │   └── environments
├── docker
│   ├── php
│   ├── mysql
│   └── nginx
├── docker-compose.yml
└── README.md
```

## Instalación

1. Clona el repositorio.
2. Navega a la carpeta del proyecto.
3. Ejecuta `docker-compose up` para levantar los contenedores.

## Uso

- **Registro**: Los usuarios pueden registrarse proporcionando su nombre, email y contraseña.
- **Inicio de sesión**: Los usuarios pueden iniciar sesión utilizando su email y contraseña.
- **Gestión de proyectos**: Los usuarios pueden crear, ver, editar y eliminar proyectos.
- **Manejo de archivos**: Los usuarios pueden subir, descargar y eliminar archivos relacionados con sus proyectos.
