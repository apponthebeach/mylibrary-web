<?php
  namespace Applications\Backend\Modules\Livre;
  
  class LivreController 
    extends \Library\BackController 
  {
  
    public function executeIndex(\Library\HTTPRequest $request) 
    {
      $livresList = $this->managers->getManagerOf('Livre')->getLivreList($request->getData('letter'));
      $this->page->addVar('livresList', $livresList);
      $this->page->addVar('letter', $request->getData('letter'));
    }

    public function executeNew(\Library\HTTPRequest $request) 
    {
      //Si le formulaire a �t� envoy�			
      if($request->method() == 'POST') 
      {				
        $poche = (($request->postData('poche') == 'on') ? 1 : 0);
        $livre = new \Library\Entities\Livre(array(
          'id'			    => $request->postData('id'),
          'nom' 			  => $request->postData('nom'),
          'annee'			  => $request->postData('annee'),
          'couverture' 	=> $_FILES['couverture']['tmp_name'],
          'genreId' 		=> $request->postData('genreId'),
          'auteurId' 		=> $request->postData('auteurId'),
          'poche' 		  => $poche
        ));
      }
      else
      {
        $livre =  new \Library\Entities\Livre;
      }
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\LivreFormBuilder($livre);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On r�cup�re le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Livre'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre enregistr� avec succ�s.'));
        $this->app->httpResponse()->redirect('/livre-'.$livre->id().'.html');
      }
      
      $this->page->addVar('form', $form->createView());
    }

    public function executeDelete(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->delete($request->getData('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre supprim� avec succ�s.'));
        $this->app->httpResponse()->redirect('/livres.html');
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Ce livre est r�f�renc�, vous ne pouvez pas le supprimer.'));
        $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
      }				
    }

    public function executeShow(\Library\HTTPRequest $request) 
    {
      $livre = $this->managers->getManagerOf('Livre')->getLivreById($request->getData('id'));
      
      if(empty($livre)) 
      {
        $this->app->httpResponse()->redirect('erreur.html');
      }
      
      $get = $this->managers->getManagerOf('Livre')->hasGetLivre($livre->id(), $this->app->user()->getAttribute('id'));
      $want = $this->managers->getManagerOf('Livre')->hasWantLivre($livre->id(), $this->app->user()->getAttribute('id'));
      $read = $this->managers->getManagerOf('Livre')->hasReadLivre($livre->id(), $this->app->user()->getAttribute('id'));
      
      if($want == true) 
      {
        $users = $this->managers->getManagerOf('Livre')->peopleHaveLivre($livre->id(), $this->app->user()->getAttribute('id'));
      }
      
      $this->page->addVar('livre', $livre);
      $this->page->addVar('get', $get);
      $this->page->addVar('want', $want);
      $this->page->addVar('read', $read);
      
      if($want == true) 
      {
        $this->page->addVar('utilisateurs', $users);
      }
    }		
    
    public function executeEdit(\Library\HTTPRequest $request)
    {
      //Si le formulaire a �t� envoy�
      if($request->method() == 'POST') 
      {				
        $poche = (($request->postData('poche') == 'on') ? 1 : 0);
        $livre = new \Library\Entities\Livre(array(
          'id'			=> $request->postData('id'),
          'nom' 			=> $request->postData('nom'),
          'annee'			=> $request->postData('annee'),
          'couverture' 	=> $_FILES['couverture']['tmp_name'],
          'genreId' 		=> $request->postData('genreId'),
          'auteurId' 		=> $request->postData('auteurId'),
          'poche' 		=> $poche
        ));
      }
      else
      {
        $livre = $this->managers->getManagerOf('Livre')->getLivreById($request->getData('id'));
      
        if(empty($livre)) 
        {
          $this->app->httpResponse()->redirect('erreur.html');
        }
      }	
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\LivreFormBuilder($livre);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On r�cup�re le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Livre'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre enregistr� avec succ�s.'));
        $this->app->httpResponse()->redirect('/livre-'.$livre->id().'.html');
      }
      
      $this->page->addVar('livre', $livre);
      $this->page->addVar('form', $form->createView());
    }
    
    public function executeGetadd(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->addGetLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre ajout� � votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeGetremove(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->removeGetLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre retir� de votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeReadadd(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->addReadLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre ajout� � votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeReadremove(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->removeReadLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre retir� de votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeWantadd(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->addWantLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre ajout� � votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeWantremove(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Livre')->removeWantLivre($request->getData('id'), $this->app->user()->getAttribute('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Livre retir� de votre liste avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Une erreur est survenue.'));
      }
      
      $this->app->httpResponse()->redirect('/livre-'.$request->getData('id').'.html');
    }
    
    public function executeGet(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getGetList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeRead(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getReadList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeToRead(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getToReadList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeWant(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getWantList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeGetexport(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getGetList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeReadexport(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getReadList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeToReadexport(\Library\HTTPRequest $request) 
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getToReadList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeWantexport(\Library\HTTPRequest $request)
    {
      $utilisateurId = $request->getData('utilisateurId');
      $utilisateur = $this->managers->getManagerOf('Utilisateur')->getUtilisateurById($utilisateurId);
      $livresList = $this->managers->getManagerOf('Livre')->getWantList($utilisateurId);
      $this->page->addVar('utilisateur', $utilisateur);
      $this->page->addVar('livresList', $livresList);
    }
    
    public function executeAllexport(\Library\HTTPRequest $request) 
    {
      $livresList = $this->managers->getManagerOf('Livre')->getAllList();
      $this->page->addVar('livresList', $livresList);
    }
    
  }