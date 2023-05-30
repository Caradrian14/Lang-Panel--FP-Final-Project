<?PHP
require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/router.php');
/**
 * Creamos el enrutador que identificara las url y las procesara
 */
$router = new Router();
$router->matchRouter();