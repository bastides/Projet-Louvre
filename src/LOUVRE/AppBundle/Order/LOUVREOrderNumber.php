<?php

namespace LOUVRE\AppBundle\Order;

class LOUVREOrderNumber
{
    // Génère le numéro de commande
    public function generateNumber($id)
    { 
        $time = time();
        $orderNumber = $id . 'LOUVRE' . $time;
        return $orderNumber;
    }
}