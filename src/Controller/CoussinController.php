<?php

namespace App\Controller;

use App\Entity\Coussin;
use App\Form\CoussinType;
use App\Repository\CoussinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coussin')]
final class CoussinController extends AbstractController
{
    #[Route(name: 'app_coussin_index', methods: ['GET'])]
    public function index(CoussinRepository $coussinRepository): Response
    {
        return $this->render('coussin/index.html.twig', [
            'coussins' => $coussinRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coussin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coussin = new Coussin();
        $form = $this->createForm(CoussinType::class, $coussin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coussin);
            $entityManager->flush();

            return $this->redirectToRoute('app_coussin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coussin/new.html.twig', [
            'coussin' => $coussin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coussin_show', methods: ['GET'])]
    public function show(Coussin $coussin): Response
    {
        return $this->render('coussin/show.html.twig', [
            'coussin' => $coussin,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coussin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coussin $coussin, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoussinType::class, $coussin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coussin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coussin/edit.html.twig', [
            'coussin' => $coussin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coussin_delete', methods: ['POST'])]
    public function delete(Request $request, Coussin $coussin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coussin->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($coussin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coussin_index', [], Response::HTTP_SEE_OTHER);
    }
}
