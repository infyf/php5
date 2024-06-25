<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="form1.php" method="POST">
        <label for="name">��'�:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="surname">�������:</label><br>
        <input type="text" id="surname" name="surname"><br>
        
        <label for="age">³�:</label><br>
        <input type="number" id="age" name="age"><br>
        
        <label for="email">���������� �����:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <input type="submit" value="��������">
    </form>
    <h2>������� ���� ��� ���� �������:</h2>
    <form action="form2.php" method="GET">
        <label for="color">����:</label>
        <select name="color" id="color">
            <option value="red">��������</option>
            <option value="blue">����</option>
            <option value="green">�������</option>
            <option value="yellow">������</option>
            <option value="orange">������������</option>
        </select>
        <br><br>
        <input type="submit" value="������ ����">
    </form>
    <h2>���������� ������ ��������</h2>
    <form action="form3.php" method="post">
        <input type="checkbox" id="product1" name="products[]" value="������">
        <label for="product1">������</label><br>
    
        <input type="checkbox" id="product2" name="products[]" value="��������">
        <label for="product2">��������</label><br>
    
        <input type="checkbox" id="product3" name="products[]" value="�����">
        <label for="product3">�����</label><br>
        

        <input type="radio" id="list" name="display_mode" value="list" checked>
        <label for="list">������</label><br>
        <input type="radio" id="table" name="display_mode" value="table">
        <label for="table">�������</label><br><br>
 

        <input type="submit" value="���������� ������">
    </form>
    <h2>������������� �������� ����</h2>
    <form action="form4.php" method="post">
        <textarea name="text" rows="5" cols="50"></textarea><br><br>
        <input type="submit" value="������� ������ �� &">
    </form>
</body>
</html>
˳����� ����: form1.php
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
          
                    echo "�����, $name $surname. ���� ���������� ����� � $email. ��� $age " . getYearsString($age);
                } else {
                    echo "���� �����, ������ �������� ���������� �����.";
                }
            } else {
                echo "���� �����, ������ ����� � ���� ���.";
            }
        } else {
            echo "���� �����, ������ ��'�, �� ���������� � �����, �� ���� �����.";
        }
    } else {
        echo "���� �����, �������� �� ���� �����.";
    }
}

// ������� ��� ���������� ������ ��� ����� "����"
function getYearsString($age) {
    if ($age % 10 == 1 && $age % 100 != 11) {
        return '��';
    } elseif ($age % 10 >= 2 && $age % 10 <= 4 && ($age % 100 < 10 || $age % 100 >= 20)) {
        return '����';
    } else {
        return '����';
    }
}
?>
˳����� ����: form2.php
<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        if (isset($_GET['color'])) {
      
            $selected_color = $_GET['color'];
            

            echo "<style>body { background-color: $selected_color; }</style>";
        }
    }
    ?>

˳����� ����: form3.php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['products']) && !empty($_POST['products'])) {
        $products = $_POST['products'];
        $display_mode = $_POST['display_mode'];

        echo "<h2>��� ����:</h2>";

        if($display_mode == "list") {
            echo "<ul>";
            foreach ($products as $product) {
                echo "<li>$product</li>";
            }
            echo "</ul>";
        } elseif($display_mode == "table") {
            echo "<table border='1'>";
            echo "<tr><th>�������</th></tr>";
            foreach ($products as $product) {
                echo "<tr><td>$product</td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>���� �����, ������ ���� � ���� �������.</p>";
    }
}
?>

˳����� ����: form4.php
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $text = $_POST['text'];

    $modified_text = str_replace(' ', '&', $text);

    
    echo '<textarea name="text" rows="5" cols="50">' . $modified_text . '</textarea>';
}
?>
