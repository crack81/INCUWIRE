<?php

require_once(CONF_PATH.'DBUtil.php');


$app->group('/api/usuario/',function(){

    $this->get('getall',function($request,$response){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $usuarios = R::find('usuario');
            
            
            $response->withHeader('Content-Type', 'application/json');
            $json_result = json_encode(R::exportAll($usuarios),JSON_PRETTY_PRINT);
        }
         $response->withHeader('Content-Type', 'application/json');
         echo ($json_result);
    });

    $this->get('get/{id}',function($request,$response,$args){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $usuario = R::findOne('usuario','id  = ?',[ $args['id']]);
            if($user){
                $json_result = json_encode($usuario->export(),JSON_PRETTY_PRINT);
            }
            else $json_result = '{"notice": {"text": "id usuario no valido"}}'; 
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });

    $this->delete('delete/{id}',function($request,$response){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $id = $request->getAttribute('id');
            $usuario = R::load('usuario',$id);


            if($usuario->id){
                R::begin();
                try{
                    R::trash($usuario);
                    R::commit();
                    $json_result = '{"notice": {"text": "usuario eliminado correctamente}}';
                }catch(Exception $e){
                    R::rollback();
                    $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
                }
            }
            else  $json_result = '{"notice": {"text": "id usuario no valido"}}';
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });

    $this->post('add',function($request,$response){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){

            $usuario = R::dispense( 'usuario' );
            $usuario->nombre = $request->getParam('nombre');
            $usuario->email = $request->getParam('email');
            $usuario->password = $request->getParam('password');
            $usuario->estatus = $request->getParam('estatus');

            R::begin();
            try{
                R::store($usuario);
                R::commit();
                $json_result = '{"notice": {"text": "usuario agregado"}}';
            }catch(Exception $e){
                R::rollback();
                $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
            }
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });


    $this->put('update/{id}',function($request,$response){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){

            $id = $request->getAttribute('id');
            $usuario = R::load( 'usuario', $id );
            $json_result = '';

            if($usuario->id){
                $usuario->nombre = $request->getParam('nombre');
                $usuario->email = $request->getParam('email');
                $usuario->password = $request->getParam('password');
                $usuario->estatus = $request->getParam('estatus');
                try{
                    R::store($usuario);
                    R::commit();
                    $json_result = '{"notice": {"text": "usuario actualizado"}}';
                }catch(Exception $e){
                    R::rollback();
                    $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
                }
            }
            else $json_result = '{"notice": {"text": "id usuario no valido"}}';
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });


});