<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="LOUVRE\AppBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre nom doit comprendre au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne doit pas comprendre plus {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Votre prénom doit comprendre au moins {{ limit }} caractères",
     *      maxMessage = "Votre prénom ne doit pas comprendre plus {{ limit }} caractères"
     * )
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var \DateTime
     * @Assert\Date(message = "Vous devez entrer une date valide.")
     *
     * @ORM\Column(name="birthDate", type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @var bool
     * @Assert\Type(type="bool")
     *
     * @ORM\Column(name="reducedPrice", type="boolean", nullable=true)
     */
    private $reducedPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="ticketname", type="string", length=255, nullable=true)
     */
    private $ticketname;
    
    /**
     * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\Command", inversedBy="tickets", cascade={"persist"})
     */
    private $command;


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
     * Set lastname
     *
     * @param string $lastname
     * @return Ticket
     */
    public function setLastname($lastname)
    {
        $lastname = strtoupper($lastname);

        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $firstname = ucfirst($firstname);

        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     * @return Ticket
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime 
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set reducedPrice
     *
     * @param boolean $reducedPrice
     * @return Ticket
     */
    public function setReducedPrice($reducedPrice)
    {
        $this->reducedPrice = $reducedPrice;

        return $this;
    }

    /**
     * Get reducedPrice
     *
     * @return boolean 
     */
    public function getReducedPrice()
    {
        return $this->reducedPrice;
    }

    /**
     * Set command
     *
     * @param \LOUVRE\AppBundle\Entity\Command $command
     * @return Ticket
     */
    public function setCommand(\LOUVRE\AppBundle\Entity\Command $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return \LOUVRE\AppBundle\Entity\Command 
     */
    public function getCommand()
    {
        return $this->command;
    }
    

    /**
     * Set price
     *
     * @param string $price
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set ticketname
     *
     * @param string $ticketname
     * @return Ticket
     */
    public function setTicketname($ticketname)
    {
        $this->ticketname = $ticketname;

        return $this;
    }

    /**
     * Get ticketname
     *
     * @return string 
     */
    public function getTicketname()
    {
        return $this->ticketname;
    }
}
