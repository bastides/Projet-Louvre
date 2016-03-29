<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var \DateTime
     *
     * @ORM\Column(name="day_book", type="date")
     */
    private $dayBook;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="booking_code", type="string", length=255, unique=true, nullable=true)
     */
    private $bookingCode;

    /**
     * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\OrderTickets", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderTickets;
    
    /**
     * @ORM\OneToOne(targetEntity="LOUVRE\AppBundle\Entity\Visitor", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $visitor;

    

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
     * Set dayBook
     *
     * @param \DateTime $dayBook
     * @return Ticket
     */
    public function setDayBook($dayBook)
    {
        $this->dayBook = $dayBook;

        return $this;
    }

    /**
     * Get dayBook
     *
     * @return \DateTime 
     */
    public function getDayBook()
    {
        return $this->dayBook;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set price
     *
     * @param integer $price
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
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set bookingCode
     *
     * @param string $bookingCode
     * @return Ticket
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
     * Set orderTickets
     *
     * @param \LOUVRE\AppBundle\Entity\OrderTickets $orderTickets
     * @return Ticket
     */
    public function setOrderTickets(\LOUVRE\AppBundle\Entity\OrderTickets $orderTickets)
    {
        $this->orderTickets = $orderTickets;

        return $this;
    }

    /**
     * Get orderTickets
     *
     * @return \LOUVRE\AppBundle\Entity\OrderTickets 
     */
    public function getOrderTickets()
    {
        return $this->orderTickets;
    }

    /**
     * Set visitor
     *
     * @param \LOUVRE\AppBundle\Entity\Visitor $visitor
     * @return Ticket
     */
    public function setVisitor(\LOUVRE\AppBundle\Entity\Visitor $visitor = null)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get visitor
     *
     * @return \LOUVRE\AppBundle\Entity\Visitor 
     */
    public function getVisitor()
    {
        return $this->visitor;
    }
}
