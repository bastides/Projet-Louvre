<?php
namespace LOUVRE\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Model\ArrayObject;

/**
 * @ORM\Table
 * @ORM\Entity
 */
class PaymentDetails extends ArrayObject
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="LOUVRE\AppBundle\Entity\Command")
     * @ORM\JoinColumn(nullable=true)
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
     * Set command
     *
     * @param \LOUVRE\AppBundle\Entity\Command $command
     *
     * @return PaymentDetails
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
}
