<?php

namespace Acme\bsceneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MeetingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'label' => '* Event Title',
                'required' => true,
                'attr' => array('id' =>'title')))
           
            ->add('date','text', array(
                'label' => '* Date',
                'required' => true,
                'attr' => array('id' =>'date')))
            ->add('time')
            ->add('endDate','text', array(
                'label' => '* End Date',        
                'required' => true,
                'attr' => array('id' =>'endDate')))
            ->add('endTime')
            ->add('description','textarea')
            ->add('capacity')
            ->add('venue')
            ->add('organization')
            ->add('image','file', array(
                'label' => "Event Logo",
                'required' => false,
                'attr' => array('id' => 'image')))
           
            ->add('account')
            ->add('category')
          
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\bsceneBundle\Entity\Meeting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_bscenebundle_meeting';
    }
}
