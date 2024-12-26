<?php

namespace Core;
use PDO;

class Database
{
  public $connection;
  public $statement;

  public function __construct($config, $username = 'root', $password = '')
  {

    $dsn = 'mysql:' . http_build_query($config, '', ';'); // http_build_query generates a url from a given string opposite of parse_url.

    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  public function query($query, $params = [])
  {
    $this->statement = $this->connection->prepare($query);

    $this->statement->execute($params);

    return $this;
  }

  public function findAll()
  {
    return $this->statement->fetchAll();
  }

  public function findSingle()
  {
    return $this->statement->fetch();
  }

  public function findSingleOrAbort()
  {
    $result = $this->findSingle();

    if (! $result) {
      // Load 404 page if no notes found with the requested id.
      abort();
    }

    return $result;
  }
}
