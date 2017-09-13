<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 01/09/2017
 * Time: 13:23
 */

namespace JHD\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class EditPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->get('dateLastModif')
            ->addModelTransformer(new DateTimeToStringTransformer());
        ;
    }

    public function getParent()
    {
        return AddPostType::class;
    }
}