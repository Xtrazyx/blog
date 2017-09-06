<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 30/08/2017
 * Time: 12:01
 */

namespace JHD\Framework;

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;

trait SymfonyForm
{
    public function getFormFactory()
    {
        $csrfManager = CsrfManager::createCsrfManager();

        // Validator
        $validator = Validation::createValidator();

        // Set up the Form component
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

        return $formFactory;
    }
}