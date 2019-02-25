<?php
/**
 * Created by PhpStorm.
 * User: yqszxx
 * Date: 12/25/18
 * Time: 3:39 PM
 */

namespace App\Controller;

use App\Entity\Attendance;
use App\Entity\User;
use RobThree\Auth\TwoFactorAuth;
use RobThree\Auth\TwoFactorAuthException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class AttendanceController
 * @package App\Controller
 * @Route("/attendance", name="attendance_")
 */
class AttendanceController extends AbstractController
{
    /**
     * @Route("/signin", name="signin")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signIn(Request $request, TranslatorInterface $translator)
    {
        /* @var $user User */
        $user = $this->getUser();

        if (count($user->getAppliedTimeCells()->getValues()) == 0) {
            $this->createAccessDeniedException();
        }

        if ($user->getCurrentAttendance() != null) {
            return $this->redirectToRoute('attendance_signout');
        }

        $secret = "2SGYMKJTI24CZW72";

        $em = $this->getDoctrine()->getManager();
        try {
            $tfa = new TwoFactorAuth();
        } catch (TwoFactorAuthException $e) {
            // do nothing
        }

        $form = $this->createFormBuilder()
            ->add('sign_in_code', TextType::class)
            ->add('sign_in', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $code = $data['sign_in_code'];

            if ($tfa->verifyCode($secret, $code)) {
                try {
                    $now = new \DateTime();
                } catch (\Exception $e) {

                }

                $attendance = new Attendance();
                $attendance->setSignInTime($now);
                $attendance->setOwner($user);
                $user->addAttendance($attendance);
                $user->setCurrentAttendance($attendance);

                $em->persist($user);
                $em->persist($attendance);
                $em->flush();

                $this->addFlash('success', $translator->trans("Successfully signed in."));
                return $this->redirectToRoute('attendance_signout');
            } else {
                $this->addFlash('fail', $translator->trans("Sign in code incorrect."));
            }
        }

        return $this->render('attendance/signIn.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/signout", name="signout")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function signOut(Request $request, TranslatorInterface $translator) {
        if (!$this->getUser()->getCurrentAttendance()) {
            $this->addFlash('fail', "Not signed in yet.");
            return $this->redirectToRoute('attendance_signin');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder()
            ->add('sign_out', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $now = new \DateTime();
            } catch (\Exception $e) {

            }
            /* @var $user User */
            $user = $this->getUser();
            $attendance = $user->getCurrentAttendance();
            $attendance->setSignOutTime($now);
            $user->setCurrentAttendance(null);

            $em->persist($user);
            $em->persist($attendance);
            $em->flush();

            $this->addFlash('success', $translator->trans("Successfully signed out."));
            return $this->redirectToRoute('attendance_signin');
        }

        return $this->render('attendance/signOut.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/all", name="all")
     * @IsGranted("ROLE_ADMIN")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAll() {
        $em = $this->getDoctrine()->getManager();

        $attendances = $em->getRepository(Attendance::class)->findAll();

        return $this->render('attendance/showAll.html.twig', ['attendances' => $attendances]);
    }
}