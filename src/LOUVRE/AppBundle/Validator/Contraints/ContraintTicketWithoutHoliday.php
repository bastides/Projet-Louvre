<?php

namespace LOUVRE\AppBundle\Validator\Contraints;

use Symfony\Component\Validator\Constraint;

class ContraintTicketWithoutHoliday extends Constraint
{
    public $message = 'Vous ne pouvez pas commander de billet un jour férié.';    
}