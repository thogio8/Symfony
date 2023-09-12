<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BienvenuController extends AbstractController
{
    #[Route('/bienvenue', name: 'app_bienvenu')]
    public function bienvenue(): Response
    {
        //Appel à la vue
        return $this->render('bienvenu/index.html.twig');
    }

    #[Route('/bienvenue/{prenom}', name: 'app_bienvenu_prenom')]
    public function bienvenueAvecPrenom(string $prenom): Response
    {
            //Appel à la vue
        return $this->render('bienvenu/index.html.twig',[
            "prenom" => $prenom
        ]);
    }

    #[Route('/bienvenues', name: 'app_bienvenus')]
    public function bienvenues(): Response
    {
        $personnes = ["jean", "paul", "anne", "julie"];
        //Appel à la vue
        return $this->render('bienvenu/bienvenues.html.twig', [
            "personnes" => $personnes
        ]);
    }
}
