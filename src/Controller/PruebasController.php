<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebasController extends AbstractController
{

   private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;

    }
    // Tenemos que definir como es el endpoint para poder hacer la peticion desde el cliente
    // ENDPOINT
    /**
     * @Route ("/get/usuarios", name="get_users")
     */
    public function getAllUser(Request $request){
        // Llamará a base de datos y se traerá toda las lista de usersk
        // Devolver una respuesta en formato Json
        // Request - Peticion
        // Response - HAy que devolver una respuesta SIEMPRE

        //$response = new Response(); // Esto lleva codigo de estado (200 predefinido)
        //$response -> setContent('<div>Hola Mundo</div>');

        //Caputaramos los datos que vienen en el request
        $id = $request->get('id');
        $this -> logger->alert('Mensajito');
        // Query sql para traer el user con id = $id
        $response = new JsonResponse();
        $response-> setData([
            'succes'=> true,
            'data'=> [
                [
                'id' => 'Camion',
                'nombre' => 'Pepe',
                'email' => 'pepe@email.com'
                ],

            ]
        ]);
        return $response;

    }
}