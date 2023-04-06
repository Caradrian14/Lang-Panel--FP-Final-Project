<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Formulario Edición Idioma</title>
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
                <div class="flex justify-center mt-10 ml-12 items-center">
                    <h1 class="m-4 text-center flex-1 text-left text-lg font-bold">Formulario para la Edicion de Idioma</h1>
                    <div class="flex-1"></div>
                </div>
                <div class="flex justify-center w-auto">
                    <form class="mx-12 my-6 p-2 border-solid border-2 border-teal-800" action="/Controller=AdminText&method=storeLang" method="POST">
                        <input type="hidden" name="Controller" value="AdminText">
                        <input type="hidden" name="method" value="updateLang">
                        <input type="hidden" name="idLang" value="<?= $langObject->getId() ?>">
                        <div class="flex items-center text-center p-5">
                            <label class="flex-initial align-middle w-64 p-3" for="abreviationLang">Abreciacion del idioma</label>
                            <input class="flex-initial align-middle p-3 border-solid border-2 border-teal-500" placeholder="Introduce la abrebiacción" type="text" name="abreviationLang" value="<?= $langObject->getTag() ?>" maxlength="3" required>
                        </div>
                        <div class="flex items-center text-center p-5">
                            <label class="flex-initial align-middle w-64 p-3" for="nameLang">Nombre del idioma</label>
                            <input class="flex-initial align-middle p-3 border-solid border-2 border-teal-500" placeholder="Introduce el nombre" type="text" value="<?= $langObject->getName() ?>" name="nameLang" required>
                        </div>
                        <div class="flex justify-center">
                            <input class="p-2 rounded ease-in-out duration-300 border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white" type="submit" value="Guardar Cambio">
                        </div>
                    </form>
                </div>
            </div>
    </main>
    <?php
    include_once("./src/main/project/views/layout/footer.php");
    ?>
    </div>
</body>

</html>