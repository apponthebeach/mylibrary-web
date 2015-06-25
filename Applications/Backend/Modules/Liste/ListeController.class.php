<?php
  namespace Applications\Backend\Modules\Liste;
  
  class ListeController 
    extends \Library\BackController 
  {
      
    public function executeIndex(\Library\HTTPRequest $request)
    {
    	$utilisateursList = $this->managers->getManagerOf('Utilisateur')->getUtilisateurList();
      	$this->page->addVar('utilisateursList', $utilisateursList);
    }
    
  }
