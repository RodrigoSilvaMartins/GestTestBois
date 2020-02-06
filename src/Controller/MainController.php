<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function landingPage()
    {
        return $this->render('base.html.twig', ['hello' => 'Hello VIKI']);
    }

    /**
     * @Route("/test")
     */
    public function test(QuestionRepository $repository)
    {
        $repository->find(1);
    }
}