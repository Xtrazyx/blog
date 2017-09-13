<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 16/08/2017
 * Time: 15:07
 */

namespace JHD\Framework;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    use RenderTwig, DoctrineEntityManager, SymfonyForm, SwiftMailer;

    abstract function action(Request $request);

    /**
     * @param $url string
     */
    public function redirect($url)
    {
        $response = new RedirectResponse($url);
        $response->send();
    }

    /**
     * @param $source string
     * @return string
     */
    public function slug($source)
    {
        $rule = array (
            'À' => 'A',
            'Â' => 'A',
            'Æ' => 'AE',
            'Ç' => 'C',
            'É' => 'E',
            'È' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ï' => 'I',
            'Î' => 'I',
            'Ô' => 'O',
            'Œ' => 'OE',
            'Ù' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'à' => 'a',
            'â' => 'a',
            'æ' => 'ae',
            'ç' => 'c',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ï' => 'i',
            'î' => 'i',
            'ô' => 'o',
            'œ' => 'oe',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ÿ' => 'y',
            'Ÿ' => 'Y',
            ' ' => '-'
        );
        return strtolower(trim(strtr($source, $rule)));
    }
}