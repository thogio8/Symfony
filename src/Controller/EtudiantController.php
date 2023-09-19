<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

class EtudiantController extends AbstractController
{
    #[Route('/etudiants', name: 'app_etudiant_list')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        //Appel au modele
        //Le controleur va demander au modele la liste des étudiants
        $etudiants = $etudiantRepository->findAll();

        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/etudiants/{id}', name: 'app_etudiant_show', requirements: ['id' => '\d+'])]
    public function show(EtudiantRepository $etudiantRepository, int $id): Response
    {
        //Appel au modele
        //Le controleur va demander au modele la liste des étudiants
        $etudiant = $etudiantRepository->find($id);

        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant
        ]);
    }

    #[Route('/etudiants/mineurs', name: 'app_etudiant_mineurs_list')]
    public function listMineurs(EtudiantRepository $etudiantRepository): Response
    {
        //Appel au modele
        //Le controleur va demander au modele la liste des étudiants

        $etudiants = $etudiantRepository->findMineurs2();

        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }
}
