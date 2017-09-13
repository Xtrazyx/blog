<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 01/09/2017
 * Time: 13:23
 */

namespace JHD\Form;

use JHD\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, array('label' => 'Auteur'))
            ->add('dateCreation', HiddenType::class)
            ->add('content', TextareaType::class, array('label' => 'Contenu'))
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comment::class
        ));
    }
}