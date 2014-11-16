<?php
  namespace Applications\Backend\Modules\Genre;
  
  class GenreController 
    extends \Library\BackController 
  {
  
    public function executeIndex(\Library\HTTPRequest $request) 
    {
      $genresList = $this->managers->getManagerOf('Genre')->getGenresList();
      $this->page->addVar('genresList', $genresList);
    }

    public function executeNew(\Library\HTTPRequest $request) 
    {
      //Si le formulaire a �t� envoy�			
      if($request->method() == 'POST') 
      {			
        $genre = new \Library\Entities\Genre(array(
          'id'			=> $request->postData('id'),
          'libelle' => $request->postData('libelle')
        ));
      }
      else
      {
        $genre =  new \Library\Entities\Genre;
      }
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\GenreFormBuilder($genre);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On r�cup�re le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Genre'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Genre enregistr� avec succ�s.'));
        $this->app->httpResponse()->redirect('/genres.html');
      }
      
      $this->page->addVar('form', $form->createView());
    }

    public function executeDelete(\Library\HTTPRequest $request) 
    {
      if($this->managers->getManagerOf('Genre')->delete($request->getData('id'))) 
      {
        $this->app->user()->setFlash(utf8_encode('Genre supprim� avec succ�s.'));
      }
      else 
      {
        $this->app->user()->setFlashError(utf8_encode('Ce genre est r�f�renc�, vous ne pouvez pas le supprimer.'));
      }	
      
      $this->app->httpResponse()->redirect('/genres.html');
    }	
  
    public function executeEdit(\Library\HTTPRequest $request) 
    {
      //Si le formulaire a �t� envoy�
      if($request->method() == 'POST') 
      {				
        $genre = new \Library\Entities\Genre(array(
          'id'			=> $request->postData('id'),
          'libelle' => $request->postData('libelle')
        ));
      }
      else
      {
        $genre = $this->managers->getManagerOf('Genre')->getGenreById($request->getData('id'));
      
        if(empty($genre)) 
        {
          $this->app->httpResponse()->redirect('erreur.html');
        }
      }	
      
      //On construit le formulaire
      $formBuilder =  new \Library\FormBuilder\GenreFormBuilder($genre);
      $formBuilder->build();
      $form = $formBuilder->form();
      
      // On r�cup�re le gestionnaire de formulaire pour la sauvegarde
      $formHandler = new \Library\FormHandler($form, $this->managers->getManagerOf('Genre'), $request);			
            
      if ($formHandler->process()) 
      {
        $this->app->user()->setFlash(utf8_encode('Genre enregistr� avec succ�s.'));
        $this->app->httpResponse()->redirect('/genres.html');
      }
      
      $this->page->addVar('genre', $genre);
      $this->page->addVar('form', $form->createView());
    }
    
  }	
