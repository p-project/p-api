<?php

use AppBundle\Entity\Playlist;
use Doctrine\ORM\EntityManager;

class PlaylistHelper extends ResourceHelper
{
    /**
     * @var ChannelHelper
     */
    private $accountHelper;

    public function __construct(EntityManager $em, AccountHelper $accountHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $accountHelper;
    }

    public function createResource()
    {
        $account = $this->accountHelper->persistResource();

        $playlist = new Playlist();
        $playlist->setAccount($account)->setName('string');

        return $playlist;
    }
}
