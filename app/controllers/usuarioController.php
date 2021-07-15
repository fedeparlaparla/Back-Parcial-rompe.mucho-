<?php
 
 class UsuarioController{

    public function ValidarUsers($request,  $response,  $args){
        
        $listaDeParametros = $request->getParsedBody();
        $arrayUsers = Usuario::obtenerNombre($listaDeParametros['user']);
        
        if(count($arrayUsers)==1){
                $usersBD = new Usuario();
                foreach($arrayUsers as $objUsuario){
                    foreach ($objUsuario as $atr => $valueAtr) {
                        $usersBD->{$atr} = $valueAtr;
                    }
                }
                $passBD=$usersBD->pass;
                if($usersBD->compararPass($listaDeParametros['pass'] , $passBD)){
                    $response->getBody()->write("Acceso correcto");
                }
                else{
                    $response->getBody()->write("Contraseña incorrecta");
                }
        }
        else{
            $response->getBody()->write("Usuario incorrecto");
        }
  
    return $response;

    }
    
    

    public function RegistrarUser($request, $response, $args){
        $listaDeParametros = $request->getParsedBody();

        $newUsuario = new Usuario();
        $newUsuario->setEmail($listaDeParametros['mail']);
        $newUsuario-> setUser($listaDeParametros['user']);
        $newUsuario-> setPass($listaDeParametros['pass']);
        
        Usuario::insertarUsuario($newUsuario);

        $response->getBody()->Write(json_encode($newUsuario));
        return $response;
        
    }

}

?>