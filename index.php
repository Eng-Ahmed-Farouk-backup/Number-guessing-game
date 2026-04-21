<?php 
session_start();

if (!isset($_SESSION["number"])){
    $_SESSION["number"] = rand(1,100);
    $_SESSION["attempts"] = 0;
    $_SESSION["message"] = "guess the number from 1 to 100";
    $_SESSION["over"] = false;
    $_SESSION["best_score"] = null; 
}

if (isset($_POST["new_game"])){
    $_SESSION["number"] = rand(1,100);
    $_SESSION["attempts"] = 0;
    $_SESSION["message"] = "guess the number from 1 to 100";
    $_SESSION["over"] = false;
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


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guess the number game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Guess the number game</h1>
        <div class="stats">
            <?php
            if ($_SESSION["best_score"]){
                echo "<p>best score: {$_SESSION["best_score"]} attempts</p>";
            }
            else{
                echo "best score: not set yet";
            }
            ?>
            <?php 
            echo "<p>attempts: {$_SESSION["attempts"]}</p>"
            ?>
        </div>

        <div class="message">
            <?php
            echo "<p>{$_SESSION["message"]}</p>"
            ?>
        </div>

        <?php
        if (! $_SESSION["over"]){
            echo '
            <form method="post" class="guess-form">
                <input type="number" name="guess" min="1" max="100" placeholder="Enter your guess (1-100)" required>
                <button type="submit">Guess</button>
            </form>
            ';
        }
        ?>

        <div class="actions">
        <form method="post" style="display: inline;">
            <button type="submit" name="new_game" class="btn-new">New Game</button>
        </form>
        </div>

    </div>
    
</body>
</html>
}
?>
