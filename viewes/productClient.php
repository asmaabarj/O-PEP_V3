<?php
require_once("../services/servicePlante.php");
require("../services/serviceCategorie.php");


$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$planteafich = new ServicePlante();
$Plantes = $planteafich->ShowPlantes($searchTerm);

$serviceCat = new ServiceCategorie();
$selectedCategorys = $serviceCat->selectCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'PEP</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

<header class="header sticky w-[100%] top-0 bg-white shadow-md flex items-center justify-between px-8 py-02 z-50	">
        <a href="clientPage.php">
            <img src="images/logoPage.png" alt="" class="md:h-[50px] md:w-[100px] h-[35px] w-[90px]">
        </a>

        <nav class="nav font-semibold w-[100%] text-lg">
            <ul class="flex items-center w-[100%] justify-center  ">
                <li
                    class="p-4 border-b-2 border-green-500 border-opacity-0 hover:border-opacity-100 hover:text-green-500 duration-200 cursor-pointer active">
                    <a href="clientPage.php">Home</a>
                </li>
                <li
                    class="p-4 border-b-2 border-green-500 border-opacity-0 hover:border-opacity-100 hover:text-green-500 duration-200 cursor-pointer">
                    <a href="productClient.php">Product</a>
                </li>
                <li
                    class="p-4 border-b-2 border-green-500 border-opacity-0 hover:border-opacity-100 hover:text-green-500 duration-200 cursor-pointer">
                    <a href="contactClient.php">Contact</a>
                </li>

                <li
                    class="p-4 border-b-2 border-red-500 border-opacity-0 hover:border-opacity-100 hover:text-red-500 duration-200 cursor-pointer">
                    <a href="index.php">Log out</a>
                </li>
            </ul>
        </nav>
        <form action="productClient.php" method="GET" class="flex items-center mr-[10px]">
            <input type="text" name="search" placeholder="Search plant..." class="p-2 border border-gray-300 rounded-md"
                onkeydown="if (event.key === 'Enter') { this.form.submit(); }">
        </form>

        <a href="panier.php">
            <div style="position: relative;">
                <?php
                echo '<p class="rounded-full  h-[17px] w-[17px] text-[10px] flex justify-center items-center bg-green-500 absolute top-0 right-0">'. 0 .'</p>';
                ?>

                <a href="panier.php" value="">
                    <svg class="h-8 p-1 hover:text-green-500 duration-200" aria-hidden="true" focusable="false"
                        data-prefix="far" data-icon="shopping-cart" role="img" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 576 512" class="svg-inline--fa fa-shopping-cart fa-w-18 fa-7x">
                        <path fill="currentColor"
                            d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z"
                            class=""></path>
                    </svg>
                </a>
            </div>
        </a>
        </div>

        </a>
       
       
    </header>
    <div class="flex  w-[100%] justify-center flex-wrap bg-gray-600">
    <form action="productClient.php" method="post">
    <?php foreach ($selectedCategorys as $selectedCategory): ?>
        <button type="submit" name="categorieType" value="<?= $selectedCategory->getIdCategorie() ?>" class="px-4 py-2 m-2 rounded focus:outline-none bg-white text-gray-800  focus:text-white focus:bg-green-500" >
            <?= $selectedCategory->getNomCategorie() ?>
        </button>
    <?php endforeach; ?>
</form>

    </div>






    <section class="flex flex-wrap justify-between w-[90%] m-auto">
