<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderTicket
 *
 * @ORM\Table(name="order_ticket")
 * @ORM\Entity(repositoryClass="LOUVRE\AppBundle\Repository\OrderTicketRepository")
 */
class OrderTicket
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
    * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\Order", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $order;

    /**
    * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\Ticket", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $ticket;


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
     * @return OrderTicket
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
     * Set order
     *
     * @param \LOUVRE\AppBundle\Entity\Order $order
     * @return OrderTicket
     */
    public function setOrder(\LOUVRE\AppBundle\Entity\Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \LOUVRE\AppBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set ticket
     *
     * @param \LOUVRE\AppBundle\Entity\Ticket $ticket
     * @return OrderTicket
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
}
