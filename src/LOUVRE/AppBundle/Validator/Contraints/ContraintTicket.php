<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

class ContraintTicket extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet sur cette date.';    
}