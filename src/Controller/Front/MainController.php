<?php

namespace App\Controller\Front;

use App\Repository\QuestionRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\View\QuestionView;
use Swagger\Annotations as SWG;

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
     * @Route("/api/question.list", name="getQuestionsList", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of questions",
     *     @Model(type=QuestionView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Questions filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="questionsId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="subChaptersId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Questions")
     */
    public function getQuestionsList(Request $request, QuestionRepository $repository): Response
    {
        return new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('questionsId'),
            $request->request->get('subChaptersId')
        ), 'json'));
    }
}
