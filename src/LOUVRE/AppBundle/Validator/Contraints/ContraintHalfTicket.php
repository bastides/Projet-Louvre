<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

class ContraintHalfTicket extends Constraint
{
    public $message = 'Vous ne pouvez qu\'un billet demi-journée.';    
}