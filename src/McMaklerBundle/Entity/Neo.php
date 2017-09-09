<?php

namespace McMaklerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Neo
 *
 * @ORM\Table(name="Neo")
 * @ORM\Entity(repositoryClass="McMaklerBundle\Repository\NeoRepository")
 */
class Neo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="neo_reference_id", type="string", length=255, nullable=true)
     */
    private $neoReferenceId;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="string", length=255, nullable=true)
     */
    private $speed;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_potentially_hazardous_asteroid", type="boolean", options={"default"=0})
     */
    private $isPotentiallyHazardousAsteroid;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="date", length=255)
     */
    private $date;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Neo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set neoReferenceId
     *
     * @param string $neoReferenceId
     * @return Neo
     */
    public function setNeoReferenceId($neoReferenceId)
    {
        $this->neoReferenceId = $neoReferenceId;

        return $this;
    }

    /**
     * Get neoReferenceId
     *
     * @return string 
     */
    public function getNeoReferenceId()
    {
        return $this->neoReferenceId;
    }

    /**
     * Set speed
     *
     * @param string $speed
     * @return Neo
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set isPotentiallyHazardousAsteroid
     *
     * @param boolean $isPotentiallyHazardousAsteroid
     * @return Neo
     */
    public function setIsPotentiallyHazardousAsteroid($isPotentiallyHazardousAsteroid)
    {
        $this->isPotentiallyHazardousAsteroid = $isPotentiallyHazardousAsteroid;

        return $this;
    }

    /**
     * Get isPotentiallyHazardousAsteroid
     *
     * @return boolean 
     */
    public function getIsPotentiallyHazardousAsteroid()
    {
        return $this->isPotentiallyHazardousAsteroid;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Neo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
