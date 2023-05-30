<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('./src/main/project/views/layout/head.php'); ?>
    <title>Show Tag</title>
</head>

<body>

    <?php
    include_once("./src/main/project/views/layout/header.php");
    ?>

    <main class="lg:flex min-h-screen">
        <?php
        include_once("./src/main/project/views/layout/aside.php");
        ?>
        <div class="flex-1 w-auto content-center p-5">
            <div class="lg:flex lg;justify-center font-bold mt-10 ml-12 items-center">
                <div class="flex lg:justify-center flex-1">
                    <div class="flex-initial text-xl m-4">
                        <h1>Tag: <?= $tagName ?></h1>
                        <h4>Estado:
                            <?php
                            if ($textRowSql['active'] === 1) {
                                echo 'Activado';
                            } else {
                                echo 'Desactivado';
                            }
                            ?>
                        </h4>
                    </div>
                    <div>
                        <a class="flex-initial m-2 lg:m-4 p-2 lg:p-4 border-solid border-2 rounded-md border-teal-800 hover:bg-teal-800 hover:text-white ease-in duration-300 w-44 lg:w-auto flex justify-center items-center text-center" href="/?Controller=front&method=editText&tagText=<?= $tagName ?>">Editar Tag</a>
                    </div>
                </div>
                <div class="flex-1"></div>
            </div>

            <div class="flex justify-center">
                <form action="/" method="POST">
                    <input type="hidden" name="Controller" value="front">
                    <input type="hidden" id="methodLang_Text" name="method" value="updateAllLang_TextByTag">
                    <input type="hidden" name="tag" value="<?= $tagName ?>">
                    <?php
                    foreach ($arrayLang as $elementLang) { ?>
                        <div class="lg:flex m-2 lg:m-0 lg:items-center h-fit lg:text-center p-3 lg:p-5">
                            <label class="flex-1 lg:flex-initial align-middle p-3 w-full lg:w-44 lg:font-bold text-sm lg:text-based" for="arrayLang_Text[]"><?= $elementLang['name'] ?></label>
                            <textarea class="flex-1 lg:flex-initial w-full lg:w-auto align-middle p-3 border-solid border-2 border-teal-800" name="arrayLang_Text[]" rows="2"><?php
                                                                                                                                                                                foreach ($array as $text_LangElement) {
                                                                                                                                                                                    if ($elementLang['tag'] === $text_LangElement['langTag']) {
                                                                                                                                                                                ?> <?= $text_LangElement['body'] ?><?php
                                                                                                                                                                                                }
                                                                                                                                                                                            }
                                                                                                                                                                                                    ?></textarea>
                        </div>
                    <?php }
                    ?>
                    <div class="flex justify-center">
                        <button class="p-3 mx-4 border-solid border-2 rounded-md border-teal-500 hover:bg-teal-500 hover:text-white ease-in duration-300 flex justify-center cursor-pointer" type="submit">Guardar</button>
                        <button id="showLangTextSaveAndExit" class="p-3 mx-4 border-solid border-2 rounded-md border-sky-500 hover:bg-sky-500 hover:text-white ease-in duration-300 flex justify-center cursor-pointer" type="submit">Guardar y Volver</button>
                        <a class="p-3 mx-4 border-solid border-2 rounded-md border-amber-500 hover:bg-amber-500 hover:text-white ease-in duration-300 flex justify-center cursor-pointer" href="/?Controller=front&method=getAll">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    include_once("./src/main/project/views/layout/footer.php");
    ?>
</body>

</html