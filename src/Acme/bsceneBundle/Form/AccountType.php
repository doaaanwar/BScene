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
            ->add('username', 'text', array(
                'label' => '* Username',
                'required' => true,
                'attr' => array('id' =>'username')))
            
            ->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'first_options'  => array(
                    'label' => '* Password'),
                'second_options' => array('label' => '* Repeat Password'),
                'required' => true,
                'type' => 'password',
                'attr' => array ('id' => 'password')))
            
            ->add('firstName', 'text', array (
                'label' => '* First Name',
                'required' => true,
                'attr' => array('id' => 'firstName')))
                
            ->add('lastName', 'text', array (
                'label' => '* Last Name',
                'required' => true,
                'attr' => array('id' => 'lastName')))
                
            ->add('email', 'email', array (
                'label' => '* E-mail Address',
                'required' => true,
                'attr' => array ('id' => 'email')))
                
            ->add('backupEmail', 'hidden', array (
                'label' => 'Secondary E-mail Address',
                'required' => false,
                'attr' => array('id' => 'backupEmail')))
                
            ->add('businessPhone', 'text', array (
                'label' => '* Business Phone',
                'required' => true,
                'attr' => array('id' => 'busPhone')))
                
            ->add('url', 'url', array (
                'label' => 'URL',
                'required' => false,
                'attr' => array('id' => 'memberUrl')))
                
            ->add('address1', 'text', array (
                'label' => 'Address Line 1',
                'required' => false,
                'attr' => array('id' => 'address1')))
                
            ->add('address2', 'text', array (
                'label' => 'Address Line 2',
                'required' => false,
                'attr' => array('id' => 'address2')))
                
            ->add('province', 'entity', array (
                'class' => 'AcmebsceneBundle:Province',
                'label' => 'Province',
                'required' => false,
                'attr' => array('id' => 'prov')))
                
            ->add('paymentAmount', 'hidden', array (
                'label' => 'Payment Amount',
                'required' => false,
                'attr' => array('id' => 'fee')))
                
            ->add('memberSince', 'date', array (
                'label' => 'Member Since: ',
                'required' => false,
                'attr' => array('id' => 'memberSince')))
                
            ->add('isAdmin', 'hidden', array (
                'label' => 'Admin',
                'required' => false,
                'attr' => array('id' => 'isAdmin')))
                
            ->add('lastLogin','date',  array (
                'label' => 'Last Login: ',
                'required' => false,
                'attr' => array('id' => 'lastLogin')))
                
            ->add('city', 'text', array (
                'label' => 'City',
                'required' => false,
                'attr' => array('id' => 'city')))
                
            ->add('organization', 'entity', array (
                'class' => 'AcmebsceneBundle:Organization',
                'label' => '* Organization/Company',
                'required' => true,
                'attr' => array('id' => 'organization')))
                
            ->add('status', 'hidden', array (
                'label' => 'Account Status',
                'required' => false,
                'attr' => array('id' => 'accountStatus')))
                            
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
