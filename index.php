<!DOCTYPE html>
<html>

<head>
    <title>index</title>
    <meta charset="utf-8" />
    <style type="text/css">
        .hide {
            display: none;
        }

        .hide.show {
            display: block;
        }
    </style>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var select = document.querySelector('#main'),
                hide = document.querySelectorAll('.hide');

            function change() {
                [].forEach.call(hide, function(el) {
                    var add = el.classList.contains(select.value) ? "add" : "remove"
                    el.classList[add]('show');
                });
            }
            select.addEventListener('change', change);
            change()
        });
    </script>
</head>

<body>

    <?php
    require_once "connection.php";
    require_once "classes/DataBase.php";
    $db = new DataBase($conn);
    $db->useDb();
    ?>

    <h2>Список групп</h2>
    <?php
    $sql = "SELECT * FROM classes";
    if ($result = $conn->query($sql)) {
        echo "<table><tr><th>Id</th><th>Название</th><th>Курс</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["course"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка";
    }
    ?>

    <h2>Список студентов</h2>
    <?php
    $sql = "SELECT *, students.id AS student_id
        FROM students
        INNER JOIN classes ON students.classes_id = classes.id";
    if ($result = $conn->query($sql)) {
        echo "<table><tr><th>Id</th><th>Полное имя</th><th>Дата рождения</th><th>Группа</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td>" . $row["dob"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка";
    }
    ?>

    <h2>Список преподавателей</h2>
    <?php
    $sql = "SELECT * FROM professors";
    if ($result = $conn->query($sql)) {
        echo "<table><tr><th>Id</th><th>Полное имя</th></tr>";
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка";
    }
    
    unset($conn);
    ?>

    <hr>
    <h2>Добавление данных</h2>
    <select id="main" name="main" class="main_field" aria-required="true">
        <option value="class" selected="selected">Группа</option>
        <option value="student">Студент</option>
        <option value="professor">Преподаватель</option>
    </select>
    <form class="hide class" action="create.php" method="post">
        <p>Название группы:
            <input type="text" name="name" />
        </p>
        <p>Курс:
            <input type="number" name="course" />
        </p>
        <input type="submit" value="Добавить">
    </form>
    <form class="hide student" action="create.php" method="post">
        <p>Полное имя:
            <input type="text" name="full_name" />
        </p>
        <p>Дата рождения:
            <input type="date" name="dob" />
        </p>
        <p>Группа:
            <input type="text" name="group" />
        </p>
        <input type="submit" value="Добавить">
    </form>

    <form class="hide professor" action="create.php" method="post">
        <p>Полное имя:
            <input type="text" name="full_name_professor" />
        </p>
        <input type="submit" value="Добавить">
    </form>

    <hr>
    <form action="rollbackBd.php" method="get">
        <input type="submit" value="Откат бд">
    </form>
</body>

</html>