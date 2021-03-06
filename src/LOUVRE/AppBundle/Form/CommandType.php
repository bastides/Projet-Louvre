<?php

namespace LOUVRE\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use LOUVRE\AppBundle\Form\TicketType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CommandType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookingDay', DateType::class, array(
                'widget' => 'single_text', 'format' => 'dd/MM/yyyy'))
            ->add('ticketType', ChoiceType::class, array('choices'  => array(
                'Journée' => 'Journée',
                'Demi-journée' => 'Demi-journée'),
                'choices_as_values' => true))
            ->add('quantity', IntegerType::class)
            ->add('email', TextType::class)
            ->add('tickets', CollectionType::class, array(
                'entry_type' => TicketType::class ,
                'allow_add' => true
            ))
            ->add('save', SubmitType::class, array('label' => 'Valider'))
        ;
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }
    
    public function onPreSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if ($data->getTickets()->isEmpty()) {
            $form->remove('tickets');
        } else {
            $form->remove('bookingDay');
            $form->remove('ticketType');
            $form->remove('quantity');
            $form->remove('email');
        }
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LOUVRE\AppBundle\Entity\Command'
        ));
    }
}
