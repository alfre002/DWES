<?php

class Familia {
    // atributos
    private $cod;
    private $nombre;
    
    // getters
    public function getCod() {
        return $this->cod;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    // constructor
    public function __construct($array) {
        $this->cod = $array['cod'];
        $this->nombre = $array['nombre'];
    }
}

?>