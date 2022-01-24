<?php

namespace App\Controller\Page;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/")
     */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact.index")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message->setCreatedAt(new \Datetime('now'));
            $entityManager->persist($message);
            $entityManager->flush();
            $this->addFlash('success', 'Message send');
            return $this->redirectToRoute('home');
        }

        return $this->render('page/contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }
}
