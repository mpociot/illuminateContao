<?php
namespace Mpociot\IlluminateContao;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Validation\Factory;
use Illuminate\Translation\Translator;
use Illuminate\Translation\FileLoader;

class Validator
{
    /**
     * @var Factory
     */
    protected $validation;

    /**
     * Call this method to get singleton
     *
     * @return Validator
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Validator();
        }
        return $inst;
    }

    /**
     * Private constructor so nobody else can instance it
     *
     */
    private function __construct()
    {
        $langPath = TL_ROOT .
            DIRECTORY_SEPARATOR . 'system' .
            DIRECTORY_SEPARATOR . 'lang';
        $loader = new FileLoader(new Filesystem, $langPath);
        $translator = new Translator($loader, 'en');
        $this->validation = new Factory($translator, new Container);
    }

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $data, array $rules, array $messages = array(), array $customAttributes = array())
    {
        return $this->validation->make($data, $rules, $messages, $customAttributes);
    }

    /**
     * Register a custom validator extension.
     *
     * @param  string  $rule
     * @param  \Closure|string  $extension
     * @param  string  $message
     * @return void
     */
    public function extend($rule, $extension, $message = null)
    {
        $this->validation->extend($rule, $extension, $message );
    }

}