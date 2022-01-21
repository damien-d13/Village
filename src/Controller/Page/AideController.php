<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/aide")
     */
class AideController extends AbstractController
{
    /**
     * @Route("/", name="aide.index")
     */
    public function index()
    {
        return $this->render('page/aide/index.html.twig', [
            'controller_name' => 'AideController',
        ]);
    }
}
