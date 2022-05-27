<?php

namespace App\Controller;
use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formation')]
class FormationController extends AbstractController
{
    // methode get pour afficher element de la table
    #[Route('', name: 'app_formation_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository): Response
    {
        return $this->render('formation/index.html.twig', [
            'formation' => $formationRepository->findAll(),
        ]);
    }

    // envoie des données à la bd
    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function FunctionName(Request $request, FormationRepository $formationRepository): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formationRepository->add($formation, true);

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form
        ]);
    }

    // récupère les info d'une formation
    #[Route('/{id}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formation
        ]);
    }

    // met à jour les données avec un id
    #[Route('/{id]/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, FormationRepository $formationRepository)
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $formationRepository->add($formation, true);

            return $this->redirectoToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    // supprime la formation voulue
    #[Route('/{id}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, FormationRepository $formationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $formationRepository->remove($formation, true);
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
