<?php

require_once(CONF_PATH.'DBUtil.php');


$app->group('/api/bitacora/',function(){
    
    $this->get('getall',function($request,$response){

        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $bitacoras = R::find('bitacora');
            
            
            $response->withHeader('Content-Type', 'application/json');
            $json_result = json_encode(R::exportAll($bitacoras),JSON_PRETTY_PRINT);
        }
         $response->withHeader('Content-Type', 'application/json');
         echo ($json_result);
    });
    
    $this->get('get/{id}',function($request,$response,$args){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $bitacora = R::findOne('bitacora','id  = ?',[ $args['id']]);
            if($bitacora){
                $json_result = json_encode($bitacora->export(),JSON_PRETTY_PRINT);
            }
            else $json_result = '{"notice": {"text": "id de bitacora no es valido"}}'; 
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });    


    $this->delete('delete/{id}',function($request,$response){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){
            $id = $request->getAttribute('id');
            $bitacora = R::load('bitacora',$id);


            if($bitacora->id){
                R::begin();
                try{
                    R::trash($bitacora);
                    R::commit();
                    $json_result = '{"notice": {"text": "bitacora eliminada correctamente}}';
                }catch(Exception $e){
                    R::rollback();
                    $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
                }
            }
            else  $json_result = '{"notice": {"text": "id de bitacora no valido"}}';
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });

    $this->post('add',function($request,$response){
        
        $json_result = '{"notice": {"text": "no hay conexion en la base de datos"}}';
        if(DBUtil::getInstance()){

            $bitacora = R::dispense( 'bitacora' );
            $bitacora->volteo = $request->getParam('volteo');
            $bitacora->ventilador = $request->getParam('ventilador');
            $bitacora->fecha = $request->getParam('fecha');
            $bitacora->temperatura = $request->getParam('temperatura');
            $bitacora->humedad = $request->getParam('humedad');
            $bitacora->posicion_huevo = $request->getParam('posicion_huevo');
            $bitacora->id_tipo_huevo = $request->getParam('id_tipo_huevo');
            $bitacora->estado_ventilador = $request->getParam('estado_ventilador');
            $bitacora->estado_puerta = $request->getParam('estado_puerta');
            $bitacora->dia_encubacion = $request->getParam('dia_encubacion');
            $bitacora->numero_huevos = $request->getParam('numero_huevos');
            $bitacora->id_encubadora_asignada = $request->getParam('id_encubadora_asignada');


            R::begin();
            try{
                R::store($bitacora);
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
            $bitacora = R::load( 'bitacora', $id );
            $json_result = '';

            if($bitacora->id){
                $bitacora = R::dispense( 'bitacora' );
                $bitacora->volteo = $request->getParam('volteo');
                $bitacora->ventilador = $request->getParam('ventilador');
                $bitacora->fecha = $request->getParam('fecha');
                $bitacora->temperatura = $request->getParam('temperatura');
                $bitacora->humedad = $request->getParam('humedad');
                $bitacora->posicion_huevo = $request->getParam('posicion_huevo');
                $bitacora->id_tipo_huevo = $request->getParam('id_tipo_huevo');
                $bitacora->estado_ventilador = $request->getParam('estado_ventilador');
                $bitacora->estado_puerta = $request->getParam('estado_puerta');
                $bitacora->dia_encubacion = $request->getParam('dia_encubacion');
                $bitacora->numero_huevos = $request->getParam('numero_huevos');
                $bitacora->id_encubadora_asignada = $request->getParam('id_encubadora_asignada');
                try{
                    R::store($bitacora);
                    R::commit();
                    $json_result = '{"notice": {"text": "bitacora actualizada"}}';
                }catch(Exception $e){
                    R::rollback();
                    $json_result = '{"notice": {"text": "'.$e->getmessage().'"}}';
                }
            }
            else $json_result = '{"notice": {"text": "id de bitacora no es valido"}}';
        }
        $response->withHeader('Content-Type', 'application/json');
        echo $json_result;
    });
        

});