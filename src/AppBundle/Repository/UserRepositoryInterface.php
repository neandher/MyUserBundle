<?php

namespace AppBundle\Repository;

use AppBundle\Model\UserInterface;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return UserInterface|null
     */
    public function findOneByEmail($email);
}