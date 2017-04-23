<?php

namespace AppBundle\Entity;

use AppBundle\Model\AdminUserInterface;
use AppBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminUserRepository")
 * @ORM\Table(name="admin_user")
 */
class AdminUser extends BaseUser implements AdminUserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return AdminUser
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return AdminUser
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}