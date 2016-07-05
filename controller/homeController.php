<?php

require_once 'model/db.class.php';

/**
 * klasa za upravljanje početnom stranicom
 */
class HomeController extends BaseController {
    
    /**
     * popunjava odgovarajući template sa svim blogovima
     */
    public function index() {
        $us = new UserService();		
		
        // Popuni template potrebnim podacima
        $this->registry->template->title = 'Popis svih blogova';
        $this->registry->template->userList = $us->getAllUsers();
        $this->registry->template->show('index');
    }
    
    /**
     * logiranje korisnika
     * 
     * @return void
     */
    public function login() {

        if (empty($_POST)) {
            // forma nije pravilno submitana
            $this->redirect('home/index');
        }
        // Provjeri je li dobar username; ako ne, crtaj login formu.
        if (!isset($_POST["username"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["username"])) {
            $this->registry->template->errorMessage = "Unesite ispravan username";
            $this->index();
            return;
        }

        // Provjeri je li dobar password.
        if (!isset($_POST["password"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["password"])) {
            $this->registry->template->errorMessage = "Unesite ispravan password";
            $this->index();
            return;
        }
        //Sve je dobro unešeno, login-aj korisnika.
        $us = new UserService();
        try {
            $user = $us->loginUser($_POST['username'], $_POST['password']);
            $_SESSION['user'] = $user;
            $this->registry->template->currentUser = $_SESSION['user'];
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
        }

        $this->redirect('home/index');
    }

    /**
     * logout korisnika
     * 
     */
    public function logout() {
        unset($_SESSION['user']);
        $this->redirect('home/index');
    }

    /**
     * register korisnika
     * 
     * @return type
     */
    public function register() {
        if (empty($_POST)) {
            // forma nije pravilno submitana
            $this->redirect('home/index');
        }
        // Provjeri je li dobar username
        if (!isset($_POST["username"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["username"])) {
            $this->registry->template->errorMessage = "Unesite username u ispravnom obliku";
            $this->index();
            return;
        }
        //Provjeri je li dobar email
        if (!isset($_POST["email"]) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/', $_POST["email"])) {
            $this->registry->template->errorMessage = "Unesite email u ispravnom obliku";
            $this->index();
            return;
        }
        // Provjeri je li dobar password.
        if (!isset($_POST["password"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["password"])) {
            $this->registry->template->errorMessage = "Unesite password u ispravnom obliku";
            $this->index();
            return;
        }
        //Provjeri je li dobar fist_name
        if (!isset($_POST["first_name"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["first_name"])) {
            $this->registry->template->errorMessage = "Unesite ime u ispravnom obliku";
            $this->index();
            return;
        }
        //Provjeri je li dobar last_name
        if (!isset($_POST["last_name"]) || !preg_match('/[a-zA-Z0-9]{1,45}/', $_POST["last_name"])) {
            $this->registry->template->errorMessage = "Unesite prezime u ispravnom obliku";
            $this->index();
            return;
        }
        //Provjeri je li dobar blog_name
        if (!isset($_POST["blog_name"]) || !preg_match('/[a-zA-Z0-9]{1,100}/', $_POST["blog_name"])) {
            $this->registry->template->errorMessage = "Unesite ime bloga u ispravnom obliku";
            $this->index();
            return;
        }
        //Sve je dobro unešeno, registriraj novog korisnika. 
        $us = new UserService();
        try {
            $us->registerUser($_POST['username'], $_POST['password'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['blog_name']);
            $this->redirect('home/index');
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }

}

?>