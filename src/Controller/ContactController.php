<?php
// src/Controller/ContactController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {
    
    #[Route('/contact', name: 'contact_page')]
    public function index() :Response {
        
        return $this->render('contact.html.twig', [
            'title' => 'Contact',
        ]);
    }
}