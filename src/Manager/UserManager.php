<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;


    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ) {
        $this->em = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function getUser($id)
    {
       return $this->em->getRepository(User::class)->find($id);
    }
}