<?php
namespace App\Controllers;
use App\Application\Container;
use App\Http\Request;
use App\Http\Response;
use App\Models\MovieModel;


class MovieController extends Controller
{
    public function __construct(Container $c)
    {
        parent::__construct($c);

    }

    public function index(Request $request, Response $response, $args) {
        $mm = new MovieModel();
        $this->view->add('movies', $mm->all($this->db));
        $this->view->render($response, 'movies.phtml');
    }

    public function detail(Request $request, Response $response, $args) {
        extract($args);
        $mm = new MovieModel();
        $this->view->add('movie', $mm->getById($this->db, $id));
        $this->view->render($response, 'movie.phtml');

    }

    public function add(Request $request, Response $response, $args) {
        $this->view->render($response, 'movie_add.phtml');
    }

    public function store(Request $request, Response $response, $args) {
        $mm = new MovieModel();
        $mm->store($this->db, $request->getParams());
        $this->index( $request,  $response, $args);
    }

    public function delete(Request $request, Response $response, $args) {
        extract($args);
        $mm = new MovieModel();
        if($mm->delete($this->db, $id) > 0) {
            $this->view->add("message", "Movie met id " . $id . " is verwijderd");
        } else {
            $this->view->add("message", "Movie met id " . $id . " is niet verwijderd");
        }
        $this->view->render($response, 'movie_delete.phtml');
    }
}