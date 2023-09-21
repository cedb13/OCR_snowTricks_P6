<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;

class TrickController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/trick', name: 'app_trick')]
    public function index(): Response
    {
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController',
        ]);
    }
    #[Route('/trick/{slug}', name: 'app_trick')]
    public function show(string $slug): Response
    {
        $trick = $this->entityManager->getRepository(Trick::class)->findOneBy(array('slug'=>$slug));
        if (isset($trick->updatedAt)) 
        {
            $dspDate = "";
        }
        else{
            $dspDate = "dspDate";
        }
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController', 'trick' => $trick, 'dspDate' => $dspDate,
        ]);
    }
}
