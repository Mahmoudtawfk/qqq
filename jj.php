<?php

// Creating Array of Errors
$formErrors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $cell = filter_var($_POST['cellPhone'], FILTER_SANITIZE_NUMBER_INT);
    $msg  = $_POST['message'];

    if (strlen($user) < 3) {
        $formErrors[] = "Username must be larger than 3 characters.";
    }

    if (strlen($msg) < 6) {
        $formErrors[] = "Your message must be larger than 6 characters.";
    }

    if (strlen($cell) < 11) {
        $formErrors[] = "Phone number must be 11 digits.";
    }
    // if no erros send the email
    $myemail ="mahmoudtawfik@gmail.com";
    $subject = 'contact Form';
    $headers ="from: ".$mail."/r/n";

    if(empty($formErrors)){

        mail($myemail,$subject,$msg,$headers);
        $user ="";
        $mail ="";
        $cell ="";
        $msg  ="";
$success = '<h2> We Recieved Your Message </h2>';

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
    background-color: chocolate;
}
h1 {
    text-align: center;   
}
form {
    text-align: center; 
    max-width: 550px;
    margin: 10px auto;
}
form input ,
form textarea {
    margin-bottom: 15px;
    width: 500px;
}
form textarea {
    height: 200px;
    background-color: antiquewhite;
}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Me</title>
</head>
<body>
<!-- Start Form -->
<div class="container">

    <?php if(isset($success)) {echo $success;} ?>

    
    <h1 class="text-center">Contact Me</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

        <input class="form-control" type="text" name="username" placeholder="Enter Your Username" 
        value="<?php if(isset($user)) { echo $user; } ?>">

        <br>

        <input class="form-control" type="email" name="email" placeholder="Enter a Valid Email" 
        value="<?php if(isset($mail)) { echo $mail; } ?>">

        <br>

        <input class="form-control" type="text" name="cellPhone" placeholder="Enter Your Phone Number"
        value="<?php if(isset($cell)) { echo $cell; } ?>">

        <br>

        <textarea class="form-control" name="message" placeholder="Enter Your Message"><?php if(isset($msg)) { echo $msg; } ?></textarea>

        <br>

        <input class="btn btn_success" type="submit" value="Send Message">

        <div class="errors">
            <?php
            if (!empty($formErrors)) {
                foreach ($formErrors as $err) {
                    echo $err . "<br>";
                }
            }
            ?>
        </div>
    </form>
</div>
<!-- End Form -->
</body>
</html>
