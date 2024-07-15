<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EvenementController extends AbstractController
{
        // ------------- AFFICHER LISTE DES EVENEMENTS -------------
    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findBy([], ["dateDebut"=> "ASC"]);
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements
        ]);
    }
    
    // ------------- FORMULAIRE CREATION NOUVEL EVENEMENT -------------
    #[Route('/evenement/new', name: 'new_evenement')]
    #[Route('/evenement/{id}/edit', name: 'edit_evenement')]
    public function new_edit(Evenement $evenement = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$evenement) {
            $evenement = new Evenement();
        }
        
        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $evenement = $form->getData();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement');
        }
        
        return $this->render('evenement/new.html.twig',[
            'formAddEvenement'=> $form,
            'edit'=> $evenement->getId()
        ]);
    }
    // ------------- SUPRIMER UN EVENEMENT -------------
    #[Route('/evenement/{id}/suppr', name: 'suppr_evenement')]
    public function supprEvenement(Evenement $evenement, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($evenement);
        $entityManager->flush();

        return $this->redirectToRoute('app_evenement');
    }

    // ------------- AFFICHER UN EVENEMENT -------------
    #[Route('/evenement/{id}', name: 'show_evenement')]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement
        ]);
    }
}
