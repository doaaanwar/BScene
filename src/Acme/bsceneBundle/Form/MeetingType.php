<?php

namespace Acme\bsceneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeetingType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
         $builder
            ->add('title', 'text', array(
            'label' => '* Event Title',
            'required' => true,
            'attr' => array('id' => 'title')))
             ->add('date', 'text', array(
            'label' => '* Date',
            'required' => true,
            'attr' => array('id' => 'date')))
            ->add('time')
            ->add('endDate', 'text', array(
            'label' => 'End Date',
            'required' => true,
            'attr' => array('id' => 'enddDate')))
            ->add('endTime')
            ->add('description', 'textarea')
            ->add('capacity', 'number', array(
            'label' => 'Venue Capacity',
            'data' => '0'
            ))
            ->add('venue', 'hidden')
            ->add('organization', 'hidden', array(
            'data_class' => 'Acme\bsceneBundle\Entity\Organization'
            ))
            ->add('image', 'file', array(
            'data_class' => 'Acme\bsceneBundle\Entity\Image'
            ))
            ->add('account', 'hidden', array(
            'data_class' => 'Acme\bsceneBundle\Entity\Account'
            ))
            ->add('category')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\bsceneBundle\Entity\Meeting'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'acme_bscenebundle_meeting';
    }

}
