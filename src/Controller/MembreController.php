<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Utilisateur;
use App\Repository\MembreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MembreController extends AbstractController
{
    // ------------- AFFICHER LISTE DES MEMBRES -------------

    #[Route('/membre', name: 'app_membre')]
    public function index(MembreRepository $membreRepository): Response
    {
        $membres = $membreRepository->findBy([], ["nom"=> "ASC"]);
        return $this->render('membre/index.html.twig', [
            'membres' => $membres
        ]);
    }

    // ------------- AFFICHER DÉTAIL MEMBRE ------------- ne fonctionne pas

    // #[Route('/membre/{id}', name: 'show_membre')]
    // public function show(Membre $membre): Response
    // {
    //     return $this->render('membre/show.html.twig', [
    //         'membre' => $membre
    //     ]);
    // }
}