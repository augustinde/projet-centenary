<?php

namespace App\Controller;

use App\Repository\CentenaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrackrecordController extends AbstractController
{
    #[Route('/trackrecord/{year}', name: 'app_trackrecord')]
    public function index(int $year, CentenaryRepository $centenaryRepository): Response
    {



        return $this->render('trackrecord/index.html.twig', [
        ]);
    }
}
