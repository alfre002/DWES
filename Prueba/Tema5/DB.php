<?php

class DB {
    public static function ejecutarConsulta($consulta, $parametros) {
        try {
            $usuario = "root";
            $contraseña = "Visoalcor1";
            $conexion = new PDO('mysql:host=127.0.0.1; dbname=tiendas', $usuario, $contraseña);
            $sentencia = $conexion->prepare($consulta);
            $sentencia ->execute($parametros);
            
            return $sentencia;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public static function obtenerFamilias() {
        $consulta = "SELECT * FROM familia";
        $parametros = [];
        
        return self::ejecutarConsulta($consulta, $parametros);
    }
    
    public static function obtenerProductos($familia) {
        $consulta = "SELECT * FROM producto WHERE "
                . "familia =:familia";
        $parametros = [':familia' => $familia];
        
        return self::ejecutarConsulta($consulta, $parametros);
    }
    
    public static function obtieneProducto($codProd) {
        $consulta = "SELECT * FROM producto WHERE "
                . "cod =:codProd";
        $parametros = [':codProd' => $codProd];
        
        $fila = self::ejecutarConsulta($consulta, $parametros);
        
        foreach($fila as $resultado) {
            $producto = new Producto($resultado);
        }
        return $producto;
    }
    
    public static function obtieneFamilia($codFamilia) {
        $consulta = "SELECT * FROM familia WHERE "
                . "cod =:codFamilia";
        $parametros = [':codFamilia' => $codFamilia];
        
        return self::ejecutarConsulta($consulta, $parametros);
    }
    
    public static function verificaCliente($usuario, $password) {
        $consulta = "SELECT * FROM usuarios WHERE usuario =:usuario";
        $parametros = [":usuario" => $usuario];
        $login_ok = false;
        try {
            $res = self::ejecutarConsulta($consulta, $parametros);
            if($res->rowCount() > 0) {
                $usuario = $res->fetch();
                $hash = $usuario['password'];
                $login_ok = password_verify($password, $hash);
                echo $hash;
                return $login_ok;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }   
}
?>