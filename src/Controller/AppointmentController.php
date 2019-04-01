<?php
/**
 * Created by PhpStorm.
 * User: yqszxx
 * Date: 3/12/19
 * Time: 9:56 PM
 */

namespace App\Controller;

use App\Entity\Appointment\BookingRecord;
use App\Entity\Appointment\ConferenceRoom;
use App\Entity\Appointment\DictState;
use App\Entity\Appointment\Seat;
use App\Entity\Appointment\SelfStudyRoom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AppointmentController
 * @package App\Controller
 * @Route("/appointment", name="appointment_")
 * @IsGranted("ROLE_USER")
 */
class AppointmentController extends AbstractController
{
    /**
     * @Route("/conference_room/all", name="all_conference_room")
     */
    public function showAllConferenceRoom() {
        $repo = $this->getDoctrine()->getRepository(BookingRecord::class, 'appointment');
        $states = $this->getDoctrine()
            ->getRepository(DictState::class, 'appointment')
            ->findAll();
        $data = [];
        foreach ($states as $state) {
            if (!$this->isGranted("ROLE_ADMIN")) {
                if (!in_array($state->getValue(), [3, 4])) {
                    continue;
                }
            }
            $data[$state->getName()] = [];
            $records = $repo->findBy(['resourceType' => BookingRecord::ConferenceRoom, 'state' => $state->getValue()], ['startTime' => 'DESC'], 10);
            foreach ($records as $record) {
                $roomId = $record->getResourceId();
                $roomName = $this->getDoctrine()
                    ->getRepository(ConferenceRoom::class, 'appointment')
                    ->find($roomId)
                    ->getName();
                $data[$state->getName()][] = [
                    'name' => $roomName,
                    'startTime' => $record->getStartTime(),
                    'endTime' => $record->getEndTime(),
                    'reason' => $record->getReason(),
                ];
            }
        }
        return $this->render('appointment/showAllConferenceRoom.html.twig', ['data' => $data]);
    }


    /**
     * @Route("/self_study_room/all", name="all_self_study_room")
     */
    public function showAllSelfStudyRoom() {
        $rooms = $this->getDoctrine()->getRepository(SelfStudyRoom::class, 'appointment')
            ->findBy(['isDeleted' => false]);
        return $this->render('appointment/showAllSelfStudyRoom.html.twig', ['rooms' => $rooms]);
    }

    /**
     * @Route("/self_study_room/{roomId}", name="self_study_room", requirements={"roomId"="\d+"})
     * @param $roomId int
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSelfStudyRoom($roomId) {
        $map = [];
        /* @var $room SelfStudyRoom */
        $room = $this->getDoctrine()->getRepository(SelfStudyRoom::class, 'appointment')
            ->findOneBy(['id' => $roomId, 'isDeleted' => false]);
        $map['roomName'] = $room->getName();
        $map['x'] = $room->getRows();
        $map['y'] = $room->getColumns();
        for ($x = 1; $x <= $map['x']; $x++) {
            for ($y = 1; $y <= $map['y']; $y++) {
                $map['grid'][$x][$y] = [
                    'number' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                    'status' => 0
                ];
            }
        }
        /* @var $seats Seat[] */
        $seats = $this->getDoctrine()->getRepository(Seat::class, 'appointment')
            ->findBy(['parentId' => $roomId, 'isDeleted' => false]);

        /* @var $statuses BookingRecord[] */
        $statuses = $this->getDoctrine()->getRepository(BookingRecord::class, 'appointment')
            ->findBy(['resourceId' => $seats, 'state' => [4]]);
        $statusesById = [];
        foreach ($statuses as $status) {
            $statusesById[$status->getResourceId()] = [
                'status' => $status->getState(),
                'bookingId' => $status->getId()
            ];
        }
        foreach ($seats as $seat) {
            $map['grid'][$seat->getX()][$seat->getY()] = [
                'number' => $seat->getNumber(),
                'status' => array_key_exists($seat->getId(), $statusesById) ? $statusesById[$seat->getId()]['status'] : 0,
                'bookingId' => array_key_exists($seat->getId(), $statusesById) ? $statusesById[$seat->getId()]['bookingId'] : 0
            ];
        }
        return $this->render('appointment/showSelfStudyRoom.html.twig', ['map' => $map]);
    }
}