<?php

namespace App\Controller\Page;

use App\Entity\Adresse;
use App\Entity\Evenement;
use App\Entity\Image;
use App\Repository\AdresseRepository;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Image $image
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $evenements = $this->evenementRepository->findlastestQueryBuilder();
         $pagination = $paginator->paginate(
             $evenements, /* query NOT result */
             $request->query->getInt('page', 1)/*page number*/,
             10/*limit per page*/
         );
        return $this->render('page/evenement/index.html.twig', [
             'pagination' => $pagination,
        ]);
    }

     /**
     * @Route("/detail/{slug}-{id}", name="evenement.detail", requirements={"slug": "[a-z0-9\-]*"})
     * @param Evenement $evenement
     * @param Adresse $adresse
     * @param Image $image
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
