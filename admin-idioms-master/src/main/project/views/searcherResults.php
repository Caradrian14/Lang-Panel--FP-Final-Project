<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Busqueda</title>
</head>

<body>
    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>

    <main class="flex min-h-screen">
        <?php
        include_once("./src/main/project/views/layout/aside.php");
        ?>
        <div class="flex-1 w-auto">
            <div class="flex mt-10 ml-12 items-center">
                <div class="flex-1">
                    <h1 class="text-lg font-bold text-center">Resultados De la Busqueda</h1>
                </div>


                <form class="flex-1" action="/Controller=AdminText&method=searcher" method="GET">
                    <input type="hidden" name="Controller" value="AdminText">
                    <input type="hidden" name="method" value="searcher">
                    <input value="<?= $searcher ?>" placeholder="Busqueda" class="bg-grey-300 border-solid border-2 border-teal-800" type="text" name="searcher" required>
                    <input class="bg-transparent border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white text-teal-800 font-bold py-2 px-4 rounded" type="submit" value="Buscar">
                </form>
            </div>
            <div class="flex justify-center">
                <?php
                if (empty($results)) {
                ?>
                    <h4>No hay resultados para esta busqueda</h4>';
                <?php
                } else {
                ?>
                    <ul>
                        <li class="my-3 rounded-2xl">
                            <div class="min-w-full divide-y divide-gray-200">
                                <table class="table-auto mx-20 text-center">
                                    <tr>
                                        <td class="p-2 px-12 flex justify-start w-48">
                                            Tag
                                        </td>
                                        <td class="p-2 px-12 w-48">
                                            Idioma
                                        </td>
                                        <td class="p-2 px-12 w-48">
                                            Cuerpo
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </li>
                        <?php
                        foreach ($results as $elements) {
                        ?>

                            <li class="bg-sky-300 my-3 rounded-2xl">
                                <a href="/?Controller=AdminText&method=showLang_Text&tag=<?= $elements['textId'] ?>">
                                    <div class="min-w-full divide-y divide-gray-200">
                                        <table class="table-auto mx-20 text-center">
                                            <tr>
                                                <td class="p-2 px-12 flex justify-start w-48">
                                                    <?= $elements['textId'] ?>
                                                </td>
                                                <td class="p-2 px-12 w-48">
                                                    <?= $elements['langTag'] ?>
                                                </td>
                                                <td class="p-2 px-12 w-48">
                                                    <?= $elements['body'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </a>
                            </li>

                        <?php
                        }
                        ?>
                    </ul>
                <?php
                }
                ?>
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
                    m-2" href="/?Controller=AdminText&method=searcher&searcher=<?= $searcher ?>&page=<?= $i ?>"><?= $i ?></a>
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