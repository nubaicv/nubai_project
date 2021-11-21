<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Entity\SubFamilies;
use App\Repository\SubFamiliesRepository;
use App\Entity\Families;
use App\Repository\FamiliesRepository;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function index(ValidatorInterface $validator, ProductsRepository $pr): Response
    {
        
//        $em = $this->getDoctrine()->getManager();
//        
//        $family = new Families();
//        $family->setName('Equipamentos informaticos');
//        $em->persist($family);
//        
//        $sub_family = new SubFamilies();
//        $sub_family->setName('Acessorios');
//        $sub_family->setFamily($family);
//        $em->persist($sub_family);
//        
//        $product = new Products();
//        $product->setCode('PCODE002');
//        $product->setName('Labtop HP Inspiron');
//        $product->setDescription('The best laptop in the market');
//        $product->setPrice('45000');
//        $product->setSubfamily($sub_family);
//        
//        $errors = $validator->validate($product);
//        if (count($errors) > 0) {
//            
//            return new Response((string) $errors, 400);
//        }
//        
//        $em->persist($product);
//        $em->flush();
        
        return $this->render('product_list.html.twig', [
            'controller_name' => 'ProductsController',
            'title' => 'Lista dos produtos',
        ]);
    }
    
    #[Route('/product/{id}', name: 'product_show', requirements: ['id' => '\d+'])]
    public function product_show(int $id, ProductsRepository $pr) {
        
        $product = $pr->find($id);
        
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        
        return $this->render('product_show.html.twig', [
            'product' => $product,
        ]);
    }
}
