<?php

namespace App\Controller;

use App\Entity\Information;
use App\Repository\InformationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformationController extends AbstractController
{
    /**
     * @var InformationRepository
     */
    private $informationRepository;

    public function __construct(InformationRepository $informationRepository)
    {
        $this->informationRepository = $informationRepository;
    }

    /**
     * @Route("/information", name="information")
     */
    public function index()
    {
        $informations = $this->informationRepository->findByLabel();

        return $this->render('information/index.html.twig', [
            'informations' => $informations
        ]);
    }

    /**
     * @Route("/information/{slug}-{id}", name="information.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Information
     * @return Response
     */
    public function show(Information $information, string $slug): Response
    {
        
        if($information->getSlug() !== $slug){
            return $this->redirectToRoute('information.show', [
                 'id' => $information->getId(),
                 'slug' => $information->getSlug()
             ], 301);
         }

        return $this->render('information/show.html.twig', [
            'information' => $information
        ]);
    }
}
