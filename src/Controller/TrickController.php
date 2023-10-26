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
        $tricksMenu = $this->entityManager->getRepository(Trick::class)->findAll();
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController', 'tricksMenu' => $tricksMenu,
        ]);
    }
    #[Route('/trick/{slug}', name: 'app_trick')]
    public function show(string $slug): Response
    {
        $tricksMenu = $this->entityManager->getRepository(Trick::class)->findAll();
        $trick = $this->entityManager->getRepository(Trick::class)->findOneBy(array('slug'=>$slug));
        $defaultImageLink = $trick->getDefaultImageLink();
        if (isset($trick->updatedAt)) 
        {
            $dspDate = "";
        }
        else{
            $dspDate = "dspDate";
        }
        return $this->render('trick/index.html.twig', [
            'controller_name' => 'TrickController', 'trick' => $trick, 'dspDate' => $dspDate, 'tricksMenu' => $tricksMenu, 'defaultImageLink' => $defaultImageLink,
        ]);
    }
}
