<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="form1.php" method="POST">
        <label for="name">Ім'я:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="surname">Прізвище:</label><br>
        <input type="text" id="surname" name="surname"><br>
        
        <label for="age">Вік:</label><br>
        <input type="number" id="age" name="age"><br>
        
        <label for="email">Електронна пошта:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <input type="submit" value="Надіслати">
    </form>
    <h2>Виберіть колір для фону сторінки:</h2>
    <form action="form2.php" method="GET">
        <label for="color">Колір:</label>
        <select name="color" id="color">
            <option value="red">Червоний</option>
            <option value="blue">Синій</option>
            <option value="green">Зелений</option>
            <option value="yellow">Жовтий</option>
            <option value="orange">Помаранчевий</option>
        </select>
        <br><br>
        <input type="submit" value="Змінити колір">
    </form>
    <h2>Формування списку продуктів</h2>
    <form action="form3.php" method="post">
        <input type="checkbox" id="product1" name="products[]" value="Яблуко">
        <label for="product1">Яблуко</label><br>
    
        <input type="checkbox" id="product2" name="products[]" value="Апельсин">
        <label for="product2">Апельсин</label><br>
    
        <input type="checkbox" id="product3" name="products[]" value="Груша">
        <label for="product3">Груша</label><br>
        

        <input type="radio" id="list" name="display_mode" value="list" checked>
        <label for="list">Список</label><br>
        <input type="radio" id="table" name="display_mode" value="table">
        <label for="table">Таблиця</label><br><br>
 

        <input type="submit" value="Сформувати список">
    </form>
    <h2>Багаторядкове текстове поле</h2>
    <form action="form4.php" method="post">
        <textarea name="text" rows="5" cols="50"></textarea><br><br>
        <input type="submit" value="Замінити пробіли на &">
    </form>
</body>
</html>
Лістинг коду: form1.php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $age = $_POST['age'] ?? '';
    $email = $_POST['email'] ?? '';

    if (!empty($name) && !empty($surname) && !empty($age) && !empty($email)) {
      
        if (strlen($name) > 1) {
            
            if (is_numeric($age)) {
            
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          
                    echo "Привіт, $name $surname. Твоя електронна пошта – $email. Тобі $age " . getYearsString($age);
                } else {
                    echo "Будь ласка, введіть коректну електронну пошту.";
                }
            } else {
                echo "Будь ласка, введіть число у поле віку.";
            }
        } else {
            echo "Будь ласка, введіть ім'я, що складається з більше, ніж однієї літери.";
        }
    } else {
        echo "Будь ласка, заповніть всі поля форми.";
    }
}

// Функція для визначення відмінка для слова "років"
function getYearsString($age) {
    if ($age % 10 == 1 && $age % 100 != 11) {
        return 'рік';
    } elseif ($age % 10 >= 2 && $age % 10 <= 4 && ($age % 100 < 10 || $age % 100 >= 20)) {
        return 'роки';
    } else {
        return 'років';
    }
}
?>
Лістинг коду: form2.php
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        if (isset($_GET['color'])) {
      
            $selected_color = $_GET['color'];
            

            echo "<style>body { background-color: $selected_color; }</style>";
        }
    }
    ?>

Лістинг коду: form3.php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['products']) && !empty($_POST['products'])) {
        $products = $_POST['products'];
        $display_mode = $_POST['display_mode'];

        echo "<h2>Ваш вибір:</h2>";

        if($display_mode == "list") {
            echo "<ul>";
            foreach ($products as $product) {
                echo "<li>$product</li>";
            }
            echo "</ul>";
        } elseif($display_mode == "table") {
            echo "<table border='1'>";
            echo "<tr><th>Продукт</th></tr>";
            foreach ($products as $product) {
                echo "<tr><td>$product</td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Будь ласка, оберіть хоча б один продукт.</p>";
    }
}
?>

Лістинг коду: form4.php
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $text = $_POST['text'];

    $modified_text = str_replace(' ', '&', $text);

    
    echo '<textarea name="text" rows="5" cols="50">' . $modified_text . '</textarea>';
}
?>
