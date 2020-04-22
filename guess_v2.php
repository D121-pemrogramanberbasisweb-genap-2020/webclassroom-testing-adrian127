<?php
ob_start();
session_start();
    $message = false;
    $user_guess='';
    $random= rand(1,100); 

    function guessNumbers($guess, $randomNumber, $attempts){
        if($guess == $randomNumber){
            $message = "Great job! $guess is correct number. <br> You need  $attempts attempt(s) <br> Press RESET button to play again";
        } elseif($guess < $randomNumber){
           
            $message = "$guess is too low. <br> Your Attempts: $attempts .Try again";
        } else{
           
            $message = "$guess is too high. <br> Your Attempts:  $attempts . Try again" ;
        }
        return $message;
    }

    if (isset($_SESSION['number_of_guesses'])) {
        $_SESSION['number_of_guesses']=$_SESSION['number_of_guesses'];
    }else {
        $_SESSION['number_of_guesses']=0;
    }

    $number_of_guesses = $_SESSION['number_of_guesses']++;
    
    
    if(!isset($_COOKIE['my_random'])) {
        setcookie('my_random',$random);
        
    }
    else {
        
    }
    

    if(isset($_POST['reset'])){
        $_SESSION['number_of_guesses'] = 1; 
        unset($_POST['guess']);
        setcookie('my_random',$random);
    }

    if (isset($_POST['guess'])) { 
        $user_guess = $_POST['guess'] + 0; 
        $message = guessNumbers($user_guess, $_COOKIE['my_random'], $number_of_guesses);
    }  
?>

<html>
<head>
    <title>Number Guessing Game v2.0</title>
</head>
<body >

<p>Number Guessing game v2.0 by <strong>Adrian Yonam L.M/D121181505</strong></p>

<?php
   if ( $message !== false )  {
        echo("<p>$message</p>\n");
    }
   
?>
<form method="post">
    <p><label for="guess">Input guess</label>
    <input type="text" name="guess" id="guess" size=40 value=""></p>
    <input type="submit" value="guess" name="action">
    <input type="submit" name="reset" value="reset">
</form>

</body>

</html>