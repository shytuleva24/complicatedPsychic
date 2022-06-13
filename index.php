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
                if ($lose == 1 || $win == 1) {
                    echo 'two.php';
                } else {
                    echo 'index.php';
                } 
            ?>" 
            method="POST">
            <h1>Гра екстрасенс (ускладненна версія)!</h1>
            <h2>Спробуй свої можливості</h2>
            <p class="text">Вгадай число яке загадав комп'ютер! Для цього тобі потрібно лише обрати число з випадаючого списку.</p>

            <?php 
                if (isset($_POST['new'])) {
                    header("refresh: 0;");
                    session_destroy();
                }

                $password = (isset($_POST['password'])) ? $_POST['password'] : rand(1, 100);
                $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                $password = 74;
                echo "<p> lose $lose</p>";
                echo "<h2>$password</h2>";
                if ($lose < 2) {
                    if (isset($_POST['number'])) {
                        $number = $_POST['number'];
                        explode(" - ", $number);
                        $start = explode(" - ", $number)[0];
                        $end = explode(" - ", $number)[1];
                        if ($password >= $start && $password <= $end) {
                            echo "<p>WIN</p>";
                            $win = 1;
                            echo "win $win <br>";
                        } else {
                            $lose++;
                            array_push($disabledNumbers, $number);
                            echo "<p>LOSE</p>";
                        }
                    }
                    var_dump ($disabledNumbers);

                    echo ("<p>");
                    echo ("<select name='number'>");
                        for($i = 0; $i <= 99; $i+=10) {
                            $start = $i + 1;
                            $end = $i + 10;
                            $value = $start ." - ". $end;
                            if (in_array($value, $disabledNumbers)) {
                                echo ("<option value='$value' disabled>$value</option>");
                            } 
                            else {
                                echo ("<option value='$value'>$value</option>");
                            }
                        }
                    echo ("</select>");
                    echo ("</p>"); 
                    
                }
                $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
            ?>
            <input class="btn b" type="submit" name="sub" value="Спробувати"></p>
            <input type="hidden" name="password" value="<?php echo($password) ?>"><br>
            <input type="hidden" name="lose" value="<?php echo($lose) ?>"><br>
            <input type="hidden" name="win" value="<?php echo($win) ?>"><br>

            <button class="btn t" type="submit" name="new">Нова гра!</button>
        </form>
    </main>
</body>
</html>