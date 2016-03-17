<?php

namespace LOUVRE\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function homeAction()
    {
        return $this->render('LOUVREAppBundle:App:home.html.twig');
    }
    
    // Renvoie false si le billet est acheté à une date antérieur à aujourd'hui
    public function getValidTicket($date)
    {
        $todayMidnight = strtotime('today midnight');
        
        $currentTime = strtotime($date);
        
        if ($currentTime < $todayMidnight) {
            return false;
        } else {
            return true;
        }
    }
    
    // Renvoie false si le billet est acheté après 14h
    public function getValidDayTicket($date) 
    {
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 * 14);
        
        $currentTime = strtotime($date);
        
        if ($currentTime > $today14h) {
            return false;
        } else {
            return true;
        }
    }
    
    // Renvoie false si le billet est acheter pour un mardi
    public function whithOutThuesday($dateTime)
    {
        $date = strftime('%A %d %B', strtotime($dateTime));
        $tuesday = explode(" ", $date);

        if ($tuesday[0] === "Tuesday") {
            return false;
        } else {
            return true;
        }
    }
}
