<?php

require_once 'model/db.class.php';

class CommentController extends BaseController {

    public function index() {
        $cs = new CommentService();        
        $ps = new PostService();
        //$us = new UserService();
        
        $postId = $_GET['pid'];
        
        $comments = $cs->getCommentsOnPost($postId);
        $post = $ps->getPostById($postId);
        
        // Popuni template potrebnim podacima
        $this->registry->template->post = $post;
        $this->registry->template->commentList = $comments;
        $this->registry->template->show('post_comments');
    }
    
    public function saveComment() {
        // Provjeri je li unešen komentar
        if (!isset($_POST["comment"])) {
            return;
        }        
        $cs = new CommentService();
        try {
            $cs->insertComment($_POST['comment'], $_POST['postId']);
            $this->redirect('comment/index/?pid='.$_POST['postId']);
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }
}

?>
