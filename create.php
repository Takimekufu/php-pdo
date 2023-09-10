<?php

require_once "connection.php";
$conn->query("USE mysqli_test");

if (isset($_POST["name"]) && $_POST["course"]) {
    
    $stmt = $conn->prepare("INSERT INTO classes (name, course) VALUES (?,?)");
    $stmt->execute([$_POST["name"], $_POST["course"]]);

} elseif (isset($_POST["full_name"]) && isset($_POST["dob"]) && isset($_POST["group"])) {

    $stmt = $conn->prepare("SELECT id FROM classes WHERE name = ?");
    $stmt->execute($_POST["group"]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $go = $conn->prepare("INSERT INTO students (full_name, dob, classes_id) VALUES (?,?,?)");
    $go->execute([$_POST["full_name"], $_POST["dob"], $result["id"]]);

} elseif (isset($_POST["full_name_professor"])) {

    $stmt = $conn->prepare("INSERT INTO professors (full_name) VALUES (:name)");
    $stmt->execute([
        'name' => $_POST["full_name_professor"]
    ]);
}

unset($conn);
header("Location: http://php-mysqli/");
exit;