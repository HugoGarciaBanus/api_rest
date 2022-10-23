<?php

namespace App\Controller\Api;


use App\Repository\RestauranteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/restaurante")
 */
class RestauranteController extends AbstractFOSRestController
{
    private $repo;

    public function __construct(RestauranteRepository $repo){
      $this->repo = $repo;
    }

    //1. ENDPOINT Devolver restaurante por id
    // Muestra la página del restaurante con toda su info.
    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurante(Request $request){
        // falta comprobar si existe en BD
        return $this->repo->find($request->get('id'));
    }

    //2. Devolver listado de restaurantes según dia, hora y municipio
    //  1ª seleccionar la dirección de envío
    //  2ª seleccionar día y hora de reparto
    //  3ª mostrar los restaurantes que cumplan con esas condiciones

    /**
     * @Rest\Post (path="/filtered")
     * @Rest\View (serializerGroups={"res_filtered"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurantesBy(Request $request){
        $dia = $request->get('dia');
        $hora = $request->get('hora');
        $idMunicipio= $request->get('municipio');

    //comprobar que vienen esos datos, si alguno falla se hace un -> BAD REQUEST

        $restaurantes = $this->repo->findByDayTimeMunicipio($dia, $hora, $idMunicipio);
        return $restaurantes;


    }


}