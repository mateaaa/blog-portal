<?php

require_once 'model/db.class.php';

class ProfileController extends BaseController {

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
	
	
    
    public function newpost() {
        $this->registry->template->show('new_post');
    }

    public function edit() {
        if (empty($_GET['pid'])) {
            $this->redirect('/profile/index');
        }
        
        $ps = new PostService();
        $post = $ps->getPostById($_GET['pid']);
                
        $this->registry->template->post = $post;        
        $this->registry->template->show('post_edit');
    }
	
	public function delete()
	{
		$pid = $_GET['pid'];
	}
    
    function savePost(){
        if (empty($_POST)) {
            // forma nije pravilno submitana
            $this->redirect('profile/newpost');
        }
        $change = false;
        if(isset($_POST['change'])){
            $change = true;
        }
        
        //Provjeri je li dobar title
        if (!isset($_POST["title"]) || !preg_match('/[a-zA-Z0-9]{1,100}/', $_POST["title"])) {
            $this->registry->template->errorMessage = "Unesite naslov u ispravnom obliku";
            $this->index();
            return;
        }
        $ps = new PostService();
        try {
            $ps->insertPost($_POST['title'], $_POST['text'], $change, $_GET['pid']);
            
			$post_data = $ps->getPostById($_GET['pid']);
			
			// ako je ulogirani korisnik autor posta
			if(($post_data->user_id == $_SESSION['user']->id) && ($_SESSION['user']->is_admin == 0))
				$this->redirect('profile/index');
			
			// ako je ulogirani korisnik admin
			else if($_SESSION['user']->is_admin)
			{
				$this->redirect('/blog/index?uid='.$post_data->user_id);
			}
			
        } catch (Exception $ex) {
            $this->registry->template->errorMessage = $ex->getMessage();
            $this->index();
            return;
        }
    }

}

?>