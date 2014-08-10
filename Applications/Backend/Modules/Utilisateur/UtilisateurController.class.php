<?php
    namespace Applications\Backend\Modules\Utilisateur;
    
    class UtilisateurController extends \Library\BackController {		
		public function executeEdit(\Library\HTTPRequest $request) {
			//Si le formulaire a �t� envoy�
			if($request->method() == 'POST') {				
				$utilisateur = new \Library\Entities\Utilisateur(array(
					'id'		=> $request->postData('id'),
					'login' 	=> $request->postData('login'),
					'email' 	=> $request->postData('email')
				));
			}
			else{
				$utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($this->app->user()->getAttribute('id'));
			
				if(empty($utilisateur)) {
					$this->app->httpResponse()->redirect('erreur.html');
				}
			}			
			
			//On construit le formulaire
			$formBuilder =  new \Library\FormBuilder\UtilisateurFormBuilder($utilisateur);
            $formBuilder->build();
			
			$form = $formBuilder->form();
			
			// On r�cup�re le gestionnaire de formulaire pour la sauvegarde
			$formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Utilisateur'), $request);			
						
			if ($formHandler->process()) {
				$this->app->user()->setFlash(utf8_encode('Compte enregistr� avec succ�s.'));
				$this->app->httpResponse()->redirect('/compte.html');
			}
			
			$this->page->addVar('utilisateur', $utilisateur);
            $this->page->addVar('form', $form->createView());
		}
    }	
