<?php
	namespace Library;
	
    class ExceptionManager extends ErrorException {
        public function __toString() {
            switch ($this->severity) {
                case E_USER_ERROR : // Si l'utilisateur �met une erreur fatale
                    $type = 'Erreur fatale';
                    break;
                
                case E_WARNING : // Si PHP �met une alerte
                case E_USER_WARNING : // Si l'utilisateur �met une alerte
                    $type = 'Attention';
                    break;
                
                case E_NOTICE : // Si PHP �met une notice
                case E_USER_NOTICE : // Si l'utilisateur �met une notice
                    $type = 'Note';
                    break;
                
                default : // Erreur inconnue
                    $type = 'Erreur inconnue';
                    break;
            }
            
            return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> � la ligne <strong>' . $this->line . '</strong>';
        }
    }
    
    function error2exception ($code, $message, $fichier, $ligne) {
        // Le code fait office de s�v�rit�
        // Reportez-vous aux constantes pr�d�finies pour en savoir plus
        // http://fr2.php.net/manual/fr/errorfunc.constants.php
        throw new ExceptionManager ($message, 0, $code, $fichier, $ligne);
    }
    
    function customException ($e) {
        echo 'Ligne ', $e->getLine(), ' dans ', $e->getFile(), '<br /><strong>Exception lanc�e</strong> : ', $e->getMessage();
    }
    
    set_error_handler ('error2exception');
    set_exception_handler ('customException');
?>
