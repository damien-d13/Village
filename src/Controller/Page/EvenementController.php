<?php

namespace App\Controller\Page;

use App\Entity\Adresse;
use App\Entity\Evenement;
use App\Repository\AdresseRepository;
use App\Repository\EvenementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{

    /**
     * @var EvenementRepository
     */
    private $evenementRepository;

    public function __construct(EvenementRepository $evenementRepository)
    {
        $this->evenementRepository = $evenementRepository;
       
        
    }

    /**
     * @Route("/", name="evenement.index")
     * @return Response
     */
    public function index(): Response
    {


        // $em =$this->getDoctrine()->getManager();

        // $adresse =new Adresse();
        // $adresse ->setLabel('Salle polyvalent')
        //             ->setNumber('13')
        //             ->setStreet('avenue doctor queen')
        //             ->setCity('Silent Hill')
        //             ->setCountry('France');
        //             $em->persist($adresse);

        // $evenement = new Evenement();
        // $evenement->setLabel('Evenement sportif')
        //             ->setDescription('Concours , vous etes bienvenu')
        //             ->setLocalisation('https://www.google.fr/maps/preview')
        //             ->setAdresse($adresse);
                
        //         $em->persist($evenement);
        //         $em->flush();

        $evenements = $this->evenementRepository->findLastest();
    
        
        return $this->render('page/evenement/index.html.twig', [
            'evenements' => $evenements
        ]);
    }

     /**
     * @Route("/detail/{slug}-{id}", name="evenement.detail", requirements={"slug": "[a-z0-9\-]*"})
     * @param Evenement $evenement
     * @param Adresse $adresse
     * @return Response
     */
    public function detail(Evenement $evenement, string $slug): Response
    {

        if($evenement->getSlug() !== $slug){
           return $this->redirectToRoute('page.evenement.detail', [
                'id' => $evenement->getId(),
                'slug' => $evenement->getSlug()
            ], 301);
        }

        return $this->render('page/evenement/detail.html.twig', [
            'evenement' => $evenement,
            
        ]);
    }
}
