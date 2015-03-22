<?php

namespace Acme\bsceneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password'))
            ->add('firstName', 'text', array ('label' => '* First Name'))
            ->add('lastName', 'text', array ('label' => '* Last Name'))
            ->add('email', 'email', array ('label' => '* E-mail Address'))
            ->add('backupEmail', 'email', array ('label' => 'Secondary E-mail Address'))
            ->add('businessPhone', 'text', array ('label' => '* Business Phone'))
            ->add('url', 'url', array ('label' => '* URL'))
            ->add('address1', 'text', array ('label' => 'Address'))
            ->add('address2', 'text', array ('label' => 'Address'))
            ->add('province', 'text', array ('label' => 'Province'))
            ->add('paymentAmount', 'currency', array ('label' => 'Payment Amount'))
            ->add('memberSince', 'date', array ('label' => 'Member Since: '))
            ->add('isAdmin', 'checkbox', array ('label' => 'Admin'))
            ->add('lastLogin','datetime',  array ('label' => 'Last Login: '))
            ->add('city', 'choice', array ('label' => 'City'))
            ->add('organization', 'choice', array ('label' => 'Organization/Company'))
            ->add('status', 'choice', array ('label' => 'Account Status'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\bsceneBundle\Entity\Account'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_bscenebundle_account';
    }
}
