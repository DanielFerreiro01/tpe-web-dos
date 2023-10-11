<?php
require_once 'app/controllers/adminController.php';
// require_once 'app/controllers/authController.php';
require_once 'app/controllers/homeController.php';
require_once 'app/controllers/ryderController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// el router va a leer la action desde el paramtro "action"

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

//  home ->                homeController->showHome();
//  acceso-publico ->      homeController->showAccess();   // En esta entrega del TPE2 los ryders no tienen login, asi que desde el link del home pasan directo al home ryder
//  home repartidor ->     ryderController->showHomeR();
//  finalizar/:ID  ->      ryderController->finishOrder($id);
//  acceso-admin ->        authController->showLoginA();
//  home admin ->          adminController->showHomeA();
//  listar    ->           adminController->showOrders();
//  agregar   ->           adminController->addOrder();
//  eliminar/:ID  ->       adminController->removeOrder($id); 
//  logout ->              authContoller->logout();
//  auth                   authContoller->auth(); // toma los datos del post y autentica al usuario




// parsea la accion Ej: noticia/1 --> ['noticia', 1]
$params = explode('/', $action);

switch ($params[0]) { // en la primer posicion tengo la accion real
    case 'home':
        $controller = new HomeController();
        $controller->showHome();
        break;
    case 'acceso-publico':
        $controller = new RyderController();
        $controller->showHomeR();
        // $controller = new HomeController();
        // $controller->showAccess();
        break;
    // case 'home-ryder':
    //     $controller = new RyderController();
    //     $controller->showHomeR();
    //     break;  
    case 'finalizar':
        $controller = new RyderController();
        $controller->finishOrder($params[0]);
        break;
    case 'acceso-admin':
        $controller = new AuthController();
        $controller->showLoginA();
        break;
    case 'home-admin':
        $controller = new AdminController();
        $controller->showHomeA();
        break;
    case 'listar':
        $controller = new AdminController();
        $controller->showOrders();
        break;
    case 'agregar':
        $controller = new AdminController();
        $controller->addOrder();
        break;
    case 'eliminar':
        $controller = new AdminController();
        $controller->removeOrder($params[0]);
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    
    default: 
        echo "error 404 not found";
        break;
}