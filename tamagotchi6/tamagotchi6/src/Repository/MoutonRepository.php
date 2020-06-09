<?php

declare(strict_types=1);


namespace App\Repository;

// gère la bdd
use App\Entity\Mouton;
use Repository;

class MoutonRepository 
{

    private $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new \PDO( 'mysql:host=127.0.0.1;dbname=dbtamagotchi;port=8889', 'root', 'root'); 
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 
        } catch(\PDOException $e) {
            echo $e->getMessage();
        } 
    }
    

    // créé le mouton et le retourne avec son id
    public function create(Mouton $mouton): Mouton {
        $stmt = $this->pdo->prepare("INSERT INTO mouton (hunger, playfulness, sleepiness, life) VALUES (:hunger, :playfulness, :sleepiness, :life)");
        
        $stmt->bindValue(":hunger", $mouton->getHunger());
        $stmt->bindValue(":playfulness", $mouton->getPlayfulness());
        $stmt->bindValue(":sleepiness", $mouton->getSleepiness());
        $stmt->bindValue(":life", $mouton->getLife());

        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result !== FALSE) {
            $mouton->setId($result["id"]);
        } else {
            echo "erreur";
        }
        return $mouton;
    }

    // modifie le mouton et le retourne
    public function update(Mouton $mouton): Mouton {
        $stmt = $this->pdo->prepare("UPDATE mouton SET hunger = :hunger, playfulness = :playfulness, sleepiness = :sleepiness, life = :life WHERE id = :id");
        $stmt->bindValue(":hunger", $mouton->getHunger());
        $stmt->bindValue(":playfulness", $mouton->getPlayfulness());
        $stmt->bindValue(":sleepiness", $mouton->getSleepiness());
        $stmt->bindValue(":life", $mouton->getLife());
        $stmt->bindValue(":id", $mouton->getId());
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result === FALSE) {
            echo "error";
        }
        return $mouton;
    }

    // supprime le mouton et retourne un booleen.
    public function delete(Mouton $mouton): bool {
        $stmt = $this->pdo->prepare("DELETE FROM mouton WHERE id = :id");
        $stmt->bindValue(":id", $mouton.getId());
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $result;
    }

    // retourne un mouton selon l'id en paramètre, null sinon.
    public function findOne($id): ?Mouton {
        $stmt = $this->pdo->prepare("SELECT * FROM mouton WHERE id=:id");
        $stmt->bindValue(":id", $id);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'App\Entity\Mouton');
        $stmt->execute();

        $result = $stmt->fetch();

        return $result;
    }
}
