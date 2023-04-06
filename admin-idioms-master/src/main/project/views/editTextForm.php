<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Edicion de Tags</title>
</head>

<body>
    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>
    <main>
        <div class="flex full-screen">
            <?php
            include_once("./src/main/project/views/layout/aside.php");
            ?>
            <div class="flex-1 w-auto">
                <div class="flex justify-center  mt-10 ml-12 items-center">
                    <h1 class="m-4 text-center flex-1 text-left text-lg font-bold">Formulario para la Edicion de Tag</h1>
                    <div class="flex-1"></div>
                </div>
                <div class="flex justify-center w-auto">
                    <form action="/Controller=AdminText&method=updateTextTag" class="mx-12 my-6 p-2 border-solid border-2 border-teal-800" method="POST">
                        <input type="hidden" name="Controller" value="AdminText">
                        <input type="hidden" name="method" value="updateTextTag">
                        <input type="hidden" name="id" value="<?= $text->getId() ?>">

                        <div class="flex justify-center p-5">
                            <label class="p-3" for="textTag">Nombre de la Etiqueta</label>
                            <input placeholder="Introduce el nombre del Tag" class="p-3 border-solid border-2 border-teal-500" name="textTag" type="text" value="<?= $text->getTag() ?>">
                        </div>

                        <div class="flex justify-center p-5">
                            <div>
                                <h4>Actvio para verse, desactivado para que no se pueda ver aun</h4>
                                <?php
                                if ($text->getActive() === 1) {
                                ?>
                                    <label class="p-3" for="active"><input type="radio" name="active" value="1" checked required> Activado</label>
                                    <label class="p-3" for="active"><input type="radio" name="active" value="0"> Desactivado</label>
                                <?php

                                } else {
                                ?>
                                    <label class="p-3" for="active"><input type="radio" name="active" value="1" required> Activado</label>
                                    <label class="p-3" for="active"><input type="radio" name="active" value="0" checked> Desactivado</label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <input class="p-2 rounded ease-in-out duration-300 border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white" type="submit" value="Guardar Cambio">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php
    include_once("./src/main/project/views/layout/footer.php");
    ?>
</body>

</html>