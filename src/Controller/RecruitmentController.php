<?php
/**
 * Created by PhpStorm.
 * User: yqszxx
 * Date: 12/25/18
 * Time: 10:16 AM
 */

namespace App\Controller;


use App\Entity\Recruitment;
use App\Entity\TimeCell;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RecruitmentController extends AbstractController
{
    /**
     * @Route("/recruitment/all", name="recruitment_all")
     */
    public function showAll() {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $recruitments = $this->getDoctrine()
            ->getRepository(Recruitment::class)
            ->findAll();
        return $this->render("recruitment/showAll.html.twig", array(
            'recruitments' => $recruitments
        ));
    }

    /**
     * @Route("/recruitment/{id}", name="recruitment_show", requirements={"id"="\d+"})
     * @param int $id
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(int $id, TranslatorInterface $translator) {
        $recruitment = $this->getDoctrine()
            ->getRepository(Recruitment::class)
            ->find($id);

        if (!$recruitment) {
            throw $this->createNotFoundException($translator->trans("No such recruitment."));
        }

        $timeTable = array();
        foreach ($recruitment->getTimeCells() as $timeCell) {
            $timeTable[$timeCell->getRowNumber()][$timeCell->getColumnNumber()] = $timeCell;
        }
        return $this->render("recruitment/show.html.twig", array(
            'recruitment' => $recruitment,
            'timeTable' => $timeTable
        ));
    }

//    /**
//     * @Route("/recruitment/{id}/edit", name="recruitment_edit", requirements={"id"="\d+"})
//     * @param int $id
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function edit(int $id) {
//        /* TODO: make this. */
//        $recruitment = $this->getDoctrine()
//            ->getRepository(Recruitment::class)
//            ->find($id);
//
//        if (!$recruitment) {
//            throw $this->createNotFoundException("No such recruitment.");
//        }
//
//        $timeTable = array();
//        foreach ($recruitment->getTimeCells() as $timeCell) {
//            $timeTable[$timeCell->getRowNumber()][$timeCell->getColumnNumber()] = $timeCell;
//        }
//        return $this->render("recruitment/show.html.twig", array(
//            'recruitment' => $recruitment,
//            'timeTable' => $timeTable
//        ));
//    }

    /**
     * @Route("/recruitment/add", name="recruitment_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request) {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $recruitment = new Recruitment();
        $form = $this->createFormBuilder($recruitment)
            ->add('name', TextType::class)
            ->add('timeTableRows', TextType::class)
            ->add('timeTableColumns', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Add'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Recruitment $recruitment */
            $recruitment = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            for ($rowNumber = 1; $rowNumber <= count($recruitment->getTimeTableRows()); $rowNumber++) {
                for ($columnNumber = 1; $columnNumber <= count($recruitment->getTimeTableColumns()); $columnNumber++) {
                    $timeCell = new TimeCell();
                    $timeCell->setRecruitment($recruitment)
                        ->setRowNumber($rowNumber)
                        ->setColumnNumber($columnNumber);
                    $timeCell->setDemand(0);
                    $recruitment->addTimeCell($timeCell);
                    $entityManager->persist($timeCell);
                }
            }

            $entityManager->persist($recruitment);
            $entityManager->flush();

            return $this->redirectToRoute('recruitment_all');
        }

        return $this->render('recruitment/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}