import cv2
import numpy as np
import matplotlib.pyplot as plt
import os

# ==============================
# RUTAS
# ==============================

RUTA_IMAGEN = "imagenes/cascada.jpg"
CARPETA_RESULTADOS = "resultados"

if not os.path.exists(CARPETA_RESULTADOS):
    os.makedirs(CARPETA_RESULTADOS)


# ==============================
# CARGAR IMAGEN
# ==============================

imagen_bgr = cv2.imread(RUTA_IMAGEN)

if imagen_bgr is None:
    print("Error: no se pudo cargar la imagen.")
    print("Verifica que exista:", RUTA_IMAGEN)
    exit()

# OpenCV carga en BGR, convertimos a RGB
imagen = cv2.cvtColor(imagen_bgr, cv2.COLOR_BGR2RGB)

# Redimensionar si es muy grande
alto, ancho, canales = imagen.shape
max_ancho = 600

if ancho > max_ancho:
    escala = max_ancho / ancho
    nuevo_ancho = int(ancho * escala)
    nuevo_alto = int(alto * escala)
    imagen = cv2.resize(imagen, (nuevo_ancho, nuevo_alto))

alto, ancho, canales = imagen.shape


# ==============================
# FILTRO DE SUAVIZADO 3x3
# ==============================

def filtro_suavizado_3x3(imagen):
    alto, ancho, canales = imagen.shape
    salida = np.zeros_like(imagen)

    for y in range(alto):
        for x in range(ancho):
            suma_r = 0
            suma_g = 0
            suma_b = 0
            contador = 0

            # Ventana 3x3 alrededor del píxel
            for dy in range(-1, 2):
                for dx in range(-1, 2):
                    ny = y + dy
                    nx = x + dx

                    if 0 <= ny < alto and 0 <= nx < ancho:
                        r, g, b = imagen[ny, nx]

                        suma_r += int(r)
                        suma_g += int(g)
                        suma_b += int(b)

                        contador += 1

            salida[y, x, 0] = suma_r // contador
            salida[y, x, 1] = suma_g // contador
            salida[y, x, 2] = suma_b // contador

    return salida


# ==============================
# CLASIFICACIÓN DE TEXTURAS
# ==============================

def clasificar_texturas(imagen):
    alto, ancho, canales = imagen.shape
    salida = np.zeros_like(imagen)

    contador_cesped = 0
    contador_tierra = 0
    contador_cemento = 0
    contador_asfalto = 0

    for y in range(alto):
        for x in range(ancho):
            r = int(imagen[y, x, 0])
            g = int(imagen[y, x, 1])
            b = int(imagen[y, x, 2])

            brillo = (r + g + b) / 3

            diferencia_rg = abs(r - g)
            diferencia_rb = abs(r - b)
            diferencia_gb = abs(g - b)

            # Césped / vegetación
            if g > r * 1.12 and g > b * 1.12:
                salida[y, x] = [40, 160, 60]
                contador_cesped += 1

            # Asfalto / sombra
            elif brillo < 85:
                salida[y, x] = [45, 45, 45]
                contador_asfalto += 1

            # Tierra: tonos marrones, amarillentos o rojizos
            elif r > 80 and g > 45 and b < 140 and r > b * 1.10:
                salida[y, x] = [150, 90, 45]
                contador_tierra += 1

            # Cemento / superficie clara o grisácea
            elif diferencia_rg < 45 and diferencia_rb < 45 and diferencia_gb < 45:
                salida[y, x] = [170, 170, 170]
                contador_cemento += 1

            # Por defecto: superficie clara similar a cemento
            else:
                salida[y, x] = [170, 170, 170]
                contador_cemento += 1

    total_pixeles = alto * ancho

    porcentajes = {
        "Césped / vegetación": (contador_cesped / total_pixeles) * 100,
        "Tierra": (contador_tierra / total_pixeles) * 100,
        "Cemento / superficie clara": (contador_cemento / total_pixeles) * 100,
        "Asfalto / sombra": (contador_asfalto / total_pixeles) * 100
    }

    return salida, porcentajes



# ==============================
# PROCESAR IMAGEN
# ==============================

imagen_suavizada = filtro_suavizado_3x3(imagen)
imagen_clasificada, porcentajes = clasificar_texturas(imagen)


# ==============================
# GUARDAR RESULTADOS
# ==============================

cv2.imwrite(
    os.path.join(CARPETA_RESULTADOS, "imagen_original.jpg"),
    cv2.cvtColor(imagen, cv2.COLOR_RGB2BGR)
)

cv2.imwrite(
    os.path.join(CARPETA_RESULTADOS, "imagen_suavizada_3x3.jpg"),
    cv2.cvtColor(imagen_suavizada, cv2.COLOR_RGB2BGR)
)

cv2.imwrite(
    os.path.join(CARPETA_RESULTADOS, "imagen_clasificada_texturas.jpg"),
    cv2.cvtColor(imagen_clasificada, cv2.COLOR_RGB2BGR)
)


# ==============================
# MOSTRAR PORCENTAJES
# ==============================

print("\nRESULTADOS DE CLASIFICACIÓN")
print("---------------------------")

for textura, porcentaje in porcentajes.items():
    print(f"{textura}: {porcentaje:.2f}%")


# ==============================
# MOSTRAR IMÁGENES
# ==============================

plt.figure(figsize=(14, 6))

plt.subplot(1, 3, 1)
plt.imshow(imagen)
plt.title("Imagen original")
plt.axis("off")

plt.subplot(1, 3, 2)
plt.imshow(imagen_suavizada)
plt.title("Filtro suavizado 3x3")
plt.axis("off")

plt.subplot(1, 3, 3)
plt.imshow(imagen_clasificada)
plt.title("Clasificación de texturas")
plt.axis("off")

plt.tight_layout()
plt.show()