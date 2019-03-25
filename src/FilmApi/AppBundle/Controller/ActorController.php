<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 23/03/2019
 * Time: 3:36 PM
 */

namespace FilmApi\AppBundle\Controller;


use FilmApi\Application\Command\Actor\CreateActorCommand;
use FilmApi\Domain\Exception\BadOperationException;
use FilmApi\Domain\Exception\RepositoryException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FilmApi\Domain\Actor;
use Symfony\Component\HttpFoundation\Response;

class ActorController extends Controller
{
    public function createActor(Request $request):JsonResponse
    {
        $jsonReq = json_decode($request->getContent());
        $name = filter_var($jsonReq->name ?? '', FILTER_SANITIZE_STRING);
        $command = new CreateActorCommand($name);
        $handler = $this->get('actor.command_handler.create_actor');

        try{
            $actor = $handler->handle($command);
            $this->end();
            return new JsonResponse(['success' =>  'create ok', 'actor' => $actor]);
        }catch (RepositoryException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
    }

    public function deleteActor(int $id):JsonResponse
    {
        $id = filter_var($id ?? '', FILTER_SANITIZE_NUMBER_INT);
        $handler = $this->get('actor.command_handler.delete_actor');

        try{
            $actor = $handler->handle($id);
            $this->end();
            return new JsonResponse(['success' =>  'delete ok', 'id_actor' => $id]);
        }catch (BadOperationException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }catch (RepositoryException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);

        }
    }

    public function AllActor():JsonResponse
    {
        $handler = $this->get('actor.command_handler.all_actor');

        try{
            $actors = $handler->handle();
            $actors = array_map(function(Actor $actor){return $actor->toArray();},$actors);
            return new JsonResponse(['success' =>  'ok', 'actors' => $actors]);
        }catch (\InvalidArgumentException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
    }

    public function AllActorArray():Array
    {
        $handler = $this->get('actor.command_handler.all_actor');

        try{
            $actors = $handler->handle();
            $actors = array_map(function(Actor $actor){return $actor->toArray();},$actors);
            return $actors;
        }catch (\InvalidArgumentException $e){
            return array();
        }
    }
    public function GetActor(int $id){
        $handler = $this->get('actor.actor_repository.cached');
        try{
            $actor = $handler->findById($id);
            //$actor = $handler->handle($id);
            //$actor = $actor->toArray();
            return $actor;
        }catch (BadOperationException $e){
            return array("");
        }
    }

    public function ActorsListAction(){
        $actors = $this->AllActorArray();
        return $this->render('actor/actors.html.twig', array('actors' => $actors));
    }

    public function ActorDetailAction($id){
        $actor = $this->GetActor($id);
        if(empty($actor) ){
            return $this->render('actor/actor.html.twig', array('actor' => $actor));

        }
        return new Response("<h1>No existe Actor con ese Id</h1>");
    }


    private function end(){
        $this->get('doctrine.orm.default_entity_manager')->flush();
    }

}