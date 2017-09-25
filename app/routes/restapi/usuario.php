<?php

require_once(CONF_PATH.'DBUtil.php');


$app->group('/api/usuario/',function(){

    $this->get('getall',function($request,$response){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $users = R::find('usuario');
            
            
            $response->withHeader('Content-Type', 'application/json');
            $json_result = json_encode(R::exportAll($users),JSON_PRETTY_PRINT);
        }
         echo ($json_result);
    });

    $this->get('get/{id}',function($request,$response,$args){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $user = R::findOne('usuario','id  = ?',[ $args['id']]);
            if($user){
                $response->withHeader('Content-Type', 'application/json');
                $json_result = json_encode($user->export(),JSON_PRETTY_PRINT);
            }
            else $json_result = '{"notice": {"text": "id usuario no valido"}}'; 
        }
        echo $json_result;
    });

    $this->delete('delete/{id}',function($request){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $id = $request->getAttribute('id');
            $usuario = R::load('usuario',$id);


            if($usuario){
                R::begin();
                try{
                    R::trash($user);
                    R::commit();
                    $json_result = '{"notice": {"text": "usuario eliminado correctamente}}';
                }catch(Exception $e){
                    R::rollback();
                    $json_result = '{"notice": {"text": "id usuario no valido"}}';
                }
            }
            else $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
        }
        echo $json_result;
    });

    $this->post('add/',function($request){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){

            $usuario = R::dispense( 'usuario' );
            $usuario->nombre = $request->getparam('nombre');
            $usuario->email = $request->getparam('email');
            $usuario->password = $request->getparam('password');
            $usuario->estatus = $request->getparam('estatus');

            R::store($usuario);
            $json_result = '{"notice": {"text": "usuario agregado"}}';
        }
        echo $json_result;
    });


    $this->put('update/{id}',function($request){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){

            $id = $request->getAttribute('id');
            $usuario = R::load( 'usuario', $id );
            $json_result = '';

            if($usuario){
                $usuario->nombre = $request->getparam('nombre');
                $usuario->email = $request->getparam('email');
                $usuario->password = $request->getparam('password');
                $usuario->estatus = $request->getparam('estatus');
                R::store($usuario);
                $json_result = '{"notice": {"text": "usuario actualizado"}}';
            }
            else $json_result = '{"notice": {"text": "id usuario no valido"}}';
        }
        echo $json_result;
    });


});