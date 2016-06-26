<?php

require_once 'model/db.class.php';

class HomeController extends BaseController {

    public function index() {
        $us = new UserService();
        // Popuni template potrebnim podacima
        $this->registry->template->title = 'Popis svih blogova';
        $this->registry->template->userList = $us->getAllUsers();

        $this->registry->template->show('index');
    }

    public function login() {

        if( empty($_POST)) {
            // forma nije pravilno submitana
            $this->redirect('home/index');
        }
        // Provjeri je li dobar username; ako ne, crtaj login formu.
        if (!isset($_POST["username"]) || preg_match('/[a-zA-Z0-9]{1, 45}/', $_POST["username"])) {
            $this->registry->template->errorMessage = "Unesite ispravan username";
            $this->index();
            return;
        }

        // Provjeri je li dobar password.
        if (!isset($_POST["password"]) || preg_match('/[a-zA-Z0-9]{1, 45}/', $_POST["username"])) {
            $this->registry->template->errorMessage = "Unesite ispravan password";
            $this->index();
            return;
        }

        $us = new UserService();
        try {
            $user = $us->loginUser($_POST['username'], $_POST['password']);
            $_SESSION['user'] = $user;
            $this->registry->template->currentUser = $_SESSION['user'];
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
        }

        $this->index();
        return;
    }

    public function logout() {
        unset($_SESSION['user']);
        $this->redirect('home/index');
    }

}

;
?>