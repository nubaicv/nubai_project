<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegisterType;
use App\Entity\Customers;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MembersController extends AbstractController
{
    #[Route('/sign_up', name: 'sign_up')]
    public function signup(Request $request, UserPasswordHasherInterface $password_hasher): Response
    {
        
        if ($this->getUser()) {
             return $this->redirectToRoute('home_page');
         }
        
        $customer = new Customers();
        
        $form = $this->createForm(RegisterType::class, $customer);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $customer->setPassword($password_hasher->hashPassword($customer, $form['password']->getData()));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            
            $this->addFlash('success', Customers::REGISTERED);
            
            //$customer = $form->getData();
            
            $route_name = $request->attributes->get('_route');
            return $this->redirectToRoute($route_name);
        }
        
        return $this->renderForm('sign_up.html.twig', [
            'title' => 'Sign Up | Nubai',
            'form' => $form,
        ]);
    }
    
}