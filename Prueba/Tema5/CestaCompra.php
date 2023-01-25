<?php

require_once './DB.php';

class CestaCompra {
    // atributos
    protected $productos = array();
    protected $unidades = array();
    
    // getters
    public function getProductos() {
        return $this->productos;
    }

    public function getUnidades() {
        return $this->unidades;
    }
         
    // funcion que carga la cesta si existe o la crea si no existe
    public static function carga_cesta() {
        if(isset($_SESSION['cesta'])) {
            $cesta = $_SESSION['cesta'];
        } else {
            $_SESSION['cesta'] = [];
            $cesta = new CestaCompra();
        }
        return $cesta;
    }
    
    public function carga_articulo($cod, $unidades) {
        // si ya existe el producto en la cesta, suma las unidades
        if(array_key_exists($cod, $this->productos)) {
            $unidades_numero = $this->unidades[$cod];
            $unidades_numero += $unidades;
            $this->unidades[$cod] = $unidades_numero;
        } else {
            try {
                $producto = DB::obtieneProducto($cod);
                $this->productos[$cod] = $producto->getCod();
                $this->unidades[$cod] = $unidades;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }
    
    public function guarda_cesta() {
        $_SESSION['cesta'] = $this;
    }
}

?>