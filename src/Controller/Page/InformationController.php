<?php

namespace App\Controller\Page;

use App\Entity\Information;
use App\Repository\InformationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Route("/information")
     */
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
     * @Route("/", name="information.index")
     */
    public function index()
    {
        $informations = $this->informationRepository->findByLabel();

        return $this->render('page/information/index.html.twig', [
            'informations' => $informations
        ]);
    }

    /**
     * @Route("/{slug}-{id}", name="information.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Information
     * @return Response
     */
    public function show(Information $information, string $slug): Response
    {
        
        if($information->getSlug() !== $slug){
            return $this->redirectToRoute('page.information.show', [
                 'id' => $information->getId(),
                 'slug' => $information->getSlug()
             ], 301);
         }

        return $this->render('page/information/show.html.twig', [
            'information' => $information
        ]);
    }
}
