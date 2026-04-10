# Sistema de Gestión de Ponencias

## Descripción del Proyecto
El Sistema de Gestión de Ponencias es una solución web diseñada para facilitar el manejo de eventos académicos, tales como conferencias y talleres, donde se presentan ponencias. Este sistema permite a los usuarios gestionar las distintas etapas de una ponencia, desde el registro hasta la asignación de evaluadores y la publicación de resultados.

## Características Principales
- **Registro de Usuarios:** Permite el registro de diferentes tipos de participantes, incluidos conferencistas, coautores, asistentes y evaluadores.
- **Gestión de Ponencias:** Los usuarios pueden enviar resúmenes y documentos completos de sus ponencias para revisión.
- **Evaluación de Ponencias:** Asigna evaluadores a cada ponencia y recopila retroalimentación y calificaciones.
- **Panel de Administración:** Proporciona a los administradores herramientas para hacer un seguimiento de todas las actividades del evento.
- **Multilenguaje:** Actualmente soporta español.

## Estructura del Proyecto
- **index.php:** Página de inicio del sistema donde los usuarios pueden iniciar sesión o registrarse.
- **adminpanel.php:** Panel de control para que los administradores gestionen usuarios y ponencias.
- **register.php:** Formulario de registro para nuevos usuarios.
- **login.php:** Módulo para el inicio de sesión de usuarios.

## Requisitos del Sistema
- **Servidor Web:** Apache o Nginx
- **PHP:** Versión 7.4 o superior
- **Base de Datos:** MySQL

## Configuración
1. Clone o descargue el repositorio en su servidor web.
2. Importe el esquema de la base de datos desde el archivo `db/schema.sql`.
3. Configure los detalles de la base de datos en el archivo `includes/config.php`.
4. Asegúrese de que las extensiones de PHP necesarias están habilitadas.

## Notas de Uso
- Este sistema está diseñado para ser intuitivo y fácil de usar tanto para administradores como para participantes del evento.
- Para soporte técnico, contacte al desarrollador principal, Sergio Cerón Figueroa, a través de sxceron@laciudadx.com.

