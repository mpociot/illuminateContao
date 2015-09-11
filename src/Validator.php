<?php
namespace Mpociot\IlluminateContao;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Validation\Factory;
use Symfony\Component\Translation\Translator;
use Illuminate\Translation\FileLoader;

class Validator
{

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $data, array $rules, array $messages = array(), array $customAttributes = array())
    {
        $langPath = TL_ROOT .
            DIRECTORY_SEPARATOR . 'system' .
            DIRECTORY_SEPARATOR . 'lang';
        $loader = new FileLoader(new Filesystem, $langPath);
        $translator = new Translator($loader, 'en');
        $validation = new Factory($translator, new Container);
        return $validation->make($data, $rules, $messages, $customAttributes);
    }

}