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

}

?>