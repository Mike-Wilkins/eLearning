<?php
    $username = $_SESSION['username'];
    $sql = 'SELECT colour FROM login WHERE (username = :username)';
    $stmt = $con -> prepare($sql);
    $stmt -> bindValue(':username', $username);
    $result = $stmt -> execute();
    $rows = $stmt -> fetchAll();
    $_SESSION['colour'] = $rows[0]['colour'];
    $colour = $_SESSION['colour'];
?>