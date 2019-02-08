<?php

namespace acmjBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comptable
 *
 * @ORM\Table(name="comptable")
 * @ORM\Entity
 */
class Comptable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMCOMPTABLE", type="string", length=128, nullable=true)
     */
    private $nomcomptable;

    /**
     * @var string
     *
     * @ORM\Column(name="PRENOMCOMPTABLE", type="string", length=128, nullable=true)
     */
    private $prenomcomptable;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGINCOMPTABLE", type="string", length=128, nullable=true)
     */
    private $logincomptable;

    /**
     * @var string
     *
     * @ORM\Column(name="MDPCOMPTABLE", type="string", length=128, nullable=true)
     */
    private $mdpcomptable;


}

