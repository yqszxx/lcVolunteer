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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AppointmentController
 * @package App\Controller
 * @Route("/appointment", name="appointment_")
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
}