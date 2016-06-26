<?php

// Bazna apstraktna klasa za sve controllere
abstract class BaseController 
{
	// controller sve podatke koje odhvati iz modela i koje će proslijediti view-u čuva u registry-ju.
	protected $registry;

	function __construct( $registry ) 
	{
		$this->registry = $registry;
                
                if( isset($_SESSION['user'])) {
                    $this->registry->template->currentUser = $_SESSION['user'];
                }
	}

	// Svaki kontroller mora imati barem funkciju index.
	abstract function index();
        
        protected function redirect($location) {
            header('Location:'.__SITE_URL . '/' . $location);
            exit();
        }
}

?>
