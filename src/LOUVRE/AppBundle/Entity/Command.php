<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LOUVRE\AppBundle\Validator\Constraints\ConstraintTicket;
use LOUVRE\AppBundle\Validator\Constraints\ConstraintTicketWithoutHoliday;
use LOUVRE\AppBundle\Validator\Constraints\ConstraintTicketWithoutTuesday;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="LOUVRE\AppBundle\Repository\CommandRepository")
 */
class Command
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
     * @var \DateTime
     * 
     * @Assert\Date(message = "Vous devez entrer une date valide.")
     *
     * @ConstraintTicket()
     * @ConstraintTicketWithoutHoliday()
     * @ConstraintTicketWithoutTuesday()
     *
     * @ORM\Column(name="bookingDay", type="date")
     */
    private $bookingDay;

    /**
     * @var string
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="ticketType", type="string", length=255)
     */
    private $ticketType;

    /**
     * @var int
     * @Assert\Range(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Vous devez commander au moins {{ limit }} billet",
     *      maxMessage = "Vous ne pouvez pas commander plus de {{ limit }} billets"
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de billets entré doit être un chiffre."
     * )
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     * @Assert\Email(
     *     message = "Votre Email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingCode", type="string", length=255, unique=true)
     */
    private $bookingCode;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="command", cascade={"persist"})
     */
    private $tickets;
    
    
    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }


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
     * Set bookingDay
     *
     * @param \DateTime $bookingDay
     * @return Command
     */
    public function setBookingDay($bookingDay)
    {
        $this->bookingDay = $bookingDay;

        return $this;
    }

    /**
     * Get bookingDay
     *
     * @return \DateTime 
     */
    public function getBookingDay()
    {
        return $this->bookingDay;
    }

    /**
     * Set ticketType
     *
     * @param string $ticketType
     * @return Command
     */
    public function setTicketType($ticketType)
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    /**
     * Get ticketType
     *
     * @return string 
     */
    public function getTicketType()
    {
        return $this->ticketType;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Command
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Command
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bookingCode
     *
     * @param string $bookingCode
     * @return Command
     */
    public function setBookingCode($bookingCode)
    {
        $this->bookingCode = $bookingCode;

        return $this;
    }

    /**
     * Get bookingCode
     *
     * @return string 
     */
    public function getBookingCode()
    {
        return $this->bookingCode;
    }
    
    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }
    
        
    public function addTicket(Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }
    

    public function removeTicket(Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }
}
