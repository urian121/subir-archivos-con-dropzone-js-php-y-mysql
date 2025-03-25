Driver - Sistema de Almacenamiento en la Nube

## Descripción
**Driver** es una aplicación web similar a Google Drive, desarrollada con PHP, MySQL y JavaScript. Permite a los usuarios almacenar, organizar y compartir archivos en la nube de manera sencilla y eficiente.

## Características principales
- **Gestión de archivos**: Subida, descarga y organización de archivos.
- **Sistema de carpetas**: Creación y navegación por estructura de carpetas.
- **Papelera de reciclaje**: Recuperación de archivos eliminados.
- **Compartir archivos**: Funcionalidad para compartir contenido con otros usuarios.
- **Autenticación de usuarios**: Sistema de registro e inicio de sesión.

## Tecnologías utilizadas
- **PHP** (Backend)
- **MySQL** (Base de datos)
- **JavaScript** (Frontend)
- **HTML/CSS** (Estructura y estilos)
- **Bootstrap** (Framework para el front)

## Estructura del proyecto
El proyecto sigue una arquitectura modular con carpetas dedicadas a:
- Acciones específicas.
- Componentes de interfaz.
- Funciones de autenticación.

## Instalación
Sigue estos pasos para instalar y ejecutar el proyecto:

1. Clona este repositorio:
   ```bash
   git clone https://github.com/usuario/driver.git
   ```

2. Configura un servidor web con soporte para PHP y MySQL (por ejemplo, XAMPP o Laragon).

3. Importa la base de datos:
   - Encuentra el archivo `database.sql` en la carpeta raíz del proyecto.
   - Usa phpMyAdmin o una herramienta similar para importar este archivo en tu servidor MySQL.

4. Configura el archivo de conexión a la base de datos:
   - Edita el archivo `config/database.php` con las credenciales de tu servidor MySQL.

5. Inicia el servidor web y accede a la aplicación desde tu navegador en `http://localhost/driver`.

## Ejemplo de uso
1. Regístrate o inicia sesión en la aplicación.
2. Sube archivos desde tu dispositivo.
3. Organiza tus archivos en carpetas.
4. Comparte archivos con otros usuarios mediante enlaces.