<?php
/**
 * Created by PhpStorm.
 * User: yqszxx
 * Date: 4/1/19
 * Time: 3:35 PM
 */

namespace App\Controller;


use App\Entity\Appointment\BookingRecord;
use App\Entity\Appointment\Seat;
use App\Entity\Appointment\SelfStudyRoom;
use App\Entity\Main\Violation;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ViolationController
 * @package App\Controller
 * @Route("/violation", name="violation_")
 * @IsGranted("ROLE_USER")
 */
class ViolationController extends AbstractController
{
    /**
     * @Route("/all", name="all")
     */
    public function showAll()
    {
        $em = $this->getDoctrine()->getManager();

        $violations = $em->getRepository(Violation::class)->findAll();

        return $this->render('violation/showAll.html.twig', ['violations' => $violations]);
    }

    /**
     * @Route("/add/{bookingId}", name="add", requirements={"bookingId"="\d+"})
     * @param $bookingId int
     * @param Request $request
     * @return Response
     */
    public function add($bookingId, Request $request)
    {
        $bookingRecord = $this->getDoctrine()->getRepository(BookingRecord::class, 'appointment')
            ->find($bookingId);
        if (!$bookingRecord) {
            throw new NotFoundHttpException('No such booking record.');
        }

        /* @var $seat Seat */
        $seat = $this->getDoctrine()->getRepository(Seat::class, 'appointment')
            ->find($bookingRecord->getResourceId());
        /* @var $selfStudyRoom SelfStudyRoom */
        $selfStudyRoom = $this->getDoctrine()->getRepository(SelfStudyRoom::class, 'appointment')
            ->find($seat->getParentId());

        try {
            $now = new \DateTime();
        } catch (\Exception $e) {

        }

        $violation = new Violation();
        $violation->setBookingId($bookingId)
            ->setTime($now)
            ->setVolunteer($this->getUser());

        $form = $this->createFormBuilder($violation)
            ->add('reason', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $violation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($violation);
            $em->flush();

            $this->addFlash('success', 'Violation added!');
            return $this->redirectToRoute('appointment_self_study_room', ['roomId' => $selfStudyRoom->getId()]);
        }

        return $this->render('violation/add.html.twig', [
            'form' => $form->createView(),
            'position' => $selfStudyRoom->getName() . $seat->getNumber()
        ]);
    }
}