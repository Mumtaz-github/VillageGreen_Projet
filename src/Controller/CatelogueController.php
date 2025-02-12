<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatelogueController extends AbstractController
{
    #[Route('/catelogue', name: 'app_catelogue')]  //        c je laisse soule / le page catelogue va afficher directment sur browser
    public function index(): Response
    {
        return $this->render('catelogue/index.html.twig');             // [ 'controller_name' => 'CatelogueController',]);
    
    }
}
