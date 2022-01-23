<?php
use mywishlist\controllers\AccountController;
use mywishlist\controllers\ItemController;
use mywishlist\controllers\ListController;
use mywishlist\config\Database;
use Slim\Views\PhpRenderer;
use Slim\Http\Response;
use Slim\Http\Request;

require 'vendor/autoload.php';

Database::Init();

$app = new Slim\App();
$container = $app->getContainer();

$container['view'] = function($container) {
    $vars = [
        "rootUri" => $container->request->getUri()->getBasePath(), // Path du projet
        "router" => $container->router
    ];
    $renderer = new PhpRenderer(__DIR__.'/src/views', $vars);
    $renderer->setLayout('layout.php');
    return $renderer;
};

$app->get('/', function($request, $response, $args) {
    $this->view->render($response, 'home.php');
})->setName('home');

// REGISTER

$app->get('/register', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->getRegister($request, $response, $args);
})->setName('register');

$app->post('/register', function(Request $request, Response $response, array $args) {
    $controller = new AccountController($this);
    return $controller->postRegister($request, $response, $args);
});

// LOG IN

$app->get('/login', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->getLogin($request, $response, $args);
})->setName('login');

$app->post('/login', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->postLogin($request, $response, $args);
});

// LOG OUT

$app->get('/logout', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->getLogout($request, $response, $args);
})->setName('logout');

// ACCOUNT

$app->get('/account', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->getAccount($request, $response, $args);
})->setName('account');

$app->post('/editAccount', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->postEditAccount($request, $response, $args);
})->setName('editAccount');

$app->post('/changePass', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->postChangePassword($request, $response, $args);
})->setName('changePassword');

$app->post('/deleteAccount', function($request, $response, $args) {
    $controller = new AccountController($this);
    return $controller->postDeleteAccount($request, $response, $args);
})->setName('deleteAccount');

$app->post('/newPassword', function(Request $request, Response $response, array $args) {
    $controller = new AccountController($this);
    return $controller->newPassword($request, $response, $args);
});

// LISTES

$app->get('/allItems', function(Request $request, Response $response, array $args) {
    $controller = new ItemController($this);
    return $controller->displayAllItems($request, $response, $args);
})->setName('allItems');

$app->get('/publicLists', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->displayPublicLists($request, $response, $args);
})->setName('publicLists');

$app->get('/list/{token}', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->displayList($request, $response, $args);
})->setName('list');

$app->get('/createList', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->getNewList($request, $response, $args);
})->setName('newList');

$app->post('/createList', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->postNewList($request, $response, $args);
});

$app->get('/editList/{token}', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->getEditList($request, $response, $args);
})->setName('editList');

$app->post('/modifierListe/{token}', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->postEditList($request, $response, $args);
});

$app->get('/mesListes', function(Request $request, Response $response, array $args) {
    $controller = new ListController($this);
    return $controller->displayAccountLists($request, $response, $args);
})->setName('accountLists');

$app->get('/ajouterItem/{token}', function($request, $response, array $args) {
    $controller = new ItemController($this);
    return $controller->getNewItem($request, $response, $args);
})->setName('newItem');

$app->post('/ajouterItem/{token}', function(Request $request, Response $response, array $args) {
    $controller = new ItemController($this);
    return $controller->postNewItem($request, $response, $args);
});

session_start();
$app->run();