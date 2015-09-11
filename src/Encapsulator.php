<?php
namespace Mpociot\IlluminateContao;

use Illuminate\Cache\CacheManager;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;

/**
 * Class Encapsulator
 *
 * @author Original encapsulation pattern contributed by Kayla Daniels
 * @package App\Eloquent
 */
class Encapsulator
{
    private static $conn;

    /**
     * Initialize capsule and store reference to connection
     */
    public static function init()
    {
        if (is_null(self::$conn)) {
            $capsule = new Capsule;

            $container = $capsule->getContainer();
            $container['config']['cache.driver'] = 'file';
            $container['config']['cache.path'] = TL_ROOT .
                DIRECTORY_SEPARATOR . 'system' .
                DIRECTORY_SEPARATOR . 'cache';
            $container['files'] = new Filesystem();

            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => $GLOBALS['TL_CONFIG']['dbHost'],
                'database' => $GLOBALS['TL_CONFIG']['dbDatabase'],
                'username' => $GLOBALS['TL_CONFIG']['dbUser'],
                'password' => $GLOBALS['TL_CONFIG']['dbPass'],
                'charset' => $GLOBALS['TL_CONFIG']['dbCharset'],
                'collation' => 'utf8_unicode_ci',
                'prefix' => 'tl_',
            ]);

            $capsule->setEventDispatcher(new Dispatcher(new Container));

            $capsule->setCacheManager(new CacheManager($container));

            $capsule->setAsGlobal();

            $capsule->bootEloquent();
        }
    }
}