<?php if (isset($_POST["categorieType"])) {
    $id = $_POST["categorieType"];
    $servicePlant = new ServicePlante();
$filterplant = $servicePlant->FilterPlant($id);

foreach ($filterplant as $plant) {?>
    <div class="h-[70vh] w-[23vw] m-[30px] ">
    <div><img src="<?= $plant->getImagePlant() ?>" class="h-[50vh] w-[100%]"></div>
    <div>
        <div>
            <h1 class="font-bold text-center">
                <?= $plant->getNomPlante() ?>
            </h1>
            <p class="uppercase text-green-800 font-semibold text-center">
                <?= $plant->getNomCategorie() ?>
            </p>
            <p class="font-normal text-center">
                <?= $plant->getPrix() ?> MAD
            </p>
        </div>
        <div class=" flex justify-center ">
            <form action="productAdmin.php" method="post"
                class=" flex w-[120px] font-semibold bg-green-600 mt-[10px] p-[4px] items-center rounded-[2px]">
                <input type="hidden" name="product_id" value="<?= $plant->getIdPlant() ?>">
                <button type="submit" class="cursor-pointer flex" name="basket" value="<?= $plant->getIdPlant() ?>">
                    <p class="text-white text-xs">ADD TO BASKET</p>

                    <svg class=" relative h-5 p-1 text-white duration-200" aria-hidden="true" focusable="false"
                        data-prefix="far" data-icon="shopping-cart" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                        class="svg-inline--fa fa-shopping-cart fa-w-18 fa-7x">
                        <path fill="currentColor"
                            d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z"
                            class=""></path>
                    </svg>
            </form>

        </div>
    </div>
</div>
    <?php
}}else{

      ?>
        <?php foreach ($Plantes as $plant): ?>
            <div class="h-[70vh] w-[23vw] m-[30px] ">
                <div><img src="<?= $plant->getImagePlant() ?>" class="h-[50vh] w-[100%]"></div>
                <div>
                    <div>
                        <h1 class="font-bold text-center">
                            <?= $plant->getNomPlante() ?>
                        </h1>
                        <p class="uppercase text-green-800 font-semibold text-center">
                            <?= $plant->getNomCategorie() ?>
                        </p>
                        <p class="font-normal text-center">
                            <?= $plant->getPrix() ?> MAD
                        </p>
                    </div>
                    <div class=" flex justify-center ">
                        <form action="productAdmin.php" method="post"
                            class=" flex w-[120px] font-semibold bg-green-600 mt-[10px] p-[4px] items-center rounded-[2px]">
                            <input type="hidden" name="product_id" value="<?= $plant->getIdPlant() ?>">
                            <button type="submit" class="cursor-pointer flex" name="basket" value="<?= $plant->getIdPlant() ?>">
                                <p class="text-white text-xs">ADD TO BASKET</p>

                                <svg class=" relative h-5 p-1 text-white duration-200" aria-hidden="true" focusable="false"
                                    data-prefix="far" data-icon="shopping-cart" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                    class="svg-inline--fa fa-shopping-cart fa-w-18 fa-7x">
                                    <path fill="currentColor"
                                        d="M551.991 64H144.28l-8.726-44.608C133.35 8.128 123.478 0 112 0H12C5.373 0 0 5.373 0 12v24c0 6.627 5.373 12 12 12h80.24l69.594 355.701C150.796 415.201 144 430.802 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-18.136-7.556-34.496-19.676-46.142l1.035-4.757c3.254-14.96-8.142-29.101-23.452-29.101H203.76l-9.39-48h312.405c11.29 0 21.054-7.869 23.452-18.902l45.216-208C578.695 78.139 567.299 64 551.991 64zM208 472c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm256 0c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm23.438-200H184.98l-31.31-160h368.548l-34.78 160z"
                                        class=""></path>
                                </svg>
                        </form>

                    </div>
                </div>
            </div>
        <?php endforeach; }?>

    </section>
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
            <h2 class="text-center">Copyright © 2023 Hashtag O'PEP. All Rights Reserved</h2>
        </div>
    </footer>




    <script>
        function burgermenu() {
            const shown = document.querySelector('.sidebar')
            shown.style.display = 'flex'
        }
        function quittemenu() {
            const shown = document.querySelector('.sidebar')
            shown.style.display = 'none'
        }
    </script>


</body>

</html>