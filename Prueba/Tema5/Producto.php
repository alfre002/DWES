<?php

class Producto {
    // atributos
    protected $cod;
    protected $nombre;
    protected $nombre_corto;
    protected $PVP;
    protected $familia;
    
    // getters
    public function getCod() {
        return $this->cod;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getNombre_corto() {
        return $this->nombre_corto;
    }

    public function getPVP() {
        return $this->PVP;
    }

    public function getFamilia() {
        return $this->familia;
    }

    public function __construct($array) {
        $this->cod = $array['cod'];
        $this->nombre = $array['nombre'];
        $this->nombre_corto = $array['nombre_corto'];
        $this->PVP = $array['PVP'];
        $this->familia = $array['familia'];
    }
    
    public function nombreProducto() {
        echo getNombre();
    }
}

?>