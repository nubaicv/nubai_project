<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Form\ProductsType;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function index(
            Request $request,
            ProductsRepository $pr): Response
    {
        
        $products = $pr->findAll();
        
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute('products');
        }
        
        return $this->renderForm('product_list.html.twig', [
            'controller_name' => 'ProductsController',
            'title' => 'Lista dos produtos',
            'products' => $products,
            'form' => $form,
        ]);
    }
    
    #[Route('/product/{name}', name: 'product_show')]
    public function product_show(string $name, ProductsRepository $pr) {
        
        $product = $pr->findOneBy(['name' => $name]);
        
        if (!$product) {
            throw $this->createNotFoundException(
                'Product ' . $name . ' not found'
            );
        }
        
        return $this->render('product_show.html.twig', [
            'product' => $product,
        ]);
    }
}
