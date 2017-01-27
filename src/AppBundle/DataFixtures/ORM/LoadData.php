<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Foo;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Video;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $video = new Video();
        $video->setName('TOTO')->setDescription('Description à la con');
        $foo = new Foo();
        $foo->setBar('test');
        $video->setFoos([$foo]);
        $manager->persist($foo);
        $manager->persist($video);
        $manager->flush();
    }
}