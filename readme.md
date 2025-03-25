
## Estructura del proyecto

📂 actions/
📂 archivos-compartidos/
│── 📄 index.php
📂 archivos-en-papelera/
│── 📄 index.php
📂 assets/
│── 📂 🎨 css/
│── 📂 🖼 imgs/
│── 📂 📜 js/
📂 auth/
│── 📄 index.php
📂 components/
│── 📄 files.php
│── 📄 footerJS.php
│── 📄 header.php
│── ......
📂 functions/
│── 📄 action_login.php
│── 📄 funciones.php
📂 settings/
│── 📄 auth.php
│── 📄 config.php
│── 📄 settingBD.php
📂 uploads/  
    # 📄 Aquí se almacenan los archivos subidos
📄 index.php




Sí, para manejar subcarpetas dentro de una carpeta principal, puedes modificar tu tabla tbl_drive_folders agregando una columna id_folder_padre, o puedes crear una nueva tabla para manejar la jerarquía.
Opción 1: Modificar tbl_drive_folders

Puedes agregar una columna id_folder_padre que permita relacionar carpetas con sus subcarpetas.

ALTER TABLE `tbl_drive_folders` 
ADD COLUMN `id_folder_padre` INT UNSIGNED DEFAULT NULL COMMENT 'ID de la carpeta padre, NULL si es una carpeta raíz';

Así, cuando crees una subcarpeta dentro de una carpeta principal, almacenarás el id_folder de la carpeta padre en id_folder_padre. Si id_folder_padre es NULL, significa que la carpeta es de nivel raíz.


WITH RECURSIVE subcarpetas AS (
    SELECT * FROM tbl_drive_folders WHERE id_folder = 11
    UNION ALL
    SELECT f.* FROM tbl_drive_folders f
    INNER JOIN subcarpetas s ON f.id_folder_padre = s.id_folder
)
SELECT * FROM subcarpetas;

