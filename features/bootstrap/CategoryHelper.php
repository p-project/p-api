<?php

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManager;

class CategoryHelper extends ResourceHelper
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function createResource()
    {
        $category = new Category();
        $category->setName('string')->setDescription('string');

        return $category;
    }
}
