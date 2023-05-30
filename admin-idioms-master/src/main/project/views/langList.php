<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Demo de presentacion del panel</title>
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
            <div class="flex mt-10 ml-12 items-center">
                <div class="flex-1 flex justify-center">
                    <h1 class="m-4 text-lg font-bold text-center">Listado de Idiomas</h1>
                    <a class="m-4 text-sm bg-transparent border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white text-teal-800 font-bold py-2 px-4 rounded w-40 text-center" href="/?Controller=front&method=createLang">Añadir Idioma</a>
                </div>
                <div class="flex-1"></div>
            </div>

            <div class="p-9 flex justify-center">
                <ul>
                    <h1 class="text-lg font-bold mb-4">Idiomas Disponibles</h1>
                    <?php
                    foreach ($arrayLangs as $langs) {
                    ?>
                        <a class="" href="/?Controller=front&method=editLang&tag=<?= $langs->getTag() ?>">
                            <li class="bg-sky-300 my-3 rounded-2xl w-full mb-8 hover:bg-sky-500 ease-in-out duration-300 animation-expanded">
                                <div class="">
                                    <table class="table-auto mx-18 text-left">
                                        <tr>
                                            <td class="p-2 px-5 py-6 lg:px-12 flex justify-start lg:w-64 w-44">
                                                <span class="justify-start"><?= $langs->getName() ?></span>
                                            </td>
                                            <td class="p-2 lg:px-12 w-16">
                                                <span class=""><?= $langs->getTag() ?></span>
                                            </td>
                                            <td class="p-2 lg:px-12 px-8 flex justify-end w-16">
                                                <a class="delete" href="/?Controller=front&method=destroyLang&tag=<?= $langs->getTag() ?>">
                                                    <i class="fa fa-trash justify-end" style="font-size:24px"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
                        </a>
                    <?php
                    }
                    ?>
                </ul>
            </div>

        </div>
    </main>
    <?php
    include_once("./src/main/project/views/layout/footer.php");
    ?>
</body>

</html>