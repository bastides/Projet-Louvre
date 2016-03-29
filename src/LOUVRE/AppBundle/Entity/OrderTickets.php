<?php

namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderTickets
 *
 * @ORM\Table(name="order_tickets")
 * @ORM\Entity(repositoryClass="LOUVRE\AppBundle\Repository\OrderTicketsRepository")
 */
class OrderTickets
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
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="order_number", type="string", length=255, nullable=true)
     */
    private $orderNumber;

    

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
     * @return OrderTickets
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
     * @return OrderTickets
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
     * Set orderNumber
     *
     * @param string $orderNumber
     * @return OrderTickets
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return string 
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }
}
