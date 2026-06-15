# Proyecto Multimedia Final

Plataforma web multimedia desarrollada para integrar diferentes módulos de digitalización, procesamiento de imágenes, animación, producción audiovisual y fotogrametría.

El proyecto fue desarrollado utilizando tecnologías web, programación en PHP, almacenamiento en JSON, scripts en Python, Unity WebGL, Google Colab y COLMAP.

---

## Módulos del proyecto

El proyecto integra los siguientes módulos principales:

1. **Workflow PHP + JSON**
2. **Animación Unity WebGL**
3. **Procesamiento de Imágenes**
4. **Cover Multimedia Vaca Lola**
5. **Fotogrametría COLMAP**

La plataforma principal permite acceder a todos los módulos desde una interfaz web desarrollada en HTML y CSS.

---

## 1. Plataforma principal

La plataforma principal funciona como menú integrador del proyecto. Desde esta página se puede acceder a todos los módulos desarrollados.

**Ruta principal en localhost:**

```text
http://localhost/plataforma_multimedia/
```

La plataforma contiene tarjetas de acceso para:

* Workflow PHP + JSON
* Animación Unity WebGL
* Procesamiento de Imágenes
* Cover Vaca Lola
* Fotogrametría COLMAP

---

## 2. Workflow PHP + JSON

Este módulo corresponde a la digitalización de trámites universitarios. Permite registrar, consultar, actualizar, revisar, aprobar, rechazar y anular trámites.

Los trámites implementados son:

* Certificado de Notas
* Inscripción de Materias

El flujo está dividido en etapas:

* P1: Registro de solicitud o inscripción
* P2: Presentación de documentos
* P3: Revisión académica
* P4: Resultado final

El sistema no utiliza una base de datos tradicional. La información se almacena en archivos JSON.

**Archivos JSON utilizados:**

```text
flujoproceso.json
tramites.json
seguimiento.json
usuarios.json
```

**Ruta en localhost:**

```text
http://localhost/proyecto_multimedia/
```

---

## 3. Animación Unity WebGL

Este módulo presenta una escena 3D desarrollada en Unity. Los personajes fueron generados mediante código C# y realizan una coreografía sincronizada con una pista de audio.

La escena fue exportada a WebGL para poder ejecutarse desde el navegador.

**Características principales:**

* Personajes 3D simples generados por código.
* Movimiento sincronizado con música.
* Escenario con luces y fondo.
* Exportación a WebGL.
* Integración dentro de la plataforma web.

**Ruta en localhost:**

```text
http://localhost/plataforma_multimedia/unity_final/index.html
```

---

## 4. Procesamiento de Imágenes

Este módulo fue desarrollado con Python y permite aplicar operaciones básicas de procesamiento digital de imágenes.

Se implementaron dos procesos principales:

### Filtro de suavizado 3x3

El filtro recorre cada píxel de la imagen y calcula el promedio de los valores RGB de sus vecinos dentro de una ventana de 3x3 píxeles. Este proceso reduce el ruido visual y suaviza las transiciones de color.

### Clasificación de texturas

La clasificación analiza los valores RGB y el brillo de cada píxel para identificar superficies como:

* Césped / vegetación
* Tierra
* Cemento / superficie clara
* Asfalto / sombra

**Herramientas utilizadas:**

* Python
* OpenCV
* NumPy
* Matplotlib

**Ruta en localhost:**

```text
http://localhost/procesamiento_imagenes/
```

---

## 5. Cover Multimedia Vaca Lola

Este módulo presenta una producción multimedia generada en Google Colab utilizando Python.

El proyecto vincula audio con animación. La intensidad del audio modifica el movimiento de los personajes, luces y elementos visuales.

**Herramientas utilizadas:**

* Google Colab
* Python
* MoviePy
* Pillow
* NumPy

**Resultado:**

* Video MP4 con audio.
* Animación sincronizada.
* Escenario visual con personaje central y monigotes.

**Ruta en localhost:**

```text
http://localhost/cover_vaca_lola/
```

---

## 6. Fotogrametría COLMAP

Este módulo presenta el proceso de reconstrucción tridimensional de un integrante mediante múltiples fotografías procesadas con COLMAP.

El proceso realizado fue:

1. Captura de múltiples fotografías alrededor del integrante.
2. Carga de imágenes en COLMAP.
3. Extracción de características visuales.
4. Emparejamiento de puntos entre fotografías.
5. Cálculo de la posición de las cámaras.
6. Generación de nube de puntos.
7. Reconstrucción densa.
8. Exportación de archivos PLY.

**Archivos generados:**

```text
fused.ply
meshed-poisson.ply
```

El resultado obtenido corresponde a una reconstrucción tridimensional parcial. La calidad del modelo depende de factores como iluminación, nitidez de las imágenes, estabilidad de la persona y textura del fondo.

**Ruta en localhost:**

```text
http://localhost/fotogrametria_avatar/
```

---

## Herramientas utilizadas

* HTML
* CSS
* JavaScript
* PHP
* JSON
* Python
* OpenCV
* NumPy
* Matplotlib
* MoviePy
* Pillow
* Unity
* C#
* WebGL
* Google Colab
* COLMAP
* XAMPP
* GitHub

---

## Estructura del repositorio

```text
proyecto-multimedia-final
├── plataforma_multimedia
├── proyecto_multimedia
├── procesamiento_imagenes
├── cover_vaca_lola
├── fotogrametria_avatar
└── README.md
```

---

## Ejecución del proyecto

Para ejecutar el proyecto localmente:

1. Instalar XAMPP.
2. Copiar las carpetas del proyecto dentro de:

```text
C:\xampp\htdocs
```

3. Iniciar Apache desde el panel de XAMPP.
4. Abrir en el navegador:

```text
http://localhost/plataforma_multimedia/
```

Desde la plataforma principal se puede acceder a todos los módulos.

---

## Descripción técnica general

El proyecto integra diferentes áreas del desarrollo multimedia. El workflow utiliza PHP y JSON para simular un proceso BPM de trámites universitarios. El procesamiento de imágenes trabaja a nivel de píxel usando Python. La animación 3D fue desarrollada en Unity y exportada a WebGL. El cover multimedia fue generado en Google Colab mediante Python y librerías de video. Finalmente, la fotogrametría fue realizada con COLMAP para obtener una reconstrucción tridimensional parcial.

---

## Conclusión

El proyecto cumple con la integración de módulos multimedia solicitados: digitalización de procesos, almacenamiento dinámico, procesamiento de imágenes, animación 3D, producción audiovisual y fotogrametría. La plataforma web permite centralizar todos los resultados y acceder a cada módulo desde un mismo entorno.
