<?php

namespace LOUVRE\AppBundle\Command;

class LOUVREBookingCode
{
    // Génère le numéro de commande
    public function generateCode()
    { 
        $randomNumber = rand(0, 1000);
        
        $letters = [ 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $i = rand(0, 25);
        $letter = $letters[$i];
        
        $time = time();
        
        $bookingCode = $letter . $randomNumber . 'LOUVRE' . $time;
        
        return $bookingCode;
    }
}