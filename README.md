# HinchadasRank ⚽

**HinchadasRank** es una aplicación web interactiva diseñada para determinar cuál es la hinchada más popular mediante un sistema de duelos y votación en tiempo real. Este proyecto fue desarrollado como parte de la formación académica en la **Tecnicatura Universitaria en Desarrollo de Aplicaciones Informáticas (TUDAI)** de la UNICEN.

## 🚀 Características
- **Duelos Aleatorios:** Sistema que selecciona dos equipos al azar para que el usuario vote por su favorito.
- **Ranking en Tiempo Real:** Visualización dinámica de los equipos ordenados por cantidad de votos.
- **Gestión de Contenido (CRUD):** Interfaz segura para que el administrador pueda agregar, editar o eliminar equipos.
- **Autenticación Segura:** Sistema de login para administradores con manejo de sesiones.
- **Arquitectura MVC:** Código organizado bajo el patrón Modelo-Vista-Controlador.
- **Votación Ágil:** Implementación de **Fetch API** para procesar los votos sin recargar la página.

## 🛠️ Tecnologías utilizadas
- **Backend:** PHP (PDO para acceso a datos).
- **Base de Datos:** MySQL / MariaDB.
- **Frontend:** HTML5, CSS3 y JavaScript (Fetch API).
- **Servidor:** XAMPP / Apache.

## 📂 Estructura del Proyecto
```text
HinchadasRank/
├── app/
│   ├── controllers/    # Lógica de control y ruteo
│   ├── models/         # Consultas a la base de datos (PDO)
│   └── views/          # Plantillas de visualización (PHTML)
├── db/
│   └── hinchadas.sql   # Script de creación de tablas y datos iniciales
├── img/                # Recursos visuales
│   ├── escudos/        # Escudos de los clubes
│   └── fotoshinchadas/ # Fotos de las hinchadas (ej: boca.jpg, river.jpg)
├── js/                 # Lógica de frontend y manejo de votos
├── css/                # Estilos del sitio
├── config.php          # Configuración general y credenciales de BD
└── router.php          # Manejador de rutas del sistema
