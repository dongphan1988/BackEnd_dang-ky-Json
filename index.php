<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post">
    name
    <input type="text" name="name"/>
    mail
    <input type="email" name="mail"/>
    phone
    <input type="text" name="phone"/>
    <input type="submit" value="input"/>
    <?php
    $name = $_POST["name"];
    $email = $_POST["mail"];
    $phone = $_POST["phone"];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($name)||empty($phone)||empty($email)){
            echo "empty . pls input";
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "mail wrong.input again";
        }else{
            if(file_exists('user.json')){
                $valueJson = file_get_contents('user.json');
                $converJsonArray = json_decode($valueJson,true);
                $elementInput = array(
                    'name'=>$name,
                    'email' => $email,
                    'phone'=>$phone
                );
                array_push($converJsonArray,$elementInput);
                $newFileJson = json_encode($converJsonArray);
                file_put_contents('user.json',$newFileJson);
                echo "input sussesed";
            }else{
                echo "file json does not exit";
            }
        }
    }
    ?>
</form>
</body>
</html>