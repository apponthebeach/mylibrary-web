<?php    namespace Library\Models;		use \Library\Entities\Auteur;        abstract class AuteurManager extends \Library\Manager {				public function save(Auteur $auteur) {					if($auteur->isValid()) {				$auteur->isNew() ? $this->add($auteur) : $this->modify($auteur);			}			else {				throw new \RuntimeException('L\'auteur doit �tre valide pour �tre enregistr�');			}		}				abstract protected function getAuteursList();				abstract protected function add(Auteur $auteur);				abstract protected function modify(Auteur $auteur);				abstract protected function delete($id);				abstract protected function getAuteurById($id);    }