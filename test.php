<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="index.php" method="POST">
            <?php ini_set('display_errors', 1);
                if($_POST){
                    $ok = 2;
                    $win = $_POST["win"];
                    $number = $_POST["number"];
                    $n2 = $_POST["ok_input"];
                }else{
                    $ok = 1;
                    $win = 0;
                    $number = 1;
                    $n2 = 0;
                    echo("<h4>Вгадайте число від 1 до 10</h4>");
                    echo("<h4>У вас є 3 спроби</h4>");
                }

                if($ok == 1){
                    $password = rand(1, 10);
                    $try = 1;
                    $try_echo = 0;
                    $answers = [];
                    // array_push($answers, "1");
                }else{
                    $password = $_POST["ok_input"];
                    $try = $_POST["try"] + 1;
                    $try_echo = $_POST["try"];
                
                    $answers = $_POST["answers"];
                    $answers = json_decode($answers);
                }
                
                if($try_echo < 3){
                    if($number != $n2){
                        if(isset($_POST["ok"])){
                            $ok = 2;
                            if($_POST["number"] == $_POST["ok_input"]){
                                echo("<h4>Ви вгадали число!</h4>");
                                $win = 1;
                            }else{
                                echo("<h4>Ви не вгадали число!</h4>");
                                if($try_echo < 3){
                                    $try_z = 3 - $try_echo;
                                    echo("<h4>Спробуйте ще раз!</h4>");
                                    echo("<h4>Залишилося спроб: $try_z</h4>");
                                    
                                }
                                
    
                                array_push($answers, $_POST["number"]);
                                // var_dump($answers);
                            }
                        }
                        
                        echo("<p>");
                            echo("<select name='number'>");
                                for($i = 1; $i <= 10; $i++){
                                    $eqv = 0;
                                    $j = 0;
                                    while($j <= count($answers)){
                                        if($i == $answers[$j]){
                                            $eqv = 1;
                                            $j = count($answers) + 1;
                                        }
                                        $j++;
                                    }
                                    if($eqv == 1){
                                        echo("<option value='$i' disabled>$i</option>");
                                    }else{
                                        echo("<option value='$i'>$i</option>");
                                    }
                                }
                                echo("</select>");
                        echo("</p>");
                    }else{
                        echo("<h3>Ви вгадали число!</h3>");
                        echo("<p>Число: $password</p>");
                        echo("<a href='index.php'>play again</a>");
                    }
                    
                }else if($number != $n2){
                    echo("<h3>GAME OVER!</h3>");
                    echo("<h3>Ви не вгадали число!</h3>");
                    echo("<p>Число: $password</p>");
                    echo("<a href='index.php'>play again</a>");

                }else if($number == $n2){
                    echo("<h3>Ви вгадали число!</h3>");
                    echo("<p>Число: $password</p>");
                    echo("<a href='index.php'>play again</a>");

                }
                // echo("<p>$password</p>");
                // var_dump($_POST);
                echo("<p>Спроба $try_echo з 3</p>");
                
                
                
                $answers_encode = json_encode($answers);
                
                echo("<input type='hidden' name='ok_input' value='$password'>");
                echo("<input type='hidden' name='try' value='$try'>");
                echo("<input type='hidden' name='answers' value='$answers_encode'>");
                echo("<input type='hidden' name='win' value='$win'>");
                


            ?>
        <p><input type="<?php if($try_echo > 2 || $number == $n2){echo("hidden");}else{echo("submit");} ?>" name="ok" value="ok"></p>
        
    </form>
    
</body>
</html>