<?php
/**********************************************************************
 *  Author : Your Name (your-email@example.com)
 *  Web    : Your Website
 *  Name   : jShop v1.0
 *  Desc   : User Signup Script
 *
**********************************************************************/
// Include file headers
include_once './includes/validator.php';
include_once './includes/settings.php';
include_once './includes/db.php';

$_validator = new Validator();
$_validator->setMethod('POST');
$_validator->setVars(array('name:required', 'email:email', 'password:required', 'confirm_password:required'));

if ($_validator->validate()) {
    $values = $_validator->getValues();

    if ($values['password'] !== $values['confirm_password']) {
        header('Location: ./signup.php?id=' . base64_encode('2'));
        exit(0);
    }

    $users = $db->get_results("select * from usuarios where usuario_correo='" . $values['email'] . "'");
    if (count($users) != 0) {
        header('Location: ./signup.php?id=' . base64_encode('1'));
        exit(0);
    }

    $hashedPassword = password_hash($values['password'], PASSWORD_BCRYPT);

    $sql  = "insert into usuarios(usuario_nombre, usuario_correo, usuario_password, usuario_tipo) ";
    $sql .= "values('" . $values['name'] . "', '" . $values['email'] . "', '" . $hashedPassword . "', 0)";
    $db->query($sql);

    header('Location: ./login.php?id=' . base64_encode('3'));
} else {
    for ($err = '', $i = 0; $i < count($e = $_validator->getErrors()); $i++) {
        $err = $err . ";" . $e[$i]['field'];
    }
    for ($vals = '', $j = 0; $j < count($e = $_validator->getValues()); $j++) {
        $params = $_validator->getParams();
        $key = $params[$j];
        $vals = $vals . "&" . $key . "=" . $e[$key];
    }
    header('Location: ./signup.php?id=' . base64_encode('2') . '&tk=' . base64_encode($err) . $vals);
    exit(0);
}
?>
