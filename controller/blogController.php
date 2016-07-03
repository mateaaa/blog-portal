<?php

require_once 'model/db.class.php';

class BlogController extends BaseController {

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

    public function DeleteEditPost() {
        $ps = new PostService();
        $us = new UserService();
        $cs = new CommentService();

        $userId = $_GET['uid'];


        try {

            // kliknuli smo na delete
            if (isset($_POST['delete_button'])) {
                // prvo pobriši sve komentare na taj post, a tek onda pobriši post iz baze
                $cs->deleteComments($_POST['postId']);
                $ps->deletePost($_POST['postId']);
            }

            // kliknuli smo na edit
            elseif (isset($_POST['edit_button']))
                $ps->editPost($_POST['postId']);


            $user = $us->getUserById($userId);
            $posts = $ps->getPostsByUser($userId);

            // Popuni template potrebnim podacima
            $this->registry->template->blogName = $user->blog_name;
            $this->registry->template->postList = $posts;
            $this->registry->template->show('blog_posts');
            //$this->redirect('blog/index/?uid='.$userId);
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }

}

?>