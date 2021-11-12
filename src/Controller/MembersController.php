<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegisterType;

class MembersController extends AbstractController
{
    #[Route('/sign_up', name: 'sign_up')]
    public function signup(Request $request): Response
    {
        
        $form = $this->createForm(RegisterType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            //$customer = $form->getData();
            
            $route_name = $request->attributes->get('_route');
            return $this->redirectToRoute($route_name);
        }
        
        return $this->renderForm('sign_up.html.twig', [
            'title' => 'Sign Up | Nubai',
            'form' => $form,
        ]);
    }
    
    #[Route('/login', name: 'sign_in')]
    public function signin(): Response
    {
        return $this->render('sign_in.html.twig', [
            'title' => 'Sign In | Nubai',
        ]);
    }
}
