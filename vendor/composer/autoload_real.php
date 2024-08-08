<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit0d2e82d59817dd0b7b9f332b7fc3c519
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

        spl_autoload_register(array('ComposerAutoloaderInit0d2e82d59817dd0b7b9f332b7fc3c519', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit0d2e82d59817dd0b7b9f332b7fc3c519', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit0d2e82d59817dd0b7b9f332b7fc3c519::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
