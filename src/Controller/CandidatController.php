<?php

namespace App\Controller;
use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidat')]
class CandidatController extends AbstractController
{
    // methode get pour afficher element de la table
    #[Route('', name: 'app_candidat_index', methods: ['GET'])]
    public function index(CandidatRepository $candidatRepository): Response
    {
        return $this->render('candidat/index.html.twig', [
            'candidat' => $candidatRepository->findAll(),
        ]);
    }

    // envoie des données à la bd
    #[Route('/new', name: 'app_candidat_new', methods: ['GET', 'POST'])]
    public function FunctionName(Request $request, CandidatRepository $candidatRepository): Response
    {
        $candidat = new Candidat();
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $candidatRepository->add($candidat, true);

            return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidat/new.html.twig', [
            'candidat' => $candidat,
            'form' => $form
        ]);
    }

    // récupère les info d'une candidat
    #[Route('/{id}', name: 'app_candidat_show', methods: ['GET'])]
    public function show(Candidat $candidat): Response
    {
        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat
        ]);
    }

    // met à jour les données avec un id
    #[Route('/{id]/edit', name: 'app_candidat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidat $candidat, CandidatRepository $candidatRepository)
    {
        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()) {
            $candidatRepository->add($candidat, true);

            return $this->redirectoToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('candidat/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
        ]);
    }

    // supprime la candidat voulue
    #[Route('/{id}', name: 'app_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, Candidat $candidat, CandidatRepository $candidatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $candidatRepository->remove($candidat, true);
        }
 
        return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
     }
}
