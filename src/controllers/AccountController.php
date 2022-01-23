<?php

namespace mywishlist\controllers;

use mywishlist\models\Account;
use Slim\Http\Response;
use Slim\Http\Request;

class AccountController extends Controller {
    public function getRegister($request, $response, $args) {
        $this->container->view->render($response, 'register.php', $args);
        return $response;
    }

    public function postRegister($request, $response, $args) {
        $account = new Account();
        $account->username = trim($_POST['identifiant']);
        $account->email = strtolower(trim($_POST['email']));
        $account->prenom = trim($_POST['prenom']);
        $account->nom = trim($_POST['nom']);
        $account->hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $account->save();
        $_SESSION['login'] = serialize(['email' => $account->email, 'username' => $account->username, 'prenom' => $account->prenom, 'nom' => $account->nom]);
        $args['account'] = $account;
        return $this->redirect($response, 'home', $args);
    }

    public function getLogin($request, $response, $args) {
        $this->container->view->render($response, 'login.php', $args);
        return $response;
    }

    public function postLogin($request, $response, $args) {
        $id = trim($_POST['id']);
        $account = Account::where('email', '=', $id)->orwhere('username', '=', $id)->first();

        if (isset($account) and password_verify($_POST['password'], $account->hash)) {
            $_SESSION['login'] = serialize(['email' => $account->email, 'username' => $account->username, 'prenom' => $account->prenom, 'nom' => $account->nom]);
            $_SESSION['user'] = $account->toArray();
            return $this->redirect($response, 'home');
        } else {
            return $this->redirect($response, 'login');
        }
    }

    public function getAccount($request, $response, $args) {
        if (isset($_SESSION['login'])) {
            $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
            $args['account'] = $account;
        }
        $this->container->view->render($response, 'account.php', $args);
        return $response;
    }

    public function postEditAccount($request, $response, $args) {
        $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
        if ($account->email != $_POST['email'] || $account->prenom != $_POST['prenom'] || $account->nom != $_POST['nom']) {
            $account->email = strtolower(trim($_POST['email']));
            $account->prenom = trim($_POST['prenom']);
            $account->nom = trim($_POST['nom']);
            $account->save();
            unset($_SESSION['login']);
            $_SESSION['login'] = serialize(['email' => $account->email, 'username' => $account->username, 'prenom' => $account->prenom, 'nom' => $account->nom]);
        }
        return $this->redirect($response, 'account');
    }

    public function postChangePassword($request, $response, $args) {
        $account = Account::where('username', '=', unserialize($_SESSION['login'])['username'])->first();
        if (password_verify($_POST['oldPassword'], $account->hash)) {
            $account->hash = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $account->save();
            return $this->redirect($response, 'login');
        } else {
            return $this->redirect($response, 'account');
        }
    }

    public function getLogout(Request $request, Response $response, array $args) {
        session_destroy();
        return $this->redirect($response, 'home');
    }

}