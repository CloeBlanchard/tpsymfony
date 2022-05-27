<?php

namespace App\Controller;
use App\Entity\Promotion;
use App\Form\PromotionType;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/promotion')]
class PromotionController extends AbstractController
{
    // methode get pour afficher element de la table
    #[Route('', name: 'app_promotion_index', methods: ['GET'])]
    public function index(PromotionRepository $promotionRepository): Response
    {
        return $this->render('promotion/index.html.twig', [
            'promotion' => $promotionRepository->findAll(),
        ]);
    }

    // envoie des données à la bd
    #[Route('/new', name: 'app_promotion_new', methods: ['GET', 'POST'])]
    public function FunctionName(Request $request, PromotionRepository $promotionRepository): Response
    {
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class, $promotion);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $promotionRepository->add($promotion, true);

            return $this->redirectToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('promotion/new.html.twig', [
            'promotion' => $promotion,
            'form' => $form
        ]);
    }

    // récupère les info d'une promotion
    #[Route('/{id}', name: 'app_promotion_show', methods: ['GET'])]
    public function show(Promotion $promotion): Response
    {
        return $this->render('promotion/show.html.twig', [
            'promotion' => $promotion
        ]);
    }

    // met à jour les données avec un id
    #[Route('/{id]/edit', name: 'app_promotion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Promotion $promotion, PromotionRepository $promotionRepository)
    {
        $form = $this->createForm(PromotionType::class, $promotion);
         $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $promotionRepository->add($promotion, true);

            return $this->redirectoToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('promotion/edit.html.twig', [
            'promotion' => $promotion,
            'form' => $form,
        ]);
    }

     // supprime la promotion voulue
    #[Route('/{id}', name: 'app_promotion_delete', methods: ['POST'])]
    public function delete(Request $request, Promotion $promotion, PromotionRepository $promotionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$promotion->getId(), $request->request->get('_token'))) {
            $promotionRepository->remove($promotion, true);
        }

        return $this->redirectToRoute('app_promotion_index', [], Response::HTTP_SEE_OTHER);
    }
}
