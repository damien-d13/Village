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
     * @Route("/admin/evenement", name="admin.evenement.index")
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
     * @Route("/admin/evenement/edit/{id}", name="admin.evenement.edit")
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