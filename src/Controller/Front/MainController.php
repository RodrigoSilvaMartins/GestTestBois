<?php

namespace App\Controller\Front;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="landing_page")
     */
    public function landingPage()
    {
        return $this->render('landingPage.html.twig', ['hello' => 'VIKI']);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(QuestionRepository $repository)
    {
        return new Response($this->get('serializer')->serialize($repository->find(1), 'json'));
    }
}
