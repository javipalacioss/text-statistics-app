# 📝 Text Statistics App

Una aplicación web que permite introducir texto y obtener estadísticas sobre las palabras utilizadas, mostrando la frecuencia de aparición, excluyendo palabras vacías ("stopwords") y signos de puntuación.

## 🚀 Tecnologías utilizadas

- **Frontend:** HTML + Bootstrap 5
- **Backend:** PHP
- **Control de versiones:** Git (rama main/develop + ramas funcionales)

## 🎯 Funcionalidad

- Ingreso de texto desde el navegador.
- El texto se envía al servidor mediante `fetch` (`POST`).
- El servidor:
  - Elimina puntuación.
  - Convierte a minúsculas (case insensitive).
  - Elimina **stopwords** (lista en `stopwords.txt`).
  - Cuenta y ordena por frecuencia.
- El frontend muestra una lista ordenada de palabras y su número de apariciones.

## 📁 Estructura del proyecto
text-statistics-app/
├── backend/
│ ├── index.php
│ ├── stopwords.txt
├── frontend/
│ ├── index.html
│ ├── style.css
├── README.md

## 🧪 Cómo probar la app en local

### Opción 1: Desde el navegador

1. Inicia el servidor PHP desde la carpeta `/backend`:
   cd backend
   php -S localhost:8000

Abre frontend/index.html en tu navegador.

⚠️ El backend debe estar ejecutándose en localhost:8000

### Opción 2: Desde la terminal con curl (tener inicido localhost --> php -S localhost:8000)

curl -X POST -H "Content-Type: application/json" -d "{\"text\":\"Hola hola mundo Mundo MuNdO y este es un ejemplo Y y estamos PrObandO.\"}" http://localhost:8000/index.php

El comando de arriba va con barras pero github es tan bueno que me las quita automaticamente, grande Github

![image](https://github.com/user-attachments/assets/3a8af0ee-e904-48de-971f-5bd3ddc15654)

