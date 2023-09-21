<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Trick;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    private $entityManager;
    private $limit = 2;
    public $dspN;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        $dsp = $this->dspN = "";
        $tricks = $this->entityManager->getRepository(Trick::class)->findBy(array(), null, $this->limit);
        return $this->render('home/index.html.twig', [
            'home_user' => 'My friend', 'tricks' => $tricks, 'dsp' => $dsp,
        ]);
    }
    #[Route('/home/loadMore', name: 'app_home_loadMore')]
    public function loadMore(): Response
    {
        $dsp = $this->dspN = "dspN";
        $tricks = $this->entityManager->getRepository(Trick::class)->findAll();
        return $this->render('home/index.html.twig', [
            'home_user' => 'My friend', 'tricks' => $tricks, 'dsp' => $dsp,
        ]);
    }
}
