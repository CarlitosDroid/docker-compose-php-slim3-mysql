<?php
/**
 * Created by PhpStorm.
 * User: Carlos Leonardo Camilo Vargas Huamán
 * Date: 27/04/16
 * Time: 05:02 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


spl_autoload_register(function ($classname) {
    require ("../src/classes/" . $classname . ".php");
});

$app->get('/user', function (Request $request, Response $response) {
    $mapper = new UserMapper($this->db);
    $users = $mapper->selectUser();

    $response->getBody()->write(json_encode($users));
    $newResponse = $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json; charset=utf-8');

    return $newResponse;
});

$app->post('/user', function(Request $request, Response $response){

    $mapper = new UserMapper($this->db);
    $name = $request->getParsedBody()['name'];
    $lastName = $request->getParsedBody()['lastName'];

    $users = $mapper->createUser($name, $lastName);

    if($users["_meta"]["status"] === "SUCCESS"){
        $response->getBody()->write(json_encode($users));
        $newResponse = $response->withStatus(201)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');
        return $newResponse;
    }else{
        $response->getBody()->write(json_encode($users));
        $newResponse = $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json; charset=utf-8');
        return $newResponse;
    }
});




