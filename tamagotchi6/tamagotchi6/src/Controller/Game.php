<?php
// Dans src/Controller

declare(strict_types=1);

namespace App\Controller;


use App\Repository\MoutonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class Game
{
    public $mouton;

    public function __construct() {
        $repository = new MoutonRepository();
        $this->mouton = $repository->findOne(1);
    }

    public function __invoke(Environment $twig, Request $request): Response
    {
        $action = null;
        if (isset($_POST["action"])) {
            $action = $_POST["action"];
        }

        //var_dump($action);

        switch($action) {
            case "Run":
                $this->mouton->goToPlay();
            case "Sleep":
                $this->mouton->goToSleep();
            case "Eat":
                $this->mouton->goToEat();
            case "Doctor":
                $this->mouton->goToDoctor();
            default:
                $this->mouton->circleOfLife();
        }

        return new Response($twig->render('tamagotchi.html.twig', ['mouton' => $this->mouton]));
    }
}
