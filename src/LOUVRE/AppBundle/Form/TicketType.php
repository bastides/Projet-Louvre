<?php

namespace LOUVRE\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use LOUVRE\AppBundle\Form\OrderTicketsType;

class TicketType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayBook', DateType::class, array(
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy'))
            ->add('type', ChoiceType::class, array('choices'  => array(
                'Journée' => 'Journée',
                'Demi-journée' => 'Demi-journée'),
                'choices_as_values' => true))
            ->add('orderTickets', OrderTicketsType::class)
            ->add('save', SubmitType::class, array('label' => 'Valider'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LOUVRE\AppBundle\Entity\Ticket'
        ));
    }
}
