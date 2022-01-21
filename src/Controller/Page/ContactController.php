<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/contact")
     */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact.index")
     */
    public function index()
    {
        return $this->render('page/contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
