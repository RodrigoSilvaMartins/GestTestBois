<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use App\Entity\Exam;
use App\Entity\ExamQuestion;
use App\Entity\Level;
use App\Entity\Question;
use App\Entity\SubChapter;
use App\Entity\Subject;
use App\Entity\Theme;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createUser('user', 'user'));
        $manager->persist($this->createUser('admin', 'admin', ['ROLE_ADMIN']));

        $subject1 = Subject::create('PRPL');
        $subject2 = Subject::create('FAPO');
        $manager->persist($subject1);
        $manager->persist($subject2);
        $theme1 = Theme::create('le bois', $subject1);
        $theme2 = Theme::create('les personnes', $subject1);
        $theme3 = Theme::create('la chaise', $subject2);
        $manager->persist($theme1);
        $manager->persist($theme2);
        $manager->persist($theme3);
        $chapter1 = Chapter::create('le pourquoi', 1, $theme2);
        $chapter2 = Chapter::create('le oui', 2, $theme2);
        $chapter3 = Chapter::create('le non', 1, $theme1);
        $chapter4 = Chapter::create('le ok', 2, $theme1);
        $manager->persist($chapter1);
        $manager->persist($chapter2);
        $manager->persist($chapter3);
        $manager->persist($chapter4);
        $level1 = Level::create('1');
        $level2 = Level::create('2');
        $level3 = Level::create('3');
        $manager->persist($level1);
        $manager->persist($level2);
        $manager->persist($level3);
        $subChapter1 = SubChapter::create('Debut', 1, $chapter1, $level1);
        $subChapter2 = SubChapter::create('Le future', 2, $chapter1, $level1);
        $subChapter3 = SubChapter::create('Apres le future', 3, $chapter1, $level2);
        $subChapter4 = SubChapter::create('La fin', 4, $chapter1, $level2);
        $subChapter5 = SubChapter::create('Debut', 1, $chapter2, $level1);
        $subChapter6 = SubChapter::create('Le future', 2, $chapter2, $level1);
        $subChapter7 = SubChapter::create('Apres le future', 3, $chapter2, $level2);
        $subChapter8 = SubChapter::create('La fin', 4, $chapter2, $level2);
        $subChapter9 = SubChapter::create('Debut', 1, $chapter3, $level3);
        $subChapter10 = SubChapter::create('Le future', 2, $chapter3, $level3);
        $subChapter11 = SubChapter::create('Apres le future', 3, $chapter3, $level3);
        $subChapter12 = SubChapter::create('La fin', 4, $chapter3, $level3);
        $manager->persist($subChapter1);
        $manager->persist($subChapter2);
        $manager->persist($subChapter3);
        $manager->persist($subChapter4);
        $manager->persist($subChapter5);
        $manager->persist($subChapter6);
        $manager->persist($subChapter7);
        $manager->persist($subChapter8);
        $manager->persist($subChapter9);
        $manager->persist($subChapter10);
        $manager->persist($subChapter11);
        $manager->persist($subChapter12);
        $question1 = Question::create('C\'est quoi le bois?','C\'est la vie',10, null, null, $subChapter1);
        $question2 = Question::create('C\'est quoi une arbre?','C\'est du bois',10, null, null, $subChapter1);
        $question3 = Question::create('C\'est quoi une table?','C\'est du bois',10, null, null, $subChapter2);
        $question4 = Question::create('C\'est quoi une chaise?','C\'est du bois',10, null, null, $subChapter2);
        $question5 = Question::create('C\'est quoi une porte?','C\'est du bois',10, null, null, $subChapter2);
        $manager->persist($question1);
        $manager->persist($question2);
        $manager->persist($question3);
        $manager->persist($question4);
        $manager->persist($question5);
        $exam1 = Exam::create('FirstExam', new \DateTime(), 90, $subject1);
        $manager->persist($exam1);
        $examQuestion1 = ExamQuestion::create(1,$exam1, $question1);
        $examQuestion2 = ExamQuestion::create(2,$exam1, $question2);
        $examQuestion3 = ExamQuestion::create(3,$exam1, $question3);
        $examQuestion4 = ExamQuestion::create(4,$exam1, $question4);
        $examQuestion5 = ExamQuestion::create(5,$exam1, $question5);
        $manager->persist($examQuestion1);
        $manager->persist($examQuestion2);
        $manager->persist($examQuestion3);
        $manager->persist($examQuestion4);
        $manager->persist($examQuestion5);

        $manager->flush();
    }

    private function createUser(string $username, string $password, array $roles = ['ROLE_USER']): User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, $password));
        $user->setRoles($roles);

        return $user;
    }
}
