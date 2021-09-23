<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function __construct(
        private MovieRepository $movieRepository,
    ) {
    }

    public function index(): Response
    {
        $className = explode('\\', __CLASS__);

        $movies = $this->movieRepository->findAll();

        return $this->render('home/index.html.twig', [
            'currentDate' => (new DateTime())->format('H:i:s d-m-Y'),
            'className' => end($className),
            'functionName' => __FUNCTION__,
            'trailers' => $movies,
        ]);
    }

    public function trailer(int $id): Response
    {
        $trailer = $this->movieRepository->find($id);

        return $this->render('home/trailer.html.twig', [
            'trailer' => $trailer,
        ]);
    }
}
