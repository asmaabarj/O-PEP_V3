<?php
session_start();
require_once("../services/servicePanier.php");
require_once("../services/serviceCommande.php");
require_once("../services/servicePlante.php");

$userId = $_SESSION['idUtilisateur'];
$servicePlante = new ServicePlante();
$servicePanier = new ServicePanier();
$serviceCommand = new ServiceCommande();



if (isset($_POST['Clear'])) {
    $servicePanier->clearPanier($userId);
}

$plantess = $servicePanier->ShowPanierplante($userId);
$countplant = 0;
$plantes = [];

if ($plantess !== null && is_array($plantess) && array_key_exists('count', $plantess) && array_key_exists('plantes', $plantess)) {
    $countplant = $plantess['count'];
    $plantes = $plantess['plantes'];
}


if (  isset($_POST['command']) ) {

   $planteIds = $servicePanier->commandpanier($userId);
   foreach ($planteIds as $planteId ) {
    $serviceCommand->insertCommand($userId,$planteId["idPlante"]);
    $servicePanier->clearPanier($userId);   }
    

                header("location: panierPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function confirmCommand() {
            return confirm("Are you sure you want to pass a command");
        }
    </script>

    <style>
        #summary {
            background-color: #f6f6f6;
            display: flex;
            flex-direction: column;
            justify-content: end;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
    <div class="container mx-auto mt-10">
        <div class="flex shadow-md my-10">
            <div class="w-[100%] bg-white px-10 py-10">
                <div class="flex justify-between border-b pb-8">
                    <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                    <h2 class="font-semibold text-2xl">
                        <?=  $countplant ?> Items
                    </h2>
                </div>
                <div class="flex gap-[19rem] mt-10 mb-5">
                    <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                    <h3 class="font-semibold text-right text-gray-600 text-xs uppercase w-1/5 text-right">Price</h3>
                </div>
                <?php
                if ($countplant > 0) {
               foreach ($plantes as $plante) {
               
                        ?>
                        <div class="flex items-center justify-between hover:bg-gray-100 -mx-8 px-6 py-5">
                            <div class="flex w-2/5">
                                <div class="w-20">
                                    <img class="h-24" src="<?= $plante->getImagePlant() ?>" alt="">
                                </div>
                                <div class="flex flex-col justify-around ml-4 flex-grow">
                                    <span class="font-bold text-sm">
                                    <?= $plante->getNomPlante() ?>
                                    </span>
                                </div>
                            </div>
                            <span class="text-center w-1/5 font-semibold text-sm">
                            <?= $plante->getPrix() ?> MAD
                            </span>
                     
                        </div>
                        <?php
                    }}
                else {
                    echo "No items in the cart.";
                }
                ?>
                <div class="flex justify-between items-center">
                <a href="productClient.php" class="flex font-semibold text-indigo-600 text-sm mt-10">
                    <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                        <path
                            d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                    </svg>
                    Continue Shopping
                </a>
                <form action="panierPage.php" method="post">
                <input class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 cursor-pointer" type="submit" name="Clear" value="Clear Basket"></form>
                </div>
            </div>
        </div>
    </div>
    <div id="summary" class="w-1/4 px-8 py-10 ">
        <div class="border-t mt-8 ">
            <div class="flex font-semibold justify-between  py-6 text-sm uppercase">
                <span>Total cost</span>
                <?php
              $totalCost = 0;
              if (!empty($plantes)) {

              foreach ($plantes as $plante) {
              $totalCost += $plante->getPrix();
             }

             echo '<span>' . $totalCost . ' MAD</span>';
            } else {
                echo '<span>0 MAD</span>';
            }
                 ?>

            </div>
                  
            <form action="panierPage.php" method="post" onsubmit="return confirmCommand();">
            <!-- <input type="hidden" name="commander" value=""> -->
            <input type ="submit" value="command" name="command" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">
</form>
<?php

                    
?> 
</div>
    </div>
            </div>


            <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <footer class="relative bg-green-900 pt-8 pb-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap text-left lg:text-left justify-between mr-[50px]">
                <div class="w-full lg:w-6/12 px-4">
                    <h4 class="text-3xl font-semibold text-white">Let's keep in touch!</h4>
                    <h5 class="text-lg mt-0 mb-2 text-blueGray-300">
                        Find us on any of these platforms, we respond 1-2 business days. </h5>
                    <div class="mt-6 lg:mb-0 mb-6">
                        <button
                            class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-twitter"></i></button><button
                            class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-facebook-square"></i></button>
                            <div class="mt-[10px]"><input type="text" id="email-address-icon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@flowbite.com"></div>
                    </div>
                </div>
                <div class="ml-[10vw]">
                <p class=" my-4 text-2xl font-semibold text-white ">Informations </p>
                <p class="text-lg mt-0 mb-2 text-blueGray-300"><a href="#">Home<br></a>
                <a href="#">FAQ<br></a>
                <a href="#">About us<br></a>
                <a href="#">Our history<br></a>
                </p>
            </div>
                <div class="">
                <p class=" my-4 text-2xl font-semibold text-white ">Contact </p>
                <p class="text-lg mt-0 mb-2 text-blueGray-300">www.o'pep-plant.ma
                    <br>contact@o'pep.ma
                    <br>+212 (0) 6 69 66 62 05
                    <br>+212 (0) 6 12 13 14 15
                </p>
            </div>
            </div>
            <hr class="my-6 border-blueGray-300">
            <h2 class="text-center" >Copyright © 2023 Hashtag O'PEP. All Rights Reserved</h2>
        </div>
    </footer>
    
</body>

</html>