<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 24/03/2019
 * Time: 2:31 PM
 */

namespace FilmApi\AppBundle\Controller;


use FilmApi\Application\Command\Film\CreateFilmCommand;
use FilmApi\Application\Command\Film\UpdateFilmCommand;
use FilmApi\Domain\Exception\BadOperationException;
use FilmApi\Domain\Film;
use http\Exception\BadConversionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    public function createFilm(Request $request):JsonResponse
    {
        $jsonReq = json_decode($request->getContent());
        $name = filter_var($jsonReq->name ?? '', FILTER_SANITIZE_STRING);
        $description = filter_var($jsonReq->description ?? '', FILTER_SANITIZE_STRING);
        $actorId = filter_var($jsonReq->actor ?? '', FILTER_SANITIZE_NUMBER_INT);
        try{
            $actor = $this->get("actor.command_handler.get_actor")->handle($actorId);

        }catch (BadOperationException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
        if($actor){
            $command = new CreateFilmCommand($name, $description, $actor);
            $handler = $this->get('film.command_handler.create_film');
            try{
                $film = $handler->handle($command);
                $this->end();
                return new JsonResponse(['success' =>  'create ok', '$film' => $film]);
            }catch (\InvalidArgumentException $e){
                return new JsonResponse(['error' => $e->getMessage() ], 400);
            }

        }
    }

    public function updateFilm(Request $request):JsonResponse
    {
        $jsonReq = json_decode($request->getContent());
        $id = filter_var($jsonReq->id ?? '', FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($jsonReq->name ?? '', FILTER_SANITIZE_STRING);
        $description = filter_var($jsonReq->description ?? '', FILTER_SANITIZE_STRING);
        $actorId = filter_var($jsonReq->actor ?? '', FILTER_SANITIZE_NUMBER_INT);
        try{
            $actor = $this->get("actor.command_handler.get_actor")->handle($actorId);

        }catch (BadOperationException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
        if($actor){
            $command = new UpdateFilmCommand($id, $name, $description, $actor);
            $handler = $this->get("film.command_handler.update_film");
            try{
                $film = $handler->handle($command);
                $this->get("film.film_repository.cached")->deleteCache($id);
                $this->end();
                return new JsonResponse(['success' =>  'update ok', 'film' => $film->toArray()]);
            }catch (BadOperationException $e){
                return new JsonResponse(['error' => $e->getMessage() ], 400);
            }

        }
    }

    public function deleteFilm(int $id):JsonResponse
    {
        $id = filter_var($id ?? '', FILTER_SANITIZE_NUMBER_INT);
        $handler = $this->get('film.command_handler.delete_film');

        try{
            $film = $handler->handle($id);
            $this->end();
            return new JsonResponse(['success' =>  'delete ok', 'id_film' => $id]);
        }catch (BadOperationException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
    }

    public function AllFilm():JsonResponse
    {
        $handler = $this->get('film.command_handler.all_film');

        try{

            $films = $handler->handle();
            $films = array_map(function(Film $film ){return $film->toArray();},$films);
            return new JsonResponse(['success' =>  'ok', 'films' => $films]);
        }catch (\InvalidArgumentException $e){
            return new JsonResponse(['error' => $e->getMessage() ], 400);
        }
    }

    public function GetFilm(int $id): Array
    {

        $handler = $this->get('film.film_repository.cached');

        try{

            $film = $handler->findById($id);
            $film = $film->toArray();
            return $film;
        }catch (\InvalidArgumentException $e){
            return array();
        }
    }
    private function end(){
        $this->get('doctrine.orm.default_entity_manager')->flush();
    }

    public function AllFilmToArray():Array
    {
        $handler = $this->get('film.command_handler.all_film');

        try{

            $films = $handler->handle();
            $films = array_map(function(Film $film ){return $film->toArray();},$films);
            return $films;
        }catch (\InvalidArgumentException $e){
            return array();
        }
    }

    public function FilmsListAction(){
        $films = $this->AllFilmToArray();
        return $this->render('film/films.html.twig', array('films' => $films));
    }

    public function FilmDetailAction(int $id){
        $film = $this->GetFilm($id);
        return $this->render('film/film.html.twig', array('film' => $film));
    }
}