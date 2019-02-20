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
     * @Route("/profile", name="user_profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function profile(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_VOLUNTEER');
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['studentNumber' => $this->getUser()->getStudentNumber()]);

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class, ['disabled' => true])
            ->add('studentNumber', TextType::class, ['disabled' => true])
            ->add('college', TextType::class, ['disabled' => true])
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Male' => 'male',
                    'Female' => 'fema'
                )
            ))
            ->add('phoneNumber', TextType::class)
            ->add('roomNumber', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Submit'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profile updated!');
        }

        return $this->render('user/profile.html.twig', array(
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