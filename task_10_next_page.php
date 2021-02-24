<?php
    session_start();


    $text = $_POST['text'];

    $pdo = new PDO('mysql:host=localhost; dbname=marlin', 'root', 'root');
    $sqlSearch = 'SELECT * FROM db_input WHERE text=:text';
    $statement = $pdo->prepare($sqlSearch);
    $statement->execute(['text' => $text]);
    $db = $statement->fetch(PDO::FETCH_ASSOC);

    if(!empty($db)) {
        $message = 'You should check in on some of those fields below.';
        $_SESSION['danger'] = $message;

        header('Location: /task_10.php');
        die();
    }
    $sql = 'INSERT INTO db_input (text) VALUE (:text)';
    $text = trim(htmlspecialchars($_POST['text']));
    $data = ['text' => $text];
    $statement = $pdo->prepare($sql);
    $res = $statement->execute($data);

    $message = 'Все прошло успешно';
    $_SESSION['success'] = $message;
    header('Location: /task_10.php');
?>
