#!/bin/bash

export $(grep -v '^#' .env | xargs)

fecha=$(date +"%d-%m-%Y_%H-%M")

nombre_zip="volumes_${fecha}.zip"

echo "$(date +"%H:%M:%S") - Comprimiendo, encriptando y guardando el backup localmente..."
zip -r -P $ZIP_PASSWORD "$nombre_zip" volumes > /dev/null 2>&1

mv "$nombre_zip" ./backups

echo "$(date +"%H:%M:%S") - Backup completado y archivo comprimido. Se ubica en la carpeta ./backups con el nombre $nombre_zip"

echo "$(date +"%H:%M:%S") - Cargando archivo a la nube... Esto puede tardar unos minutos."

rclone copy ./backups/"$nombre_zip" n:/backups-espaciodtcmas/ > /dev/null 2>&1

echo "$(date +"%H:%M:%S") - Archivo copiado a la nube con éxito."
