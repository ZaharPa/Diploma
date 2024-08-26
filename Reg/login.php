<?php
if(!empty($_POST)){
    require("../Other/database.php");
    require("../Other/function.php");

    $loginUser = $_POST['loginUser'] ?? '';
    $passwordUser = $_POST['passwordUser'] ?? '';

    if(checkAuth($link,$loginUser, $passwordUser) == 'user'){
        setcookie('login', 'user', 0, '/');
        setcookie('id', idUser($link, $loginUser), 0, '/');
        header("Location: ../index.php");
    } else if(checkAuth($link, $loginUser, $passwordUser) == 'admin'){
        setcookie('login', 'admin', 0, '/');
        header("Location: ../index.php");
    } else if(checkAuth($link, $loginUser, $passwordUser) == 'doctor'){
        setcookie('login', 'doctor', 0, '/');
        header("Location: ../index.php");
    } else{
        $error = "Невірно введені дані";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = 'utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../Other/styleVET.css">
    <title>Вхід</title>
</head>
<body>
    <div class = "login">
    <?php if(isset($error)): ?>
    <span style = "color: red">
       <script> alert('<?php echo $error?>')</script>
    </span>
    <?php endif; ?>
    <form action="login.php" method = "post">
        <label for = "login">Логін</label> <input type = "text" name = "loginUser" id = "loginUser">
        <br>
        <label for = "password">Пароль</label> <input type = "password" name = "passwordUser" id = "passwordUser">
        <br>
        <input type = "submit" name = "sub" value = "Вхід">
    </form>
    </div>
</body>
</html>