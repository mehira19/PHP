<?php

//require_once("lib/db_parms.php");
class DataLayer
{
  private $connexion;

  // établit la connexion à la base en utilisant les infos de connexion des constantes DB_DSN, DB_USER, DB_PASSWORD
  // susceptible de déclencher une PDOException
  public function __construct()
  {
    /*$this->connexion = new PDO(
                       DB_DSN, DB_USER, DB_PASSWORD,
                       [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // déclencher une exception en cas d'erreur
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // chaque ligne du résultat sera une table associative
                       ]
                     );*/
    $this->connexion = new  \PDO('mysql:host=127.0.0.1;dbname=Game;port=8889', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
  }
  // SELECT setval('posts_id_seq', 7)

  function getUser($login)
  {
    $sql = <<<EOD
      select pseudo, score from users where pseudo=:login
EOD;
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $res = $stmt->fetchAll();
    return $res;
  }

  function signUp($pseudo, $password)
  {
    //echo gettype($this->connexion);
    $sql = <<<EOD
      insert into users (pseudo, password)
      values (:pseudo, :password)
EOD;
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':pseudo', $pseudo);
    $stmt->bindValue(':password', password_hash($password, CRYPT_BLOWFISH));
    $stmt->execute();
    return $this->getUser($pseudo);
  }

  function getUsers()
  {
    $sql = <<<EOD
      select pseudo, score from users
EOD;
    $stmt = $this->connexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function login($login, $password)
  {
    $sql = <<<EOD
      select pseudo, password from users where pseudo=:login
EOD;
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $res = $stmt->fetchAll();
    if (count($res) == 0) {
      return NULL;
    }
    $login = $res[0]['pseudo'];
    $motDePass = $res[0]['password'];
    if (crypt($password, $motDePass) == $motDePass) {
      return new Identite($login);
    }
    return NULL;
  }
}
