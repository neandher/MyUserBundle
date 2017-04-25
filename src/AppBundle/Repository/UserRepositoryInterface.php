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

    /**
     * @param $token
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByConfirmationToken($token);
}