**HinchadasRank** es una plataforma interactiva de entretenimiento diseñada para medir la pasión futbolera. A través de un sistema de duelos dinámicos, los usuarios votan para determinar cuál es la hinchada más grande. Es un proyecto desarrollado de forma independiente, enfocado en la escalabilidad y la experiencia de usuario.

## 🚀 Características principales
- **Sistema de Duelos Aleatorios:** Algoritmo que empareja equipos de forma dinámica para votación directa.
- **Ranking Global:** Tabla de posiciones actualizada en tiempo real según el volumen de votos.
- **Arquitectura Escalable:** Desarrollado bajo el patrón MVC para facilitar la implementación de futuras funcionalidades.
- **Votación Asíncrona:** Uso de **Fetch API** para una experiencia fluida sin recargas de página.
- **Panel de Control Pro:** Gestión total de equipos, imágenes y datos desde un backend privado.

## 🛠️ Stack Tecnológico
- **Backend:** PHP (PDO & MySQL).
- **Frontend:** JavaScript (ES6+), HTML5, CSS3.
- **Servidor:** Entorno Apache (XAMPP).

## 📂 Estructura del Sistema
```text
HinchadasRank/
├── app/
│   ├── controllers/    # Lógica de negocio y ruteo
│   ├── models/         # Gestión de datos y persistencia
│   └── views/          # Interfaz de usuario
├── db/
│   └── hinchadas.sql   # Estructura de la base de datos
├── img/                # Assets visuales (Escudos y Fotos)
├── js/                 # Motores de votación y efectos
├── config.php          # Variables de entorno y configuración
└── router.php          # Gestión de URLs amigables
```

## 🔧 Setup Local

1. Clonar proyecto:

```bash
git clone https://github.com/TuUsuario/HinchadasRank.git
```


2. Servidor:

- Alojar en la carpeta raíz de tu servidor local (ej: htdocs).

- Asegurar que el puerto de MySQL esté configurado correctamente en config.php.

3. Base de Datos:

- Crear base de datos db_hinchadas.

- Importar db/hinchadas.sql.

## 👤 Desarrollador

Thiago Gonnet - TG Informática y Reparaciones
