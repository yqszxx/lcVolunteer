<?php
/**
 * Created by PhpStorm.
 * User: yqszxx
 * Date: 12/25/18
 * Time: 9:12 AM
 */

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private const collegeListString = <<<EOF
人文学院
社会与人类学院
新闻传播学院
法学院/知识产权研究院/南海研究院
外文学院
艺术学院
数学科学学院
物理科学与技术学院
信息科学与技术学院
电子科学与技术学院
建筑与土木工程学院
化学化工学院
材料学院
经济学院/王亚南经济研究院
管理学院/财务管理与会计研究院
公共事务学院/公共政策研究院
软件学院
国际关系学院/南洋研究院
台湾研究院
教育研究院
马克思主义学院
EOF;

    /**
     * Generate an array with format: ['COLLEGE_NAME'] = 'COLLEGE_NAME'
     * @return array
     */
    private function getColleges()
    {
        $collegeArray = preg_split('/\n/', self::collegeListString);
        $collegeKV = array();
        foreach ($collegeArray as $college) {
            $collegeKV[$college] = $college;
        }
        return $collegeKV;
    }

    /**
     * @Route("/user/all", name="user_all")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAll()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('user/showAll.html.twig', array(
            'users' => $users
        ));
    }

    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request)
    {
        $user = new User();
        $user->setRoles(array('ROLE_VOLUNTEER'));

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('studentNumber', TextType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Male' => 'male',
                    'Female' => 'fema'
                )
            ))
            ->add('phoneNumber', TextType::class)
            ->add('college', ChoiceType::class, array(
                'choices' => $this->getColleges()
            ))
            ->add('grade', ChoiceType::class, array(
                'choices' => array(
                    'Undergraduate' => 'udg',
                    'Graduate' => 'gra'
                )
            ))
            ->add('roomNumber', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/user/{studentNumber}", name="user_show", requirements={"studentNumber"="\d+"})
     * @param int $studentNumber
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(int $studentNumber)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(array(
                'studentNumber' => $studentNumber
            ));

        if (!$user) {
            throw $this->createNotFoundException("No such user.");
        }

        return $this->render('user/show.html.twig', array(
            'user' => $user
        ));
    }
}