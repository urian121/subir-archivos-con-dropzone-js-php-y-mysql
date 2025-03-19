<?php
date_default_timezone_set("America/Bogota");
$sesion_desde_user   = date("Y-m-d H:i:A");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('../settings/config.php');
    include_once(SETTINGS_BD);

    $table = 'tbl_users';
    $action = $_POST['action'] ?? null;

    if ($_POST["action"] == "login_user") {
        $email = filter_var($_REQUEST['email_user'], FILTER_SANITIZE_EMAIL);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_user     = ($_REQUEST['email_user']);
        }

        // Sanitizar y validar la contraseña
        $password_user = trim($_POST['password_user']);
        if (empty($password_user)) {
            header("Location: " . BASE_HOME . '?b=2');
            exit();
        }


        $sqlVerificandoLogin = ("SELECT 
                id_user, name_user,
                email_user, password_user
            FROM $table 
            WHERE email_user 
            COLLATE utf8_bin='$email_user' AND estatus_user=1");
        $query = $servidor->query($sqlVerificandoLogin);
        if ($query->num_rows > 0) {
            while ($rowData  = mysqli_fetch_assoc($query)) {
                $passwordBD = $rowData['password_user'];

                if (password_verify($password_user, $passwordBD)) {
                    session_start();
                    $_SESSION['id_user']     = $rowData['id_user'];
                    $_SESSION['name_user']   = $rowData['name_user'];
                    $_SESSION['email_user']  = $rowData['email_user'];

                    $Update = ("UPDATE $table SET sesion_desde_user='$sesion_desde_user' WHERE email_user='$email_user'");
                    $servidor->query($Update) or die("Error al actualizar:" . mysqli_error($servidor));
                    header("Location: " . BASE_HOME . 'index.php?welcome=1');
                    exit();
                } else {
                    header("Location: " . BASE_HOME . 'index.php?b=1');  // Contraseña incorrecta
                    exit();
                }
            }
        } else {
            header("Location: " . BASE_HOME . '?b=1'); // Usuario no encontrado o inactivo
            exit();
        }
    } elseif ($action == "login_estudiante") {
        $password_user = trim($_POST['password_user']);
        if (empty($password_user)) {
            header("Location: " . BASE_HOME . '?b=2');
            exit();
        }


        $sqlVerificandoLogin = ("SELECT 
                id_user, name_user,
                email_user, password_user
            FROM $table 
            WHERE email_user 
            COLLATE utf8_bin='$email_user' AND estatus_user=1");
        $query = $servidor->query($sqlVerificandoLogin);
        if ($query->num_rows > 0) {
            while ($rowData  = mysqli_fetch_assoc($query)) {
                $passwordBD = $rowData['password_user'];

                if (password_verify($password_user, $passwordBD)) {
                    session_start();
                    $_SESSION['id_user']     = $rowData['id_user'];
                    $_SESSION['name_user']   = $rowData['name_user'];
                    $_SESSION['email_user']  = $rowData['email_user'];
                    $Update = ("UPDATE $table SET sesion_desde_user='$sesion_desde_user' WHERE email_user='$email_user'");
                    $servidor->query($Update) or die("Error al actualizar:" . mysqli_error($servidor));
                    header("Location: " . BASE_HOME . 'index.php?welcome=1');
                    exit();
                } else {
                    header("Location: " . BASE_HOME . '?b=1');  // Contraseña incorrecta
                    exit();
                }
            }
        } else {
            header("Location: " . BASE_HOME . '?b=1'); // Usuario no encontrado o inactivo
            exit();
        }
    } elseif ($action == "addUser") {
        $name_user = trim($_POST['name_user']);
        $email_user = trim($_POST['email_user']);
        $password_user = trim($_POST['password_user']);

        $PasswordHash      = password_hash($password_user, PASSWORD_BCRYPT);

        $SqlVerificandoEmail = ("SELECT email_user FROM $table WHERE email_user COLLATE utf8_bin='$email_user'");
        $query = $servidor->query($SqlVerificandoEmail);
        if ($query->num_rows > 0) {
            header("Location:" . BASE_HOME . '?errorC=1');
            exit();
        } else {
            $queryInsertUser  = ("INSERT INTO $table (name_user, email_user, password_user) VALUES ('$name_user', '$email_user', '$PasswordHash')");
            if ($servidor->query($queryInsertUser) === TRUE) {
                header("Location:" . BASE_HOME . '?successC=1');
                exit();
            } else {
                header("Location:" . BASE_HOME . '?errorC=1');
                exit();
            }
        }
    } elseif ($action == "update_user") {
        // Obtener y sanitizar los datos del formulario
        $id_user = trim($_POST['id_user']);
        $name_user = trim($_POST['name_user']);
        $email_user = trim($_POST['email_user']);
        $password_user = trim($_POST['password_user']);
        $new_password_user = trim($_POST['new_password_user']);

        $actualizarPassword = false;

        // Verificar si se ha enviado una nueva contraseña
        if ($password_user && $new_password_user) {
            // Consultar la contraseña actual en la base de datos
            $sqlPassword = "SELECT password_user FROM $table WHERE email_user COLLATE utf8_bin = '$email_user' AND estatus_user = 1";
            $resultado = $servidor->query($sqlPassword);

            if ($resultado && $resultado->num_rows > 0) {
                $passwordBD = $resultado->fetch_assoc()['password_user'];
                // Verificar que la contraseña actual coincide
                if (password_verify($password_user, $passwordBD)) {
                    $actualizarPassword = true;
                } else {
                    header("Location: ../");
                    exit();
                }
            }
        }

        // Construir la consulta de actualización
        $sql = "UPDATE $table SET name_user = '$name_user', email_user = '$email_user'";
        if ($actualizarPassword) {
            $PasswordHash = password_hash($new_password_user, PASSWORD_BCRYPT);
            $sql .= ", password_user = '$PasswordHash'";
        }
        $sql .= " WHERE id_user = '$id_user'";

        // Ejecutar la consulta de actualización
        if ($servidor->query($sql) === TRUE) {
            header("Location:" . BASE_HOME);
        } else {
            header("Location:" . BASE_HOME);
        }
        exit();
    }
}