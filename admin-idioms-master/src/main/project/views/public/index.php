<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" async></script>
    <script src="src/main/resources/js/publicScript.js" async></script>
    <link rel="stylesheet" href="src/main/resources/css/publicStyle.css">
    <title>Chocolutia</title>
</head>

<body>
    <header>
        <nav class="flex bg-amber-900 text-white items-center text-2xl">
            <h1 class="flex-initial w-auto text-yellow-500 px-4 m-4 text-4xl">Chocolutia</h1>
            <ul class=" flex-auto flex justify-center w-auto text-center items-center mx-12">
                <a href="#" class="px-4 m-4">
                    <li class=""><?=$arrayTextLangs['landing_nav1']->getBody()?></li>
                </a>
                <a href="#" class="px-4 m-4">
                    <li><?=$arrayTextLangs['landing_nav2']->getBody()?></li>
                </a>
                <a href="#" class="px-4 m-4">
                    <li><?=$arrayTextLangs['landing_nav3']->getBody()?></li>
                </a>
            </ul>

            <a href="/?Controller=AdminText&method=getAll" class="flex-initial w-32 px-4 m-4 text-center items-center">Admin</a>

            <!-- <h1 class="flex-initial w-32 px-4 m-4 items-center">Selecciona idiomas</h1> -->
            <div class="flex-initial relative">
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-yellow-500 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-yellow-500 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800" type="button">Seleccionar Idioma
                    <svg class="w-3 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="absolute z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <?php
                        foreach ($arrayLangs as $lang) {
                        ?>
                            <li>
                                <a href="?Controller=AdminText&method=goLanding&lang=<?=$lang->getTag()?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?=$lang->getName()?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="bg-amber-950 ">
        <div class="relative h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/choco.jpg');">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
            <div class="absolute bottom-0 left-0 p-4 m-12">
                <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_welcome']->getBody()?></h1>
            </div>
        </div>

        <div class="text-white h-auto">
            <h1 class="text-3xl text-bold p-4 m-4"><?=$arrayTextLangs['landing_highlight_articles']->getBody()?></h1>
            <div class="flex p-12">
                <div class="flex-1 mx-12">
                    <div class="relative w-auto h-64 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/flujo-del-chocolate.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_milk_chocolate']->getBody()?></h1>
                        </div>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta laboriosam, quae porro voluptatibus repellendus
                        pariatur! Doloribus nihil, rerum quibusdam beatae incidunt dolorum perspiciatis provident expedita blanditiis
                        temporibus consequuntur architecto vitae!</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis laboriosam reprehenderit velit inventore cum possimus, fugiat veritatis molestias, sed assumenda minus sapiente id dolore laudantium voluptatem consectetur soluta necessitatibus voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eius magnam vero dolorum debitis necessitatibus, impedit nisi quibusdam accusamus corrupti esse nemo maxime iste ipsum culpa officia explicabo veniam natus!</p>
                </div>
                <div class="flex-1 mx-12">
                    <div class="relative w-auto h-64 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/stock-photo-liquid-chocolate.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_chocolate_hazelnuts']->getBody()?></h1>
                        </div>
                    </div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet, dolore deleniti ipsum cupiditate, minus deserunt dolor a sapiente suscipit enim perferendis optio qui ducimus eum debitis. Excepturi assumenda numquam maxime?</p>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis laboriosam reprehenderit velit inventore cum possimus, fugiat veritatis molestias, sed assumenda minus sapiente id dolore laudantium voluptatem consectetur soluta necessitatibus voluptates? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci eius magnam vero dolorum debitis necessitatibus, impedit nisi quibusdam accusamus corrupti esse nemo maxime iste ipsum culpa officia explicabo veniam natus!</p>
                </div>
            </div>
        </div>


        <div class="text-white bg-amber-600 h-auto">
            <h1 class="text-3xl text-bold p-4 m-4"><?=$arrayTextLangs['landing_last_articles']->getBody()?></h1>
            <div class="flex mx-24">
                <div class="flex-1 mx-8 my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/blanco.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 w-auto text-center left-0 p-4 m-12">
                            <h1 class="text-white text-2xl font-bold text-center"><?=$arrayTextLangs['landing_white_chocolate']->getBody()?></h1>
                        </div>
                    </div>
                </div>
                <div class="flex-1 mx-8  my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/flujo-del-chocolate.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12 w-auto text-center">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_chocolate_hazelnuts']->getBody()?></h1>
                        </div>
                    </div>
                </div>
                <div class="flex-1 mx-8  my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/choco.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12 w-auto text-center">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_choco_nut']->getBody()?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex mx-24">
                <div class="flex-1 mx-8 my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/caramelo-chocolate.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12 w-auto text-center">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_choco_caramel']->getBody()?></h1>
                        </div>
                    </div>
                </div>
                <div class="flex-1 mx-8  my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/fudge-de-chocolate-y-naranja.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12 w-auto text-center">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_choco_orange']->getBody()?></h1>
                        </div>
                    </div>
                </div>
                <div class="flex-1 mx-8  my-8">
                    <div class="relative w-auto h-80 bg-cover bg-center" style="background-image: url('/src/main/resources/media/img/flujo-del-chocolate.jpg');">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50"></div>
                        <div class="absolute bottom-0 left-0 p-4 m-12 w-auto text-center">
                            <h1 class="text-white text-2xl font-bold"><?=$arrayTextLangs['landing_choco_nut']->getBody()?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-amber-900 text-white">
        <div class="flex p-8 text-xl">
            <div class="flex-1">
                <h1 class="w-auto text-yellow-500 px-4 m-4 text-4xl">Chocolutia</h1>
                <ul class="px-4 m-4">
                    <li><?=$arrayTextLangs['landing_telephone']->getBody()?>: 965562145</li>
                    <li><?=$arrayTextLangs['landing_mail']->getBody()?>: choco@sollutia.com</li>
                    <li><?=$arrayTextLangs['landing_address']->getBody()?>: C/ de la Amargura nº1, Alicante</li>
                </ul>
            </div>

            <div class="flex-1 text-center px-4 m-8">
                <ul>
                    <li>
                        <h4 class="underline decoration-solid"><?=$arrayTextLangs['landing_explore']->getBody()?></h4>
                    </li>
                    <li><a href="#">Home</a></li>
                    <li><a href="#"><?=$arrayTextLangs['landing_nav1']->getBody()?></a></li>
                    <li><a href="#"><?=$arrayTextLangs['landing_nav2']->getBody()?></a></li>
                    <li><a href="#"><?=$arrayTextLangs['landing_nav3']->getBody()?></a></li>
                </ul>
            </div>

            <div class="flex-1 text-center px-4 m-8">
                <ul>
                    <li>
                        <h4 class="underline decoration-solid"><?=$arrayTextLangs['landing_follow']->getBody()?></h4>
                    </li>
                    <li><a href="#">Tweeter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Linkedin</a></li>
                    <li><a href="#">facebook</a></li>
                </ul>
            </div>

            <div class="flex-1 text-center px-4 m-8">
                <ul>
                    <li>
                        <h4 class="underline decoration-solid text-lg"><?=$arrayTextLangs['landing_politics']->getBody()?></h4>
                    </li>
                    <li>Derechos Reservados</li>
                    <li>Desarrollado por Sollutia</li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>