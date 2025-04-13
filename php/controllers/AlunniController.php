<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args)
  {
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $mioId = $args["id"];
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id=" . $mioId);
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }


  public function create(Request $request, Response $response, $args)
  {
    $body=json_decode($request->getBody()->getContents(), true);
    $nome=$body["nome"];
    $cognome=$body["cognome"];

    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')");
    if($mysqli_connection->affected_rows>0)
    {
      $results=["msg"=>"ok"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Content-type", "application/json")->withStatus(201);
    }
    $results=["msg"=>"ko"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(400);
    
  }

  public function update(Request $request, Response $response, $args)
  {
    $body=json_decode($request->getBody()->getContents(), true);
    $nome=$body["nome"];
    $cognome=$body["cognome"];
    $mioId = $args["id"];

    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("UPDATE alunni (nome, cognome) VALUES ('$nome', '$cognome') WHERE id =" . $mioId);
    if($mysqli_connection->affected_rows>0)
    {
      $results=["msg"=>"ok"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Content-type", "application/json")->withStatus(201);
    }
    $results=["msg"=>"ko"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(400);
    
  }

  public function delete(Request $request, Response $response, $args)
  {
    $body=json_decode($request->getBody()->getContents(), true);
    $nome=$body["nome"];
    $cognome=$body["cognome"];
    $mioId = $args["id"];

    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE id =" . $mioId);
    if($mysqli_connection->affected_rows>0)
    {
      $results=["msg"=>"ok"];
      $response->getBody()->write(json_encode($results));
      return $response->withHeader("Content-type", "application/json")->withStatus(201);
    }
    $results=["msg"=>"ko"];
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(400);
    
  }

}
