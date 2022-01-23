<?php

namespace mywishlist\controllers;

use mywishlist\models\Account;
use mywishlist\models\Cagnotte;
use mywishlist\models\Item;
use mywishlist\models\Liste;
use Slim\Exception\NotFoundException;
use Slim\Http\Response;
use Slim\Http\Request;

class ItemController extends Controller {
    public function displayItem(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        $item = Item::where('id', '=', $args['id'])->first();
        $reserveName = "";
        if (is_null($list) || is_null($item))
            throw new NotFoundException($request, $response);

        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $args['account'] = $account;
        }
        $args['list'] = $list;
        $args['item'] = $item;
        $this->container->view->render($response, 'item.php', $args);
        return $response;
    }
	
    public function displayAllItems(Request $request, Response $response, array $args) {
        $allItems = Item::all();
        $this->container->view->render($response, 'allItems.php', $args);
        return $response;
    }

    public function getNewItem(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
		$allItems = Item::all();
        $args['list'] = $list;
        $args['allItems'] = $allItems;
        $this->container->view->render($response, 'newItem.php', $args);
        return $response;
    }

    public function postNewItem(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        $item = new Item();
        $item->liste_id = $list->num;
        $item->nom = trim($_POST['nom']);
        $item->descr = trim($_POST['descr']);

        //Image upload
        $fileName = $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileSize = $_FILES['img']['size'];
        $fileError = $_FILES['img']['error'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $NewFileName = $fileExt[0].'-'.$list->num.'-'.Liste::generateToken().'.'.$fileActualExt;

        $allowed = ['jpg', 'jpeg', 'png'];
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                // 10 Mo
                if ($fileSize < 10000000) {
                    $fileDestination = "./public/images/".$NewFileName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $item->img = $NewFileName;
                }
            }
        }
        if($item->img != $NewFileName or $item->img == '') {
            $item->img = 'noimage.png';
        }

        if (isset($_POST['url'])) {
            $item->url = trim($_POST['url']);
        }
        $item->tarif = trim($_POST['tarif']);
        $item->save();
        $args['token'] = $list->token;
        return $this->redirect($response, 'list', $args);
    }

    public function getEditItem(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        $item = Item::where('id', '=', $args['id'])->first();
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $args['account'] = $account;
        }
        $args['list'] = $list;
        $args['item'] = $item;
        $this->container->view->render($response, 'editItem.php', $args);
        return $response;
    }

    public function postEditItem(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        $item = Item::where('id', '=', $args['id'])->first();
        $args['token'] = $list->token;


        if ($_POST['submit'] == 'edit') {
            $item->nom = trim($_POST['nom']);
            $item->descr = trim($_POST['description']);
            $item->tarif = trim($_POST['tarif']);

            if (isset($_POST['delete'])) {
                $item->img = 'noimage.png';
            } else {
                //Image upload
                $fileName = $_FILES['img']['name'];
                $fileTmpName = $_FILES['img']['tmp_name'];
                $fileSize = $_FILES['img']['size'];
                $fileError = $_FILES['img']['error'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $NewFileName = $fileExt[0].'-'.$list->num.'-'.Liste::generateToken().'.'.$fileActualExt;

                $allowed = ['jpg', 'jpeg', 'png'];
                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        // 10 Mo
                        if ($fileSize < 10000000) {
                            $fileDestination = "./public/images/".$NewFileName;
                            move_uploaded_file($fileTmpName, $fileDestination);
                            $item->img = $NewFileName;
                        }
                    }
                }
            }

            $item->url = isset($_POST['url']) ? trim($_POST['url']) : '';
            $item->save();
            $args['id'] = $item->id;
            return $this->redirect($response, 'item', $args);
        } elseif ($_POST['submit'] == 'delete') {
            $item->delete();
            return $this->redirect($response, 'list', $args);
        }
    }

}