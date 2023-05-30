<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Creacion de Tags</title>
</head>

<body>
    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>
    <main>
        <div class="lg:flex mt-3 full-screen">
            <?php
            include_once("./src/main/project/views/layout/aside.php");
            ?>
            <div class="flex-1 w-auto">
                <div class="mt-3 flex justify-center items-center">
                    <h1 class="m-2 lg:m-4 text-center flex-1 text-left text-lg font-bold">Formulario para la Creación de Tag</h1>
                </div>
                <div class="flex justify-center w-auto">
                    <form class="mx-12 my-6 lg:p-2 pb-2 border-solid border-2 border-teal-800" action="/Controller=front&method=storeText" method="POST">
                        <input type="hidden" name="Controller" value="front">
                        <input type="hidden" name="method" value="storeText">
                        <div class="flex justify-center p-5">
                            <label class="p-3" for="textTag">Nombre de la Etiqueta</label>
                            <input placeholder="Introduce el nombre del Tag" class="p-3 border-solid border-2 border-teal-500" type="text" name="textTag" required>
                        </div>

                        <div class="flex justify-center p-5">
                            <div>
                                <h4>Actvio para verse, desactivado para que no se pueda ver aun</h4>
                                <label class="p-3" for="active"><input type="radio" name="active" value="1" selected required> Activado</label>
                                <label class="p-3" for="active"><input type="radio" name="active" value="0"> Desactivado</label>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <input class="p-2 rounded ease-in-out duration-300 border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white" type="submit" value="Añadir Tag">
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