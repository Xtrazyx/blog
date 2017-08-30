<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 30/08/2017
 * Time: 12:01
 */

namespace JHD\Framework;

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Twig_Environment;
use Twig_Loader_Filesystem;

trait SymfonyForm
{
    public function getFormFactory()
    {
        $config = new Config();

        // CSRF Token Manager
        $session = new Session();
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($session);
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        // TWIG
        $twig = new Twig_Environment(new Twig_Loader_Filesystem(array(
            $config->getConfigsByKey('twig')['templatePath'],
            $config->getConfigsByKey('twig')['bridgePath'],
        )));
        $formEngine = new TwigRendererEngine(array($config->getConfigsByKey('twig')['defaultFormThemePath']), $twig);
        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
            TwigRenderer::class => function () use ($formEngine, $csrfManager) {
                return new TwigRenderer($formEngine, $csrfManager);
            },
        )));

        // Validator
        $validator = Validation::createValidator();

        // Translation
        $translator = new Translator('fr');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', $config->getConfigsByKey('symfony')['formTranslationPath'], 'fr', 'validators');
        $translator->addResource('xlf', $config->getConfigsByKey('symfony')['validatorTranslationPath'], 'fr', 'validators');

        $twig->addExtension(new FormExtension());

        // Set up the Form component
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->addExtension(new CsrfExtension($csrfManager))
            ->addExtension(new ValidatorExtension($validator))
            ->getFormFactory();

        return $formFactory;
    }
}