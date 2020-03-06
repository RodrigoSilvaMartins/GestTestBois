<?php

namespace App\Controller\Front;

use App\Entity\Image;
use App\Entity\Question;
use App\Entity\SubChapter;
use App\Form\NewQuestionFormType;
use App\Repository\ChapterRepository;
use App\Repository\ExamRepository;
use App\Repository\LevelRepository;
use App\Repository\QuestionRepository;
use App\Repository\SubChapterRepository;
use App\Repository\SubjectRepository;
use App\Repository\ThemeRepository;
use App\View\QuestionView;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="landing_page")
     */
    public function landingPage()
    {
        return $this->render('landingPage.html.twig', ['hello' => 'VIKI', 'title' => 'Nom de données']);
    }

    /**
     * @Route("/question", name="questions_page", methods={"GET", "POST", "PUT"})
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
    public function questionsPage(Request $request, QuestionRepository $repository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $question = new Question();
        $newFrom = $this->createForm(NewQuestionFormType::class, $question, array(
            'method' => 'put'));

        $newFrom->handleRequest($request);
        if ($newFrom->isSubmitted() && $newFrom->isValid()) {
            /** @var Question $question */
            $question = $newFrom->getData();
            $question->setUser($this->getUser());

            $editQuestion = $this->imageConversion($question, $entityManager);

            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('questions_page');
        }

        $editQuestion = new Question();
        $editForm = $this->createForm(NewQuestionFormType::class, $editQuestion, array(
            'method' => 'put'));

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var Question $editQuestion */
            $editQuestion = $editForm->getData();
            $editQuestion->setUser($this->getUser());
            $editQuestion = $this->imageConversion($editQuestion, $entityManager);

            $entityManager->persist($editQuestion);
            $entityManager->flush();

            return $this->redirectToRoute('questions_page');
        }

        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('questionsId'),
            $request->request->get('subChaptersId')
        ), 'json'));
        return $this->render('questions.html.twig', ['title' => 'Questions', 'questions' => json_decode($response->getContent(), true), 'newForm' => $newFrom->createView(), 'editForm' => $editForm->createView()]);
    }

    public function imageConversion(Question $question,ObjectManager $entityManager) : Question
    {
        if (!empty($question->getImage())) {
            /** @var UploadedFile $image */
            $image = $question->getImage();
            $strm = fopen($image->getRealPath(), 'rb');
            $newImage = Image::create($image->getClientOriginalName(), stream_get_contents($strm), $image->getMimeType());
            $entityManager->persist($newImage);
            $question->setImage($newImage);
        }
        return $question;
    }

    /**
     * @Route(name="levels_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of levels",
     *     @Model(type=LevelView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Levels filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="levelsId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Levels")
     */
    public function levelPage(Request $request, LevelRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('levelsId')
        ), 'json'));

        return $this->render('levels.html.twig', ['title' => 'Niveaux', 'levels' => json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/chapter", name="chapters_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of chapters",
     *     @Model(type=ChapterView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Chapters filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="chaptersId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="themesId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Chapters")
     */
    public function ChaptersPage(Request $request, ChapterRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('chaptersId'),
            $request->request->get('themesId')
        ), 'json'));

        return $this->render('chapters.html.twig', ['title' => 'Chapitres', 'chapters' => json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/subChapter", name="subChapters_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of subchapter",
     *     @Model(type=SubChapterView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Subchapters filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="subChaptersId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="chaptersId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="themesId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="SubChapters")
     */
    public function SubChaptersPage(Request $request, SubChapterRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('subChaptersId'),
            $request->request->get('chaptersId'),
            $request->request->get('levelsId')
        ), 'json'));

        return $this->render('chapters.html.twig', ['title' => 'Chapitres', 'chapters' => json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/theme", name="themes_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of themes",
     *     @Model(type=themeView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Themes filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="themesId", type="array", @SWG\Items(type="integer")),
     *         	@SWG\Property(property="subjectsId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Themes")
     */
    public function ThemesPage(Request $request, ThemeRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('themesId'),
            $request->request->get('subjectsId')
        ), 'json'));

        return $this->render('themes.html.twig', ['title' => 'Thèmes', 'themes' => json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/subject", name="subjects_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of subjects",
     *     @Model(type=themeView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Subjects filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="subjectsId", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Subjects")
     */
    public function SubjectsPage(Request $request, SubjectRepository $repository): Response
    {
        $response = new Response($this->get('serializer')->serialize($repository->list(
            $request->request->get('subjectsId')
        ), 'json'));

        return $this->render('subjects.html.twig', ['title' => 'Sujet', 'subjects' => json_decode($response->getContent(), true)]);
    }

    /**
     * @Route("/exam", name="exams_page", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns a list of subjects",
     *     @Model(type=examView::class)
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Exams filters",
     *     required=false,
     *     @SWG\Schema(
     *     @SWG\Items(
     *            type="object",
     *        	@SWG\Property(property="examsID", type="array", @SWG\Items(type="integer")),
     *     ),
     *     )
     * )
     *
     * @SWG\Tag(name="Exams")
     */
    public function ExamsPage(Request $request, ExamRepository $examRepository, QuestionRepository $questionRepository): Response
    {

        $exams = $examRepository->list();
        $questions = $questionRepository->list();

        return $this->render('exams.html.twig', ['title' => 'Exams', 'exams' => $exams, 'questions' => $questions]);
    }

    /**
     * @Route ("/question/{id}/edit", name="edit_question", methods={"GET"})
     */
    public function EditQuestion(Request $request, QuestionRepository $repository,$id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $question = $entityManager->find(Question::class, $id);
        $editForm = $this->createForm(NewQuestionFormType::class, $question, array(
            'method' => 'put',
            'action' => $this->generateUrl('questions_page')));

        return new  Response($this->renderView('modelAddQuestion.html.twig',['editForm' => $editForm->createView()]));
    }

    /**
     * @Route ("/question/{id}/delete", name ="delete_question", methods={"GET", "POST", "DELETE"})
     */
    public function deleteQuestion(Request $request, EntityManager $em, $id)
    {
        $em->remove($em->find(Question::class, $id));
        $em->flush();
        $this->redirectToRoute('questions_page');
    }
}
