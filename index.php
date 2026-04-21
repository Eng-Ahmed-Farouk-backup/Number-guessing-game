<?php 
session_start();

if (!isset($_SESSION["number"])){
    $_SESSION["number"] = rand(1,100);
    $_SESSION["attempts"] = 0;
    $_SESSION["message"] = "guess the number from 1 to 100";
    $_SESSION["over"] = false;
    $_SESSION["best_score"] = null; 
}

if (isset($_POST["guess"]) && ! $_SESSION["over"]){
    $guess = (int)$_POST["guess"];
    $number = $_SESSION["number"];
    $_SESSION["attempts"] = $_SESSION["attempts"] + 1;

    if ($guess > $number){
        $_SESSION["message"] = "too high, try again";
    }
    elseif ($guess < $number){
        $_SESSION["message"] = "too low, try again";
    }
    else{
        $_SESSION["message"] = "Congratulations You won in {$_SESSION["attempts"]} attempts";
        $_SESSION["over"] = true;
        if ($_SESSION['best_score'] === null || $_SESSION['attempts'] < $_SESSION['best_score']) {
            $_SESSION['best_score'] = $_SESSION['attempts'];
        }
    }
    
}
?>
