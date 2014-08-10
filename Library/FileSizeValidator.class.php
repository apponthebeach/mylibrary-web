<?php
    namespace Library;
    
    class FileSizeValidator extends Validator {
        protected $name;
        
		/**
		* Constructeur.
		* @param $errorMessage message d'erreur
		* @param $name nom du champ
		*/
        public function __construct($errorMessage, $name) {
            parent::__construct($errorMessage);
            
            $this->setName($name);
        }
        
		/** {@inheritDoc} */
        public function isValid($value) {		
			if(isset($_FILES[$this->name]) AND $_FILES[$this->name]['name'] != '') {				
				if($_FILES[$this->name]['error'] == 0) {									
					if($_FILES[$this->name]['size'] <= 2097152) {
						return true;
					}

					return false;
				}
				
				return false;
			}
			
            return true;
        }
        
        public function setName($name) {
			$this->name = $name;
        }
    }
