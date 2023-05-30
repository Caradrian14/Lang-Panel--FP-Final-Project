<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Formulario Idiomas</title>
</head>

<body>
    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>
    <main>
        <div class="lg:flex full-screen">
            <?php
            include_once("./src/main/project/views/layout/aside.php");
            ?>
            <div class="flex-1 lg:min-h-screen w-auto">
                <div class="flex justify-center lg:mt-10 lg:ml-12 items-center">
                    <h1 class="m-4 text-center flex-1 text-left text-lg font-bold">Formulario para la creacion de Idioma</h1>
                    <div class="lg:flex-1"></div>
                </div>
                <div class="flex justify-center w-auto">
                    <form class="mx-12 my-6 p-2 border-solid border-2 border-teal-800" action="/Controller=front&method=storeLang" method="POST">
                        <input type="hidden" name="Controller" value="front">
                        <input type="hidden" name="method" value="storeLang">
                        <div class="lg:flex lg:justify-center text-center p-5">
                            <label class="lg:flex-initial align-middle w-64 p-3" for="textTag">Abreciacion del idioma</label>
                            <input class="flex-initial align-middle p-3 border-solid border-2 border-teal-500" placeholder="Introduce la abrebiacción" type="text" name="textTag" maxlength="3" required>
                        </div>
                        <div class="lg:flex lg:justify-center text-center p-5">
                            <label class="lg:flex-initial align-middle w-64 p-3" for="name">Nombre del idioma</label>
                            <input class="lg:flex-initial align-middle p-3 border-solid border-2 border-teal-500" placeholder="Introduce el nombre" type="text" name="name" required>
                        </div>

                        <div class="flex justify-center">
                            <input class="p-2 rounded ease-in-out duration-300 border-solid border-2 border-teal-800 hover:bg-teal-800 hover:text-white cursor-pointer" type="submit" value="Guardar Idioma">
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