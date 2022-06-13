<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сomplicated psychic</title>
</head>
<body>
<main>
        <form action="
            <?php 
                session_start();
                $lose = (isset($_POST['lose'])) ? $_POST['lose'] : 0;
                $win = (isset($_POST['win'])) ? $_POST['win'] : 0;
                if ($lose < 6) {
                    echo 'four.php';
                } else if ($lose == 6) {
                    echo 'four.php';
                } 
            ?>" 
            method="POST">
            <h1>Гра екстрасенс (ускладненна версія)!</h1>
            <h2>3</h2>
            <!-- <p class="text">Вгадай число яке загадав комп'ютер! Для цього тобі потрібно лише обрати число з випадаючого списку.</p> --> 
            <?php 
                $password = (isset($_POST['password'])) ? $_POST['password'] : rand(1, 100);
                $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                echo "<h2>$password</h2>";
                echo "<p> lose $lose</p>";
                if ($lose < 7) {
                    if ($password[1] < 6) {
                        $numberStart = $password[0] . 1;
                        if ($password == 100) {
                            $numberStart = 91;
                        }
                    } else {
                        $numberStart = $password[0] . 6;
                    }
                    $numberEnd = $numberStart + 4;
                    echo $numberStart;
                    echo $numberEnd;

                    if (isset($_POST['number'])) {
                        $number = $_POST['number'];
                        if ($password == $number) {
                            echo "<p>WIN</p>";
                        } else {
                            $lose++;
                            array_push($disabledNumbers, $number);
                            echo "<p>LOSE</p>";
                        }
                        echo ("<p>");
                        echo ("<select name='number'>");
                            for($i = $numberStart; $i <= $numberEnd; $i++) {
                                if (in_array($i, $disabledNumbers)) {
                                    echo ("<option value='$i' disabled>$i</option>");
                                } 
                                else {
                                    echo ("<option value='$i'>$i</option>");
                                }
                            }
                        echo ("</select>");
                        echo ("</p>"); 
                    }
                    var_dump ($disabledNumbers);
                }
                $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
            ?>
            <input class="btn b" type="submit" name="sub" value="Спробувати"></p>
            <input type="hidden" name="password" value="<?php echo($password) ?>"><br>
            <input type="hidden" name="lose" value="<?php echo($lose) ?>"><br>
            <button class="btn t" type="submit" name="new"><a href="index.php">Нова гра!</a></button>
        </form>
    </main>
</body>
</html>