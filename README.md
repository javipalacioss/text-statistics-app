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

![image](https://github.com/user-attachments/assets/acd71098-50f6-4e3b-b2bc-a53b6a422edc)

⚠️ El backend debe estar ejecutándose en localhost:8000

### Opción 2: Desde la terminal con curl (tener inicido localhost --> php -S localhost:8000)

curl -X POST -H "Content-Type: application/json" -d "{\"text\":\"Hola hola mundo Mundo MuNdO y este es un ejemplo Y y estamos PrObandO.\"}" http://localhost:8000/index.php

El comando de arriba va con barras pero github es tan bueno que me las quita automaticamente, grande Github

![image](https://github.com/user-attachments/assets/3a8af0ee-e904-48de-971f-5bd3ddc15654)

## ✅ Testing y Calidad de Código

- Se han implementado pruebas unitarias con **PHPUnit** que cubren entre el **80% y 90% del código**.  
- Las pruebas garantizan que cada módulo funciona de forma independiente y correcta.  
- Se usa un **hook de Git pre-push** que ejecuta automáticamente los tests antes de permitir subir cambios al repositorio.  
- Si algún test falla, el push se cancela y muestra un mensaje de error, evitando introducir código con errores en el repositorio.

## 🛠️ Uso del Hook pre-push

- El hook está ubicado en `.git/hooks/pre-push` y está escrito en PHP.  
- Al hacer `git push`, se ejecutan los tests automáticamente:  
  - Si todos pasan, el push se realiza con normalidad.  
  - Si algún test falla, muestra un mensaje de error y cancela el push.  
- Esto asegura que solo código probado y estable llega a las ramas principales (`develop` y `main`).

## 📋 Buenas Prácticas de Git

- Se trabaja con ramas `main` (estable), `develop` (desarrollo) y ramas funcionales para nuevas características.  
- No se hacen commits directamente en `main`.  
- Se realizan commits pequeños y frecuentes con mensajes claros que resumen los cambios.  
- Antes de hacer push, siempre se actualiza la rama local con `git pull`.  

## 🚀 Despliegue y Desarrollo Futuro

- La app está preparada para ser desplegada en cualquier servidor con PHP.  
- Se pueden añadir más funcionalidades y tests para ampliar la aplicación.  
- El workflow con Git y los hooks automatizan la calidad y estabilidad del código. 