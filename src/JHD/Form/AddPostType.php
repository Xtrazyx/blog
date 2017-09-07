<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 01/09/2017
 * Time: 13:23
 */

namespace JHD\Form;

use JHD\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('author', TextType::class, array('label' => 'Auteur'))
            ->add('dateLastModif', HiddenType::class)
            ->add('intro', TextType::class, array('label' => 'Introduction'))
            ->add('content', TextareaType::class, array('label' => 'Contenu'))
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Post::class
        ));
    }
}