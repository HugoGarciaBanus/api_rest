<?php

namespace App\Controller\Api;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Rest\Route("/categoria")
 */

class CategoriaController extends AbstractFOSRestController
{
    //CRUD
    //create, update, read, delete

    private $categoriaRepository;

    public function __construct(CategoriaRepository $repo)
    {
        $this->categoriaRepository = $repo;
    }

    // Traer todas las categorias
    /**
     * @Rest\Get(path="/")
     * @Rest\View (serializerGroups={"get_categorias"}, serializerEnableMaxDepthChecks = true)
     */

    public function getCategorias(){
        return $this->categoriaRepository->findAll();
    }



    // Traer un categoria
    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View(serializerGroups={"get_categoria"}, serializerEnableMaxDepthChecks = true)
     */

    public function getCategoria(Request $request){
        $idCategoria = $request->get('id');
        $categoria= $this->categoriaRepository->find($idCategoria);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado la categoria', Response::HTTP_NOT_FOUND);
        }
        return $categoria;
    }

//    /**
//     * @Rest\Post (path="/")
//     * @Rest\View (serializerGroups={"post_categoria"}, serializerEnableMaxDepthChecks = true)
//     */
//    public function createCategoria(Request $request){
//        $categoria = $request->get('categoria');
//
//        if(!$categoria){ //Comprueba si llega un dato pero no el tipo
//            return new JsonResponse('error en la petición', Response::HTTP_BAD_REQUEST);
//        }
//        // Crear el objeto y hacer un set del nombre de la categoria recibida
//        $cat = new Categoria();
//        $cat->setCategoria($categoria);
//        // Guardamos en base de datos
//        $this->categoriaRepository->add($cat, true);
//        // Enviar una respuesta al cliente
//        return $cat;
//
//    }


    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_categoria"}, serializerEnableMaxDepthChecks = true)
     */

    public function createCategoria(Request $request){
        // Formularios sirven para manejar las peticiones y validar tipado (Null, si viene 1 string vacio...
        //Asociar formulario con validator -> bundle de symfony
        // 1. Creo el objeto vacio
        $cat = new Categoria();
        // 2. Inicalizar el form
        $form = $this->createForm(CategoriaType::class, $cat);
        //3. Le decimos al formulario que maneje la request
        $form->handleRequest($request);
        //4. Comprobar si hay error
        if(!$form->isSubmitted() || !$form->isValid()){
            return $form;
        }
        //5. Correcto-> guardo en BD
        $categoria = $form->getData();
        $this->categoriaRepository->add($categoria, true);
        return $categoria;
    }


    // UPDATE CON PATCH (parche para updatear una categoria y no todas (put))

    /**
     * @Rest\Patch (path="/{id}")
     * @Rest\View (serializerGroups={"up_categoria"}, serializerEnableMaxDepthChecks = true)
     */
    public function updateCategoria(Request $request){
        //Me guardo el id de la categoria
        $categoriaId = $request->get('id');
        //OJO comprobar que existe esa categoria
        $categoria = $this->categoriaRepository->find($categoriaId);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado', Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm(CategoriaType::class, $categoria, ['method'=>$request->getMethod()]);
        $form->handleRequest(($request));
        // Tenemos que comprobar la validez del form
        if(!$form->isSubmitted() || !$form->isValid()){
            return new JsonResponse('Bad data', 404);
        }
        $this->categoriaRepository->add($categoria, true);
        return $categoria;
    }

    // DELETE
    /**
     * @Rest\Delete (path="/{id}")
     *
     */

    public function deleteCategoria(Request $request){
        $idCategoria = $request->get('id');
        $categoria = $this->categoriaRepository->find($idCategoria);
        if(!$categoria){
            return new JsonResponse('No se ha encontrado la categoria', Response::HTTP_NOT_FOUND);
        }
        $this->categoriaRepository->remove($categoria, true);
        return new JsonResponse('Categoria Borrada', 200);
    }
}