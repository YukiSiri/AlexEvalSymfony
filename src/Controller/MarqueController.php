<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Form\SupprimerType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarqueController extends AbstractController
{
    #[Route('/', name: 'app_marque_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $marques = $em->getRepository(Marque::class)->findAll();

        return $this->render('marque/index.html.twig', [
            'marques' => $marques,
        ]);
    }

    #[Route('/marque/add', name: 'app_ajouter_marque')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($marque);
            $em->flush();

            return $this->redirectToRoute('app_marque_index');
        }

        return $this->render('marque/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/marque/edit/{id}', name: 'app_modifier_marque')]
    public function edit(int $id, Request $request, EntityManagerInterface $em): Response
    {
        $marque = $em->getRepository(Marque::class)->find($id);

        if (!$marque) {
            throw $this->createNotFoundException('Marque non trouvée');
        }

        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('app_marque_index');
        }

        return $this->render('marque/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/marque/supprimer/{id}', name: 'app_supprimer_categorie')]
    public function supprimer($id, Request $request, ManagerRegistry $doctrine, MarqueRepository $repo): Response
    {
        //creation du formulaire
        //1 je récupère la catégorie
        $marque = $repo->find($id);
        //2 je crée le formulaire
        $form = $this->createForm(SupprimerType::class, $marque);

        //3 gestion du retour en POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on supprime en base
            $em = $doctrine->getManager();
            $em->remove($marque);
            $em->flush();
            //on redirige vers la page d'accueil
            return $this->redirectToRoute("app_marque_index");
        }

        return $this->render('marque/supprimer.html.twig', [
            "marque" => $marque,
            "formulaire" => $form->createView()
        ]);
    }
}