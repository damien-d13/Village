<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement", name="evenement")
     * @return Response
     */
    public function index(): Response
    {
        $adresse =new Adresse();
        $adresse ->setLabel('Salle des fêtes')
                    ->setNumber('13')
                    ->setStreet('avenue du general de Gaulle')
                    ->setCity('Silent Hill');
                    $em =$this->getDoctrine()->getManager();
                    $em->persist($adresse);
        $evenement = new Evenement();
        $evenement->setLabel('Evenement musical')
                    ->setDescription('Concert gratuit, vous etes bienvenu')
                    ->setLocalisation('https://www.google.fr/maps/preview')
                    ->setAdresse($this->adresse);
                $em =$this->getDoctrine()->getManager();
                $em->persist($evenement, $adresse);
                $em->flush();
        return $this->render('evenement/index.html.twig', [
            'controller_name' => 'EvenementController',
        ]);
    }
}
