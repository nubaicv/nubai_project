<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Form\ProductsType;

class ProductsController extends AbstractController {
    #[Route('/products', name: 'products')]

    public function index(
            Request $request,
            ProductsRepository $pr,
            PaginatorInterface $paginator): Response {

//        $products = $pr->findBy([], ['id' => 'DESC']);

        $query = $pr->getProductsList();
        $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5,
        );

        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('products');
        }

        $user = $this->getUser();

        return $this->renderForm('product_list.html.twig', [
                    'controller_name' => 'ProductsController',
                    'title' => 'lista dos produtos',
//                    'products' => $products,
                    'form' => $form,
                    'user' => $user,
                    'pagination' => $pagination
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

        $subfamily = $product->getSubfamily();
        $family = $subfamily->getFamily();

        return $this->render('product_show.html.twig', [
                    'product' => $product,
                    'subfamily' => $subfamily,
                    'family' => $family,
        ]);
    }

}
