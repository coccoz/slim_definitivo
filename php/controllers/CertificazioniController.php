<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CertificazioniController
{
    public function index(Request $request, Response $response, $args){
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT * FROM certificazioni");
        $results = $result->fetch_all(MYSQLI_ASSOC);
    
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    public function show(Request $request, Response $response, $args)
    {
        $id = intval($args["id"]);
        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("SELECT * FROM certificazioni WHERE id = $id");
        $results = $result->fetch_all(MYSQLI_ASSOC);

        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(200);
    }

    public function create(Request $request, Response $response, $args)
    {
        $body = json_decode($request->getBody()->getContents(), true);
        $alunno_id = $body["alunno_id"];
        $titolo = $body["titolo"];
        $votazione = $body["votazione"];
        $ente = $body["ente"];

        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("INSERT INTO certificazioni (alunno_id, titolo, votazione, ente) VALUES ('$alunno_id', '$titolo', '$votazione', '$ente')");

        if ($mysqli_connection->affected_rows > 0) {
            $results = ["msg" => "ok"];
            $response->getBody()->write(json_encode($results));
            return $response->withHeader("Content-type", "application/json")->withStatus(201);
        }

        $results = ["msg" => "ko"];
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(400);
    }

    public function update(Request $request, Response $response, $args)
    {
        $id = intval($args["id"]);
        $body = json_decode($request->getBody()->getContents(), true);
        $titolo = $body["titolo"];
        $votazione = $body["votazione"];
        $ente = $body["ente"];

        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("UPDATE certificazioni SET titolo = '$titolo', votazione = '$votazione', ente = '$ente' WHERE id = $id");

        if ($mysqli_connection->affected_rows > 0) {
            $results = ["msg" => "ok"];
            $response->getBody()->write(json_encode($results));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }

        $results = ["msg" => "ko"];
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(400);
    }

    public function delete(Request $request, Response $response, $args)
    {
        $id = intval($args["id"]);

        $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
        $result = $mysqli_connection->query("DELETE FROM certificazioni WHERE id = $id");

        if ($mysqli_connection->affected_rows > 0) {
            $results = ["msg" => "ok"];
            $response->getBody()->write(json_encode($results));
            return $response->withHeader("Content-type", "application/json")->withStatus(200);
        }

        $results = ["msg" => "ko"];
        $response->getBody()->write(json_encode($results));
        return $response->withHeader("Content-type", "application/json")->withStatus(400);
    }
}
