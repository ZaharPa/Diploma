<?php
    $loginUser = $_COOKIE['login'] ?? '';
    if ($loginUser == 'doctor' or $loginUser == 'admin'){
        require("../Other/database.php");
        require("../Other/function.php");
        $pets = petView($link);
?>

<!DOCTYPE html>
<html lang = "en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../Other/styleVET.css">
    <title>Тварини</title>
</head>
<body>
    <div class = "logo"><img src="https://2999999.ru/images/logos/2661/logozvc.png"></div>
    <nav class = "navigation">
        <ul>
            <li><a href="../index.php">Головна</a></li>
            <li><a href="../aboutOur.php">Про нас</a></li>
            <?php if ($loginUser == "user"){?>
                <li><a href = "../dateTable.php">Розклад</a></li>
                <li><a href = "diagnosisView.php">Список діагнозів</a></li>
                <li><a href = "doctorView.php">Список лікарів</a></li>
                <li><a href = "newRecord.php">Запис на прийом</a></li>
                <li><a href = "../Client/personal.php">Особистий кабінет</a></li>
                <li><a href ="../Reg/logout.php">Вийти</a></li>
            <?php } else if ($loginUser == "doctor"){?>
                <li><a href = "diagnosisView.php">Список діагнозів</a></li>
                <li><a href = "petView.php">Список тварин</a></li>
                <li><a href = "petAdd.php">Додати тварину</a></li>
                <li><a href = "petEdit.php">Редагувати тварину</a></li>
                <li><a href = "../dateTable.php">Розклад</a></li>
                <li><a href = "newRecord.php">Запис на прийом</a></li>
                <li><a href ="../Reg/logout.php">Вийти</a></li>
            <?php } else if ($loginUser == "admin"){?>
            <div class="dropdown">
                <button class="dropbtn">Клієнти</button>
                    <div class="dropdown-content">
                    <a href="../Client/clientView.php">Перегляд</a>
                    <a href="../Client/clientEdit.php">Редагувати</a>
                    <a href="../Client/clientAdd.php">Додати</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Тварини</button>
                    <div class="dropdown-content">
                    <a href="petView.php">Перегляд</a>
                    <a href="petEdit.php">Редагувати</a>
                    <a href="petAdd.php">Додати</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Лікарі</button>
                    <div class="dropdown-content">
                    <a href="doctorView.php">Перегляд</a>
                    <a href="doctorEdit.php">Редагувати</a>
                    <a href="doctorAdd.php">Додати</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Аналіз</button>
                    <div class="dropdown-content">
                    <a href="servMonths.php">Прибуток по місяцям</a>
                    <a href="docAnalysis.php">Лікарів</a>
                    <a href="petAnalysis.php">Тварин</a>
                </div>
            </div>
            <li><a href = "diagnosisView.php">Список діагнозів</a></li>
            <li><a href = "../dateTable.php">Розклад</a></li>
            <li><a href = "newRecord.php">Запис на прийом</a></li>
            <li><a href ="../Reg/logout.php">Вийти</a></li>
            <?php } else { ?>
            <li><a href="../Reg/login.php">Вхід</a></li>
            <li><a href="../Reg/reg.php">Реєстрація</a></li>
            <?}?>
        </ul>
    </nav>
    
    <div class = "mainText">
    <h2><p>Список тварин, що являються нашими клієнтами</p></h2>
    <div class="tablePet">
    <table>
        <tr>
            <th>ID</th>
            <th>Ім'я власника</th>
            <th>Кличка</th>
            <th>Вид</th>
            <th>Порода</th>
            <th>Вік</th>
            <th>Стать</th>
            <th>Фото</th>
        </tr>
        <?php foreach($pets as $pet): ?>
 		<tr>
            <td><?=$pet['id']?></td>
 			<td><?php echo (petOwnerView($link, $pet['nameOwner']))?></td>
 			<td><?=$pet['alias']?></td>
            <td><?=$pet['kind']?></td>
            <td><?=$pet['breed']?></td>
            <td><?=$pet['age']?></td>
            <td><?=$pet['sex']?></td>
            <td><img height="150px" src = "<?=$pet['imgpath']?>/<?=$pet['imgname']?>"></td>	
 		</tr>
        <?php endforeach ?>
    </table>
    </div>
    </div>
    <footer class="footVet">
        Пашкевич Захар 452 група
        <a href="https://web.telegram.org/z/#-1463721328"><img class="img-rounded" src="data:image/png;base64,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"></a>
        <a href="https://www.facebook.com/zelenskiy.official/?locale=uk_UA"><img class="img-rounded" src="data:image/png;base64,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"></a>
        <a href="https://twitter.com/ZelenskyyUa?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img class="img-rounded" src="data:image/png;base64,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"></a>
        <a href="https://www.instagram.com/zelenskiy_official/"><img class="img-rounded" src="data:image/jpeg;base64,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"></a>
    </footer>
</body>
</html>
<?php } ?>