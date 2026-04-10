<?php
include_once './includes/validator.php';
include_once './includes/settings.php';
include_once './includes/db.php';

$signupError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_validator = new Validator();
    $_validator->setMethod('POST');
    $_validator->setVars(array(
        'name:required',
        'last:required',
        'email:email',
        'password:required',
        'user:required',
        'institution:required',
        'type:required'
    ));

    $valid = $_validator->validate();
    $values = $_validator->getValues();

    if ($valid) {
        $users = $db->get_results("select * from usuarios where usuario_alias='" . $values['user'] . "'");
        if (count($users) != 0) {
            $signupError = 'Username already exists.';
        } else {
            $sql = "insert into usuarios(usuario_nombre, usuario_apellidos, usuario_correo, usuario_telefono, usuario_alias, usuario_password, usuario_tipo) ";
            $sql .= " values('" . $values['name'] . "', '" . $values['last'] . "', '" . $values['email'] . "', '" . $values['phone'] . "', '" . $_POST['user'] . "', '" . md5($_POST['password']) . "', '" . $values['type'] . "')";
            $db->query($sql);

            header('Location: ./login.php?id=' . base64_encode('3'));
            exit;
        }
    } else {
        $signupError = 'Please fill in all required fields correctly.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles/global.css">
    <script src="jscripts/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#signupForm').on('submit', function(e) {
                // Front-end validation
                var valid = true;
                $('#signupForm input[required]').each(function() {
                    if ($(this).val() === '') {
                        valid = false;
                        alert('Please fill all required fields.');
                        return false;
                    }
                });
                return valid;
            });
        });
    </script>
</head>
<body>
<div id="content">
    <h1>Signup</h1>
    <?php if ($signupError): ?>
        <div class="error">
            <?php echo $signupError; ?>
        </div>
    <?php endif; ?>
    <form id="signupForm" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="last">Last Name:</label>
        <input type="text" id="last" name="last" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="user">Username:</label>
        <input type="text" id="user" name="user" required><br>
        <label for="institution">Institution:</label>
        <input type="text" id="institution" name="institution" required><br>
        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="0">Ponente/Conferencista</option>
            <option value="1">Coautor</option>
            <option value="2">Asistente</option>
            <option value="3">Evaluador</option>
        </select><br>
        <button type="submit">Sign Up</button>
    </form>
</div>
</body>
</html>
