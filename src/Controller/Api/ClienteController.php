<?php

namespace App\Controller\Api;

use App\Entity\Cliente;
use App\Form\CategoriaType;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// Establecemos la ruta padre
/**
 * @Rest\Route("/cliente")
 */
class ClienteController extends AbstractFOSRestController
{
    private $repo;

    public function __construct(ClienteRepository $repo){
        $this->repo = $repo;
    }

    // Crear cliente
    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_cliente"}, serializerEnableMaxDepthChecks=true)
     */

    public function createCliente(Request $request){
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);
        if(!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }

        $this->repo->add($cliente, true);
        return $cliente;
    }

    // GET one Cliente

    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View(serializerGroups={"get_cliente"}, serializerEnableMaxDepthChecks = true)
     */

    public function getCliente(Request $request){
        $idCliente = $request->get('id');
        $cliente = $this->repo->find($idCliente);
        if(!$cliente){
            return new JsonResponse('No se ha encontrado el cliente', Response::HTTP_NOT_FOUND);
        }
        return $cliente;
    }


    /**
     * @Rest\Patch (path="/{id}")
     * @Rest\View (serializerGroups={"up_cliente"}, serializerEnableMaxDepthChecks = true)
     */
    public function updateCliente(Request $request){
        //Me guardo el id del cliente
        $clienteId = $request->get('id');
        //OJO comprobar que existe este cliente
        $cliente = $this->repo->find($clienteId);
        if(!$cliente){
            return new JsonResponse('No se ha encontrado', Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(ClienteType::class, $cliente, ['method'=>$request->getMethod()]);
        $form->handleRequest(($request));
        // Tenemos que comprobar la validez del form
        if(!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        $this->repo->add($cliente, true);
        return $cliente;
    }

    // DELETE
    /**
     * @Rest\Delete (path="/{id}")
     *
     */

    public function deleteCliente(Request $request){
        $idCliente = $request->get('id');
        $cliente = $this->repo->find($idCliente);
        if(!$cliente){
            return new JsonResponse('No se ha encontrado el cliente', Response::HTTP_NOT_FOUND);
        }
        $this->repo->remove($cliente, true);
        return new JsonResponse('Cliente Borrado', 200);
    }



}