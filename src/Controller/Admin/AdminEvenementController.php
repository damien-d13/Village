<?php
namespace App\Controller\Admin;

use App\Entity\Adresse;
use App\Entity\Evenement;
use App\Form\AdresseType;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @Route("/new", name="admin_evenement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_evenement_index');
        }

        return $this->render('admin/evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/show/{id}", name="admin_evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('admin/evenement/show.html.twig', [
            'evenement' => $evenement,
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

    // /**
    //  * @Route("/upload/test", name="upload_test")
    //  */
    // public function temporaryUpLoadAction(Request $request)
    // {
    //     /**@var UploadedFile $uploadedFile */
    //     $uploadedFile = $request->files->get('image');
    //     $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
        
    //     $originalFilename = pathinfo($uploadedFile->getClientOriginalName(),PATHINFO_FILENAME);
    //     $newFilename = $originalFilename.'_'.uniqid().'.'.$uploadedFile->guessExtension();
        
    //     dd($uploadedFile->move(
    //         $destination,
    //         $newFilename
    //     ));
    // }


    /**
     * @Route("/delete/{id}", name="admin_evenement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_evenement_index');
    }
}




?>