<?php
namespace  App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class welcomeController extends AbstractController
{ 
          /**
           * 
           * @route("/welcome")
           */
            public  function welcome()
            {
              return  $this->render('welcome.html.twig',[
                  'day' => date('l'),
              ]);
              
            }

}