<?php

session_start();
require_once("../services/ServiceAuth.php");


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $serviceAuth = new ServiceAuth();
    $authResult = $serviceAuth->login($email);
    
    if ($authResult) {
        $row = $authResult;
echo 'Hashed Password from Database: ' . $row['MdpUtilisateur'] . '<br>';
echo 'Hashed Password Entered: ' . password_hash($password, PASSWORD_DEFAULT) . '<br>';

        if ($row && password_verify($password, $row['MdpUtilisateur'])
        ) {
            $_SESSION['user_type'] = strtolower($row['nameRole']);
            $_SESSION['idUtilisateur'] = $row['idUtilisateur'];
            header("location: {$row['nameRole']}Page.php");
            exit();
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'PEP</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        h1{
            -webkit-text-stroke: 2px #003f04;
        }
        h3{
            -webkit-text-stroke: 1px #000;
            
        }
    </style>
</head>

<body>
    <section class="bg-[url('./images/tsswira.png')] bg-cover h-screen flex items-center justify-center">
        <div class="min-h-[85vh] w-[90%] m-auto gap-[15px] flex flex-col md:flex-row md:justify-evenly items-center">
            <div class="md:w-[50%] w-[85%] flex flex-col gap-[25px] mt-[15px]">
                <h1 class="text-white font-bold text-[40px]">Welcome to O'PEP - Your Botanical Paradise 
</h1>
                <h3 class="text-black text-[28px] font-lighter ">Join the O'PEP family, where nature meets passion! 

</h3>
                <p class="text-gray-900 text-[15px] md:text-[18px]">
                     </p>
            </div>

            <div class="h-[90vh] w-[100%] md:w-[40%] flex justify-center items-center">
                <form action="" class="flex flex-col gap-[8px] h-[55%] w-[100%] p-[10px] bg-gray-300/70 items-center justify-center rounded" method="post">
                    <h3 class="text-3xl mb-2.5 uppercase font-medium text-green-900">Sign in</h3>
                    <?php
                        if (isset($error)) {
                            foreach ($error as $error) {
                                echo '<span style="color: red; ">' . $error . '</span>';
                            };
                        }
                    ?>
                    <input type="email" name="email" required placeholder="Enter Your E-mail" class="outline-none h-[3rem] p-[5px] w-[85%] rounded">
                    <input type="password" name="password" required placeholder="Enter Your password" class="outline-none h-[3rem] w-[85%] p-[5px] rounded">
                    <div class="w-[85%]"></div>
                    <input type="submit" name="submit" value="login now" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 w-[85%] rounded cursor-pointer">
                    <p>don't have an account?<a class="text-green-700" href="register.php">register now</a></p>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
