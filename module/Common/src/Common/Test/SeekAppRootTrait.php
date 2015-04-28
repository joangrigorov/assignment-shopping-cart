<?php

namespace Common\Test;

/**
 * Trait SeekAppRootTrait
 *
 * Used to find the application root path
 *
 * @package Common\Test
 */
trait SeekAppRootTrait
{

    /**
     * Seeks application root directory
     *
     * @param string $currentDir
     * @return string
     */
    public static function seekAppRoot($currentDir)
    {
        if (file_exists($currentDir . '/config/application.config.php')) {
            return $currentDir;
        }
        return self::seekAppRoot(dirname($currentDir));
    }

    /**
     * Seek application config file
     *
     * @param string $currentDir
     * @return string
     */
    public static function seekAppConfig($currentDir)
    {
        return self::seekAppRoot($currentDir) . '/config/application.config.php';
    }

}