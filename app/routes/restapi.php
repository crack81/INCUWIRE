<?php
/*
##########################################################################################################
#   @AUTOR: Crack81
#   @DATE: 2017/09/16 
#   @Version: 1.0
#
#   REST API FULL  para el proyecto de incuwire el cual genera todas las operaciones de un CRUD
#   para posterioremente ser consumida por disntintos dispositivos cocmo lo son aplicaciones WEB, 
#   telefonos intelitentes o SmartPhones  y microontroladores ARDUINO.
#
#
#
############################################################################################################

*/


require_once(CONF_PATH.'DBUtil.php');

/*
   Agrupa las operaciones del CRUD correspondiente a la tabla usuario
*/
$app->group('/api/user/',function(){

    /*
        Carga todos los registros de la tabla usuario
    */
    $this->get('getall',function($request,$response){
        if(DBUtil::getInstance()){
            $users = R::find('usuario');
            
            
            $response->withHeader('Content-Type', 'application/json');
            echo json_encode(R::exportAll($users),JSON_PRETTY_PRINT);
        }
    });


    /*
        Carga un registro de la tabla usuario en base a su ID
    */
    $this->get('get/{id}',function($request,$response,$args){
        if(DBUtil::getInstance()){
            $user = R::findOne('usuario','id  = ?',[ $args['id']]);
            if($user){
                $response->withHeader('Content-Type', 'application/json');
                echo json_encode($user->export(),JSON_PRETTY_PRINT);
            }
        }
    });

    /*
        Elimina un registro de la tabla usuario en base a su ID
    */
    $this->delete('delete/{id}',function($request){
        if(DBUtil::getInstance()){

            $id = $request->getAttribute('book_id');
            $user = R::load('usuario',$id);
            R::trash($user);
        }
    });
});



/*
   Agrupa las operaciones del CRUD correspondiente a la tabla encubadora
*/
$app->group('/api/incubator/',function(){

    /*
        Carga todos los registros de la tabla encubadora
    */
     $this->get('getall',function($request,$response){

     });


    /*
        Carga un registro de la tabla encubadora en base a su ID
    */
     $this->get('get/{id}',function($request,$response){
        
    });

    $this->delete('delete/{id}',function($request,$response){
        
    });

 });