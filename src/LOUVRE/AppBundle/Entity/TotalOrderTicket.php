<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TotalOrderTicket
 *
 * @ORM\Table(name="total_order_ticket")
 * @ORM\Entity(repositoryClass="LOUVRE\AppBundle\Repository\TotalOrderTicketRepository")
 */
class TotalOrderTicket
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\Ticket", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticket;

    /**
     * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\TotalOrder")
     * @ORM\JoinColumn(nullable=false)
     */
    private $totalOrder;
    

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
     * Set quantity
     *
     * @param integer $quantity
     * @return TotalOrderTicket
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
     * Set ticket
     *
     * @param \LOUVRE\AppBundle\Entity\Ticket $ticket
     * @return TotalOrderTicket
     */
    public function setTicket(\LOUVRE\AppBundle\Entity\Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \LOUVRE\AppBundle\Entity\Ticket 
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set totalOrder
     *
     * @param \LOUVRE\AppBundle\Entity\TotalOrder $totalOrder
     * @return TotalOrderTicket
     */
    public function setTotalOrder(\LOUVRE\AppBundle\Entity\TotalOrder $totalOrder)
    {
        $this->totalOrder = $totalOrder;

        return $this;
    }

    /**
     * Get totalOrder
     *
     * @return \LOUVRE\AppBundle\Entity\TotalOrder 
     */
    public function getTotalOrder()
    {
        return $this->totalOrder;
    }
}
