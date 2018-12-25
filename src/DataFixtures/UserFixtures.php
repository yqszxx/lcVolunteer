<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('yqszxx')
            ->setCollege('CEST')
            ->setGender('Male')
            ->setGrade('Udg')
            ->setRoles(['ROLE_ADMIN'])
            ->setStudentNumber('35320182200000')
            ->setPhoneNumber('15900000000')
            ->setRoomNumber('HY1-000');
        $manager->persist($user);

        $user = new User();
        $user->setName('vol')
            ->setCollege('CEST')
            ->setGender('Male')
            ->setGrade('Udg')
            ->setRoles(['ROLE_VOLUNTEER'])
            ->setStudentNumber('35320182200001')
            ->setPhoneNumber('15900000001')
            ->setRoomNumber('HY1-001');
        $manager->persist($user);

        $manager->flush();
    }
}
