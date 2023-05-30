<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Panel de Idiomas</title>
</head>

<body>
    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>

    <main class="lg:flex min-h-screen">
        <?php
        include_once("./src/main/project/views/layout/aside.php");
        ?>

        <div class="flex-1 w-auto">
            <div class="lg:flex lg:justify-center mt-10 ml-12 items-center">
                <div class="flex-1 flex justify-center">
                    <h1 class="text-lg font-bold text-center m-4">Listado de Tags</h1>
                    <a class="m-4 text-sm bg-transparent border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white text-teal-800 font-bold py-2 px-4 rounded w-40" href="/?Controller=front&method=createText">Añadir Nuevo Tag</a>
                </div>

                <form class="lg:flex-1 flex justify-center" action="/Controller=front&method=searcher" method="GET">
                    <input type="hidden" name="Controller" value="front">
                    <input type="hidden" name="method" value="searcher">
                    <input placeholder="Busqueda" class="bg-grey-300 border-solid border-2 border-sky-500 cursor-pointer" type="text" name="searcher" required>
                    <input class="bg-transparent border-solid border-2 border-sky-500 hover:bg-sky-500 hover:text-white text-sky-500 font-bold py-1 px-2 rounded" type="submit" value="Buscar">
                </form>
            </div>

            <div class="flex justify-center">
                <ul>
                    <li class="my-3 rounded-2xl">
                        <div class="min-w-full divide-y divide-gray-200 text-xs lg:text-lg">
                            <table class="w-full table-auto lg:table-auto align-middle text-left">
                                <tr>
                                    <td class="lg:p-2 lg:px-14 w-40 lg:w-52 text-center">
                                        Nombre
                                    </td>
                                    <td class="lg:p-2 lg:px-14 lg:w-16 text-center">Idiomas</td>
                                    <td class="lg:p-2 lg:w-16 text-right">Acción</td>
                                </tr>
                            </table>
                        </div>
                    </li>
                    <?php
                    foreach ($array as $object) {
                    ?>
                        <li class=' p-2 lg:p-0 bg-sky-300 hover:bg-sky-500 ease-in-out duration-300 my-3 rounded-2xl'>
                            <a href="/?Controller=front&method=showLang_Text&tag=<?= key($object) ?>">
                                <div class="lg:min-w-full divide-y divide-gray-200">
                                    <table class="text-xs lg:text-lg w-full table-auto lg:mx-20 text-left">
                                        <tr>
                                            <td class="lg:p-2 lg:px-12 flex justify-start w-40 lg:w-52 inline-block align-middle"><?= key($object) ?></td>
                                            <td class="lg:p-2 lg:px-12 lg:w-16">
                                                <table>
                                                    <tr>
                                                        <?php
                                                        foreach ($arrayLangs as $langObject) {
                                                        ?>
                                                            <td class='border 
                                                            border-slate-700
                                                            lg:p-2
                                                            <?php
                                                            $isTransleted = false;
                                                            foreach ($object[key($object)] as $tagLang) {
                                                                if ($tagLang['langTag'] === $langObject->getTag() && $tagLang['body'] !== '') {
                                                                    $isTransleted = true;
                                                                }
                                                            }
                                                            if ($isTransleted) {
                                                                echo " font-semibold text-black";
                                                            } else {
                                                                echo "text-black/30";
                                                            }
                                                            ?>
                                                            '><?= $langObject->getTag() ?></td>
                                                        <?php } ?>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="lg:p-2 lg:px-12 flex justify-end lg:w-16">
                                                <a class="delete" href="/?Controller=text&method=destroyText&textTag=<?= key($object) ?>">
                                                    <i class="fa fa-trash" style="font-size:36px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                        </li></a>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="container mx-auto text-center m-5">
                <?php
                for ($i = 1; $i <= $total_paginas; $i++) {
                ?>
                    <a class="p-2 border-solid border-2 border-black
                    <?php
                    if ((int)$page === $i) {
                        echo "bg-sky-800 text-white";
                    } else {
                        echo "bg-sky-500/50";
                    }
                    ?>
                    m-2" href="/?Controller=front&method=getAll&page=<?= $i ?>"><?= $i ?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
    <?php
    include_once("./src/main/project/views/layout/footer.php");
    ?>
</body>

</html>