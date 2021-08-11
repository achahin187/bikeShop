<?php
namespace  App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

Class productController extends AbstractController
{ 
          /**
           * 
           * @route("/products")
           */
            public  function index(ProductRepository $repo,Request $request,SessionInterface $session) 
            {
                $products = $repo->findBy([]);

                $basket=$session->get('basket',[]);
                foreach($products as $product){
                    if($request->isMethod('post')) {
                        $basket[$product->getId()] =$product;
                        $session->set('basket',$basket);
                    }

                }
                $inBasket=array_key_exists($product->getId(),$basket);

            
              return  $this->render('products.html.twig',[
                  'products' => $products,
                  'inBasket' =>$inBasket,
                  
              ]);
              
            }


              /**
           * 
           * @route("/product/{id}")
           */

           public function show($id,ProductRepository $repo,Request $request,SessionInterface $session) :Response
           {
               $product=$repo->find($id);

               $basket=$session->get('basket',[]);
             
                   if($request->isMethod('post')) {
                       $basket[$product->getId()] =$product;
                       $session->set('basket',$basket);
                   }
                   $inBasket=array_key_exists($product->getId(),$basket);

               

               if($product == null){
                return $this->render('error.html.twig');
                }else{
                return $this->render('product.html.twig',[
                    'product' => $product,
                    'inBasket' =>$inBasket,

                ]);
               }

           

           }

        

}