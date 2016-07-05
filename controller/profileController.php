<?php

require_once 'model/db.class.php';

/**
 * klasa za upravljanje profilom korisnika
 */
class ProfileController extends BaseController {

    /**
     * popunjava template s postovima korisnika i redirecta na profil korisnika
     */
    public function index() {
        if (empty($_SESSION['user'])) {
            // User nije ulogiran
            $this->redirect('/');
        }

        $ps = new PostService();

        // Popuni template potrebnim podacima
        $this->registry->template->title = 'Moji postovi';
        $this->registry->template->postList = $ps->getPostsByUser($_SESSION['user']->id);
        $this->registry->template->show('profile');
    }

    /**
     * otvaranje stranice za kreiranje novog posta
     * 
     */
    public function newpost() {
        $this->registry->template->show('new_post');
    }

    /**
     * otvaranje stranice za editiranje posta
     * 
     */
    public function edit() {
        //provjeri nalazi li se u $_GET id profila koji se zeli edititrati
        if (empty($_GET['pid'])) {
            $this->redirect('/profile/index');
        }

        $ps = new PostService();
        $post = $ps->getPostById($_GET['pid']);

        $this->registry->template->post = $post;
        $this->registry->template->show('post_edit');
    }

    //?????
    public function delete() {
        $pid = $_GET['pid'];
    }

    /**
     * spremanje posta (novog ili vec postojeceg promijenjenog)
     * 
     * @return void ako dode do greške
     */
    function savePost() {
        if (empty($_POST)) {
            // Forma nije pravilno submitana.
            $this->redirect('profile/newpost');
        }

        //Provjeri je li dobar title
        if (!isset($_POST["title"]) || !preg_match('/[a-zA-Z0-9]{1,100}/', $_POST["title"])) {
            $this->registry->template->errorMessage = "Unesite naslov u ispravnom obliku";
            $this->index();
            return;
        }
        $ps = new PostService();

        try {
            $postId = !empty($_POST['pid']) ? $_POST['pid'] : false;
            $ps->insertPost($_POST['title'], $_POST['text'], $postId);

            if ($postId) {
                $post_data = $ps->getPostById($postId);

                // ako je ulogirani korisnik autor posta
                if (($post_data->user_id == $_SESSION['user']->id) && ($_SESSION['user']->is_admin == 0)) {
                    $this->redirect('profile/index');

                    // ako je ulogirani korisnik admin
                } else if ($_SESSION['user']->is_admin) {
                    $this->redirect('/blog/index?uid=' . $post_data->user_id);
                }
            } else {
                $this->redirect('profile/index');
            }
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }

}

?>