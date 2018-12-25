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
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class TimeCellController extends AbstractController
{
    /**
     * @Route("/timecell/{id}", name="timecell_show", requirements={"id"="\d+"})
     * @param int $id
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(int $id, TranslatorInterface $translator)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        /** @var TimeCell $timeCell */
        $timeCell = $this->getDoctrine()
            ->getRepository(TimeCell::class)
            ->find($id);

        if (!$timeCell) {
            throw $this->createNotFoundException($translator->trans("No such time cell."));
        }

        return $this->render('timeCell/show.html.twig', array(
            'timeCell' => $timeCell,
        ));
    }

    /**
     * @Route("/timecell/{id}/edit", name="timecell_edit", requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request, TranslatorInterface $translator)
    {
        /** @var TimeCell $timeCell */
        $timeCell = $this->getDoctrine()
            ->getRepository(TimeCell::class)
            ->find($id);

        if (!$timeCell) {
            throw $this->createNotFoundException($translator->trans("No such time cell."));
        }

        $form = $this->createFormBuilder($timeCell)
            ->add('demand', IntegerType::class)
            ->add('submit', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeCell = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timeCell);
            $entityManager->flush();

            return $this->redirectToRoute('recruitment_show', array(
                'id' => $timeCell->getRecruitment()->getId()
            ));
        }

        return $this->render('timeCell/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/timecell/{id}/apply", name="timecell_apply", requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @param TranslatorInterface $translator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function apply(int $id, Request $request, TranslatorInterface $translator)
    {
        $this->denyAccessUnlessGranted('ROLE_VOLUNTEER');
        /** @var User $user */
        $user = $this->getUser();

        /** @var TimeCell $timeCell */
        $timeCell = $this->getDoctrine()
            ->getRepository(TimeCell::class)
            ->find($id);

        if (!$timeCell) {
            throw $this->createNotFoundException($translator->trans("No such time cell."));
        }

        // if demand is already satisfied
        if ($timeCell->getDemand() <= count($timeCell->getApplicants())) {
            return $this->redirectToRoute('recruitment_show', array(
                'id' => $timeCell->getRecruitment()->getId()
            ));
        }

        // if user has already applied
        if (in_array($user, $timeCell->getApplicants()->getValues())) {
            return $this->redirectToRoute('recruitment_show', array(
                'id' => $timeCell->getRecruitment()->getId()
            ));
        }

        $form = $this->createFormBuilder($timeCell)
            ->add('submit', SubmitType::class, ['label' => 'Confirm'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeCell->addApplicant($user);
            $user->addAppliedTimeCell($timeCell);
            $timeCell = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timeCell);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('recruitment_show', array(
                'id' => $timeCell->getRecruitment()->getId()
            ));
        }

        return $this->render('timeCell/apply.html.twig', array(
            'form' => $form->createView(),
            'timeCell' => $timeCell
        ));
    }
}