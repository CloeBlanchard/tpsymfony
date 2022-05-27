<?php

namespace App\Controller;
use App\Entity\OrganismeFormation;
use App\Form\OrganismeFormationType;
use App\Repository\OrganismeFormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/organismeFormation')]
class OrganismeFormationController extends AbstractController
{
// methode get pour afficher element de la table
    #[Route('', name: 'app_OrganismeFormation_index', methods: ['GET'])]
    public function index(OrganismeFormationRepository $organismeFormationRepository): Response
    {
        return $this->render('organisme_formation/index.html.twig', [
            'organisme_formation' => $organismeFormationRepository->findAll()
        ]);
    }

    // methode post pour envoyer des donnée dans la db
    #[Route('/new', name: 'app_OrganismeFormation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OrganismeFormationRepository $organismeFormationRepository): Response
    {
        $organisme = new OrganismeFormation();
        $form = $this->createForm(OrganismeFormationType::class, $organisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $organismeFormationRepository->add($organisme, true);

            return $this->redirectToRoute('app_OrganismeFormation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organisme_formation/new.html.twig', [
            'organisme_formation' => $organisme,
            'form' => $form,
        ]);
    }

    // afficher les données d'un organisme
    #[Route('/{id}', name: 'app_OrganismeFormation_show', methods: ['GET'])]
    public function show(OrganismeFormation $organisme): Response
    {
        return $this->render('organisme_formation/show.html.twig', [
            'organisme_formation' => $organisme,
        ]);
    }

    // met à jour les donnée avec un id
    #[Route('/{id}/edit', name: 'app_OrganismeFormation_edit', methods: ['PATCH'])]
    public function edit(Request $request, OrganismeFormation $organisme, OrganismeFormationRepository $organismeFormationRepository): Response
    {
        $form = $this->createForm(OrganismeFormationType::class, $organisme);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $organismeFormationRepository->add($organisme, true);

            return $this->redirectToRoute('app_OrganismeFormation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organisme_formation/edit.html.twig', [
            'organisme_formation' => $organisme,
            'form' => $form,
        ]);
    }

    // supprime l'organisme voulue
    #[Route('/{id}', name: 'app_OrganismeFormation_delete', methods: ['POST'])]
    public function delete(Request $request, OrganismeFormation $organisme, OrganismeFormationRepository $organismeFormationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organisme->getId(), $request->request->get('_token'))) {
            $organismeFormationRepository->remove($organisme, true);
        }

        return $this->redirectToRoute('app_OrganismeFormation_index', [], Response::HTTP_SEE_OTHER);
    }
}
