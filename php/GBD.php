<?php
require_once('Producto.php');
require_once('User.php');

class DB 
{
    private static $con;
    public static function conecta()
    {
       self::$con = new PDO('mysql:host=localhost;dbname=tech', 'root','');
    }
    
    
   
    public static function obtieneProductos():array
    {
        $ret = array();
        $res= self::$con->query('select * from tech.productos');
        while ($registro = $res->fetch()) {
            
            $p=new Producto(array('cod'=>$registro['cod'],'nombre'=>$registro['nobre'],
            'nombre_corto'=>$registro['nombrecorto'],'PVP'=>$registro['Precio']));
            $ret[] = $p;
        }
        return $ret;

    }

    
    public static function obtieneProducto($codigo):Producto 
    {
        
        $res= self::$con->query("select * from tech.productos where cod = $codigo ");
        while ($registro = $res->fetch()) 
        {
            $p=new Producto(array('cod'=>$registro['cod'],'nombre'=>$registro['nobre'],
            'nombre_corto'=>$registro['nombrecorto'],'PVP'=>$registro['Precio']));
            
        }
        return $p;
	
    }

    public static function altaproducto (Producto $p)
    {
        $consulta = self::$con->prepare("Insert into tech.productos values(:cod, :nombre, :nombrecorto, :precio)");
        
        $consulta->bindParam(1,$p->getcodigo());
        $consulta->bindParam(2,$p->getnombre());
        $consulta->bindParam(3,$p->getnombrecorto());
        $consulta->bindParam(4,$p->getPVP());
        
        $consulta->execute();

    }
    public static function existeusuario($usuario,$password)
    {

        $sql = "SELECT * FROM tech.user " .
            "WHERE email='$usuario' " .
            "AND password='" .$password. "'";
            
            if($resultado = self::$con->query($sql))
             {
                $fila = $resultado->fetch();
                return ($fila != null);
             }             
    }

    public static function obtieneUsuario($email,$password):User
    {
        
        $res= self::$con->query("select * from tech.user where email ='$email' and password='$password'");
        while ($registro = $res->fetch()) 
        {
            $u=new User(array('id'=>$registro['id'],'email'=>$registro['email'],
            'password'=>$registro['password'],'name'=>$registro['name']));
            
        }
        return $u;
	
    }
}

?>
