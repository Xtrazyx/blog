<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 24/08/2017
 * Time: 14:24
 */

namespace JHD\Framework;

use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

trait Twig
{
    public function getTwig()
    {
        $config = new Config();
        $csrfManager = CsrfManager::createCsrfManager();

        // TWIG
        $twigOptions = $config->getConfigsByKey('twig')['options'];
        $templatePath = ROOT_DIR . $config->getConfigsByKey('twig')['templatePath'];
        $bridgePath = ROOT_DIR . $config->getConfigsByKey('twig')['bridgePath'];
        $defaultFormThemePath = $config->getConfigsByKey('twig')['defaultFormThemePath'];

        $loader = new \Twig_Loader_Filesystem(array(
            $templatePath,
            $bridgePath,
        ));
        $twig = new \Twig_Environment($loader, $twigOptions);

        $formEngine = new TwigRendererEngine(array($defaultFormThemePath), $twig);
        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader(array(
            TwigRenderer::class => function () use ($formEngine, $csrfManager) {
                return new TwigRenderer($formEngine, $csrfManager);
            },
        )));

        // Translation
        $translator = new Translator('fr');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', ROOT_DIR . $config->getConfigsByKey('symfony')['formTranslationPath'], 'fr', 'validators');
        $translator->addResource('xlf', ROOT_DIR . $config->getConfigsByKey('symfony')['validatorTranslationPath'], 'fr', 'validators');

        $twig->addExtension(new FormExtension());
        $twig->addExtension(new TranslationExtension($translator));

        return $twig;
    }
}