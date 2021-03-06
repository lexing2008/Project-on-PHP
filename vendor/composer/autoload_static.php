<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbba6c9fe5269ab7243ada487de4e1bb6
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'D' => 
        array (
            'DB\\' => 3,
        ),
        'C' => 
        array (
            'Core\\' => 5,
            'Controllers\\' => 12,
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'DB\\' => 
        array (
            0 => __DIR__ . '/../..' . '/db',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\App' => __DIR__ . '/../..' . '/app/app.php',
        'App\\MainData' => __DIR__ . '/../..' . '/app/MainData.php',
        'Config\\Config' => __DIR__ . '/../..' . '/config/config.php',
        'Controllers\\Site' => __DIR__ . '/../..' . '/controllers/site.php',
        'Core\\CSRF' => __DIR__ . '/../..' . '/core/CSRF.php',
        'Core\\Patterns\\PropertyContainer' => __DIR__ . '/../..' . '/core/patterns/PropertyContainer.php',
        'Core\\Patterns\\Singleton' => __DIR__ . '/../..' . '/core/patterns/Singleton.php',
        'DB\\DB' => __DIR__ . '/../..' . '/db/db.php',
        'Models\\User' => __DIR__ . '/../..' . '/models/user.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbba6c9fe5269ab7243ada487de4e1bb6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbba6c9fe5269ab7243ada487de4e1bb6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbba6c9fe5269ab7243ada487de4e1bb6::$classMap;

        }, null, ClassLoader::class);
    }
}
