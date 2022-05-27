<?php

namespace App\Controller;
use App\Entity\Salle;
use App\Form\SalleType;
use App\Repository\SalleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/salle')]
class SalleController extends AbstractController
{
    // methode get pour afficher element de la table
    #[Route('', name: 'app_salle_index', methods: ['GET'])]
    public function index(SalleRepository $salleRepository): Response
    {
        return $this->render('salle/index.html.twig', [
            'salle' => $salleRepository->findAll(),
        ]);
    }

    // envoie des données à la bd
    #[Route('/new', name: 'app_salle_new', methods: ['GET', 'POST'])]
    public function FunctionName(Request $request, SalleRepository $salleRepository): Response
    {
        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $salleRepository->add($salle, true);

            return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salle/new.html.twig', [
            'salle' => $salle,
            'form' => $form
        ]);
    }

    // récupère les info d'une salle
    #[Route('/{id}', name: 'app_salle_show', methods: ['GET'])]
    public function show(Salle $salle): Response
    {
        return $this->render('salle/show.html.twig', [
            'salle' => $salle
        ]);
    }

    // met à jour les données avec un id
    #[Route('/{id]/edit', name: 'app_salle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Salle $salle, SalleRepository $salleRepository)
    {
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $salleRepository->add($salle, true);

            return $this->redirectoToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('salle/edit.html.twig', [
            'salle' => $salle,
            'form' => $form,
        ]);
    }

    // supprime la salle voulue
    #[Route('/{id}', name: 'app_salle_delete', methods: ['POST'])]
    public function delete(Request $request, Salle $salle, SalleRepository $salleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salle->getId(), $request->request->get('_token'))) {
            $salleRepository->remove($salle, true);
        }

        return $this->redirectToRoute('app_salle_index', [], Response::HTTP_SEE_OTHER);
    }
}
