<?php
namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\EvenementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Route("/admin/evenement")
     */
class AdminEvenementController extends  AbstractController
{

    /**
     * @var $repository
     */
    private $repository;

    public function __construct(EvenementRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/", name="admin_evenement_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $evenements = $this->repository->findAll();
        return $this->render('admin/evenement/index.html.twig', [
            'evenements' => $evenements
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_evenement_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Evenement $evenement )
    {


        $form = $this->createForm(EvenementType::class, $evenement);
        return $this->render('admin/evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView()
        ]);
    }

}




?>