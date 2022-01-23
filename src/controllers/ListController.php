<?php

namespace mywishlist\controllers;

use mywishlist\models\Account;
use mywishlist\models\Liste;
use mywishlist\models\Message;
use Slim\Exception\NotFoundException;
use Slim\Http\Response;
use Slim\Http\Request;

class ListController extends Controller {

    public function displayPublicLists(Request $request, Response $response, array $args) {
        $lists = Liste::select('*')->where('expiration', '>=', date('Y-m-d H:i:s', strtotime("-1 days")))->where('public', true)->orderBy('expiration', 'asc')->get();
        $args['lists'] = $lists;
        $this->container->view->render($response, 'publicLists.php', $args);
        return $response;
    }

    public function displayList(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        if (is_null($list))
            throw new NotFoundException($request, $response);
        $items = $list->items();
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $args['account'] = $account;
        }
        $args['list'] = $list;
        $args['items'] = $items;
        $this->container->view->render($response, 'list.php', $args);
        return $response;
    }

    public function getNewList(Request $request, Response $response, array $args) {
        $this->container->view->render($response, 'newList.php', $args);
        return $response;
    }

    public function postNewList(Request $request, Response $response, array $args) {
        $list = new Liste();
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $list->user_id = $account->id;
        } else {
            $list->user_id = null;
        }
        $list->titre = trim($_POST['titre']);
        $list->description = trim($_POST['description']);
        $list->expiration = date("Y-m-d", strtotime($_POST['expiration']));
        $token = Liste::generateToken();
        $list->token = $token;
        $list->public = isset($_POST['public']) ? 1 : 0;
        $list->save();

        $newList = Liste::where('token', '=', $token)->first();
        $args['token'] = $newList->token;
        return $this->redirect($response, 'list', $args);
    }

    public function getEditList(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        $items = $list->items();
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $args['account'] = $account;
        }
        $args['list'] = $list;
        $args['items'] = $items;
        $this->container->view->render($response, 'editList.php', $args);
        return $response;
    }

    public function postEditList(Request $request, Response $response, array $args) {
        $list = Liste::where('token', '=', $args['token'])->first();
        if ($_POST['submit'] == 'edit') {
            if (strtotime($list->expiration) > strtotime("-1 days")) {
                $list->titre = trim($_POST['titre']);
                $list->description = trim($_POST['description']);
                $list->expiration = date("Y-m-d", strtotime($_POST['expiration']));
                $list->public = isset($_POST['public']) ? 1 : 0;
                $list->save();
            } else {
                $list->public = isset($_POST['public']) ? 1 : 0;
                $list->save();
            }
            $args['token'] = $list->token;
            return $this->redirect($response, 'list', $args);
        } elseif ($_POST['submit'] == 'delete') {
            $list->delete();
            return $this->redirect($response, 'accountLists', $args);
        }
    }

    public function displayAccountLists(Request $request, Response $response, array $args) {
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $lists = Liste::where('user_id', '=', $account->id)->orderBy('expiration', 'asc')->get();
            $args['account'] = $account;
            $args['lists'] = $lists;
        }
        $this->container->view->render($response, 'accountLists.php', $args);
        return $response;
    }
}