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
            ->add('title')
            ->add('date')
            ->add('time')
            ->add('endDate')
            ->add('endTime')
            ->add('description')
            ->add('capacity')
            ->add('venue')
            ->add('organization')
            ->add('image')
            ->add('account')
            ->add('category')
            ->add('speakers')
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
