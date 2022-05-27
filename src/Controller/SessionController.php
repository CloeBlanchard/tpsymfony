<?php

namespace App\Controller;
use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/session')]
class SessionController extends AbstractController
{
    // methode get pour afficher element de la table
    #[Route('', name: 'app_session_index', methods: ['GET'])]
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'session' => $sessionRepository->findAll(),
        ]);
    }

    // envoie des données à la bd
    #[Route('/new', name: 'app_session_new', methods: ['GET', 'POST'])]
    public function FunctionName(Request $request, SessionRepository $sessionRepository): Response
    {
        $session = new session();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $sessionRepository->add($session, true);

            return $this->redirectToRoute('app_session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/new.html.twig', [
            'session' => $session,
            'form' => $form
        ]);
    }


    // récupère les info d'une session
    #[Route('/{id}', name: 'app_session_show', methods: ['GET'])]
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session
        ]);
    }

    // met à jour les données avec un id
    #[Route('/{id]/edit', name: 'app_session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Session $session, SessionRepository $sessionRepository)
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid()) {
            $sessionRepository->add($session, true);
    
            return $this->redirectoToRoute('app_session_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/edit.html.twig', [
            'session' => $session,
            'form' => $form,
        ]);
    }

    // supprime la session voulue
    #[Route('/{id}', name: 'app_session_delete', methods: ['POST'])]
    public function delete(Request $request, Session $session, SessionRepository $sessionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$session->getId(), $request->request->get('_token'))) {
            $sessionRepository->remove($session, true);
        }

        return $this->redirectToRoute('app_session_index', [], Response::HTTP_SEE_OTHER);
    }
}
