<?php    namespace Library\Entities;        class Utilisateur extends \Library\Entity {        protected $login,				  $email;                const LOGIN_INVALIDE = 1;		const EMAIL_INVALIDE = 2;        		public function __construct(array $attributs = array()) {            foreach ($attributs as $attribut => $value) {                $method = 'set'.ucfirst($attribut);                                if (is_callable(array($this, $method))) {                    $this->$method($value);                }            }		        }		        public function isValid() {            return (!empty($this->login) && !empty($this->email));        }                // SETTERS //             public function setLogin($login) {            if (empty($login)) {                $this->erreurs[] = self::LOGIN_INVALIDE;			}            else {                $this->login = $login;			}        }				public function setEmail($email) {            if (empty($email)) {                $this->erreurs[] = self::EMAIL_INVALIDE;			}            else {                $this->email = $email;			}        }   		        // GETTERS //        public function login() {            return $this->login;        }				public function email() {            return $this->email;        }    }