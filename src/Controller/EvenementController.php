<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findBy([], ["dateDebut"=> "ASC"]);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements
        ]);
    }
    
    #[Route('/evenement/new', name: 'new_evenement')]
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        
        $form = $this->createForm(EvenementType::class, $evenement);
        
        return $this->render('evenement/new.html.twig',[
            'formAddEvenement'=> $form
        ]);
    }
    
        #[Route('/evenement/{id}', name: 'show_evenement')]
        public function show(Evenement $evenement): Response
        {
            return $this->render('evenement/show.html.twig', [
                'evenement' => $evenement
            ]);
        }
}
