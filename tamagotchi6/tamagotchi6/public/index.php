<?php
    require_once __DIR__.'/../vendor/autoload.php';
    //require_once __DIR__.'/../src/Repository/Repository.php';
    //require_once __DIR__.'/../src/Repository/MoutonRepository.php';
    




    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Route;
    use Symfony\Component\Routing\RouteCollection;
    use Symfony\Component\Routing\RequestContext;
    use Symfony\Component\Routing\Matcher\UrlMatcher;
    use Symfony\Component\Routing\Exception\ResourceNotFoundException;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    use App\Controller\Game;
use App\Repository\MoutonRepository;



    $loader = new FilesystemLoader([__DIR__.'/../template']);
    $twig = new Environment($loader);

    $request = Request::createFromGlobals();

    $route = new Route('/', ['_controller' => Game::class]);
    $routeCollection = new RouteCollection();
    $routeCollection->add('home', $route);

    $context = new RequestContext('/');
    $urlMatcher = new UrlMatcher($routeCollection, $context);

    try {
        $parameters = $urlMatcher->matchRequest($request);
        $controllerClass = $parameters['_controller'] ?? null;

        if (null === $controllerClass) {
            throw new ResourceNotFoundException();
        }
        /*
        if (isset($_GET["action"])) {

        } */

        $controllerClass == 'App\Controller\Game';
        $controller = new $controllerClass();
        $response = $controller($twig, $request);

    } catch (ResourceNotFoundException $e) {
        $response = new Response('Page not found!', 404);
    } finally {
        $response->send();
    
    }

