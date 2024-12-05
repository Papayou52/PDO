<?php
    class Fabricant {

        // Données
        private $nomFabricant;
        private $idFabricant;

        // Constructeur

        public function __construct(string $nom, $id){
            $this->setNom($nom);
            $this->idFabricant = $id;
        }
        
        // GETTER AND SETTER

        public function getNom_Fabricant() :string {
            return $this-> nomFabricant;
        }

        public function getId_Fabricant(){
            return $this-> idFabricant;
        }

        public function setNom(string $nom){
            $this->nomFabricant = ucfirst($nom);
        }

        // toString

        public function __toString()
        {
            return "ID : ".$this->idFabricant." , NOM : ".$this->nomFabricant;
        }

    }
?>