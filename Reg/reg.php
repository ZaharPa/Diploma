<?php
if(!empty($_POST)){
    require("../Other/database.php");
    require("../Other/function.php");
    
    $emailUser = $_POST['emailUser'];
    $passwordUser = $_POST['passwordUser'];
    $nameUser = $_POST['nameUser'];
    $phoneUser = $_POST['phoneUser'];
    $addressUser = $_POST['addressUser'];
    
    if(user_add($link, $nameUser, $emailUser, $passwordUser, $phoneUser, $addressUser) === true){
       setcookie('login', 'user', 0, '/');
        header("Location: ../index.php");
    } else{
        $error = "Такий користувач існує";
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
    <title>Реєстрація</title>
</head>
<body>
    <div class = "reg">
    <?php if(isset($error)): ?>
    <span style = "color: red">
       <script> alert('<?php echo $error?>')</script>
    </span>
    <?php endif; ?>
    <p><h2>Введіть ваші дані</h2></p>
    <form action="reg.php" method = "post">
        <label>ПІБ    </label> <input type = "text" name = "nameUser" id = "nameUser" required>
        <br>
        <label>Телефон</label> <input type = "text" name = "phoneUser" id = "phoneUser" required>
        <br>
        <label>Адреса </label> <input type = "text" name = "addressUser" id = "addressUser" required>
        <br>
        <label>Email  </label> <input type = "email" name = "emailUser" id = "emailUser" required>
        <br>
        <label>Пароль </label> <input type = "password" name = "passwordUser" id = "passwordUser" required>
        <br>
        <input type = "submit" name = "sub" value = "Зареєструватися">
    </form>
    </div>
</body>
</html>