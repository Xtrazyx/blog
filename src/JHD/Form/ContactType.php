<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 01/09/2017
 * Time: 13:23
 */

namespace JHD\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, array('label' => 'Nom'))
            ->add('last_name', TextType::class, array('label' => 'Prénom'))
            ->add('email', TextType::class, array(
                'label' => 'Email',
                'constraints' => array(
                    new Email(
                        array(
                            'message' => 'Entrez un email valide.'
                        )
                    )
                )))
            ->add('message', TextareaType::class, array('label' => 'Message'))
            ->add('envoyer', SubmitType::class)
        ;
    }
}