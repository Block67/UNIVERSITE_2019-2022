<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit6681bc6c8b6db20227e4c2a3e1852fed
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit6681bc6c8b6db20227e4c2a3e1852fed', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit6681bc6c8b6db20227e4c2a3e1852fed', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit6681bc6c8b6db20227e4c2a3e1852fed::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}