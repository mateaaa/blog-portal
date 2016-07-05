<?php

require_once 'model/db.class.php';

/**
 * klasa za upravljanje blogovima
 */
class BlogController extends BaseController {

    /**
     * popunjava odgovarajući template s postojećim blogovima i postovima unutar njih
     */
    public function index() {
        $ps = new PostService();
        $us = new UserService();

        $userId = $_GET['uid'];

        $user = $us->getUserById($userId);
        $posts = $ps->getPostsByUser($userId);

        // Popuni template potrebnim podacima
        $this->registry->template->blogName = $user->blog_name;
        $this->registry->template->postList = $posts;
        $this->registry->template->show('blog_posts');
    }

    /**
     * služi za brisanje/editiranje postova
     * 
     * @return void ako je došlo do greške
     */
    public function DeleteEditPost() {
        $ps = new PostService();
        $us = new UserService();
        $cs = new CommentService();

        $userId = $_GET['uid'];
        $delete = 0;
        $edit = 0;

        try {

            // kliknuli smo na delete
            if (isset($_POST['delete_button'])) {
                // prvo pobriši sve komentare na taj post, a tek onda pobriši post iz baze
                $cs->deleteComments($_POST['postId']);
                $ps->deletePost($_POST['postId']);
                $delete = 1;
            }

            // kliknuli smo na edit
            elseif (isset($_POST['edit_button'])) {
                $edit = 1;
                $post = $ps->getPostById($_POST['postId']);
                $this->registry->template->post = $post;
                $this->registry->template->show('post_edit');
            }

            // obrađuje slučaj kad nije bilo klika na niti jedan gumb ili je kliknut delete
            if ($edit == 0) {
                $user = $us->getUserById($userId);
                $posts = $ps->getPostsByUser($userId);

                // Popuni template potrebnim podacima
                $this->registry->template->blogName = $user->blog_name;
                $this->registry->template->postList = $posts;

                $this->registry->template->show('blog_posts');
            }
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }

}

?>