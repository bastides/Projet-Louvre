<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

class ContraintTicketWithoutTuesday extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet pour mardi.';    
}