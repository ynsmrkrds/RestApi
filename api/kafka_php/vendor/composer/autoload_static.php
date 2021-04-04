<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52eb1a94a04b7a92f1883d36e4e387a2
{
    public static $files = array (
        'e8aa6e4b5a1db2f56ae794f1505391a8' => __DIR__ . '/..' . '/amphp/amp/lib/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'A' => 
        array (
            'Amp\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Amp\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/amp/lib',
        ),
    );

    public static $prefixesPsr0 = array (
        'K' => 
        array (
            'Kafka\\' => 
            array (
                0 => __DIR__ . '/..' . '/nmred/kafka-php/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit52eb1a94a04b7a92f1883d36e4e387a2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52eb1a94a04b7a92f1883d36e4e387a2::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit52eb1a94a04b7a92f1883d36e4e387a2::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
