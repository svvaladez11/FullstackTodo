<?php

namespace App\Ship\Core\Loaders;

use Generator;

/**
 * Class responsible for loading service middlewares from application containers
 * and the Ship layer. This class scans predefined directories, identifies
 * valid PHP files, and returns their fully qualified class names.
 */
final class MiddlewaresLoader extends BaseLoader
{
    /**
     * Loads all service middlewares from containers and the Ship layer.
     *
     * - Scans the 'Middlewares' directory in each container to find middleware classes.
     * - Includes additional middlewares from the 'Middlewares' directory in the Ship layer.
     * - Returns fully qualified class names of the middlewares as a generator.
     *
     * @return Generator<string> Fully qualified class names of middlewares.
     */
    public function loadMiddlewares(): Generator
    {
        // Iterate through all containers to find their middlewares
        foreach ($this->getContainers() as $container) {
            $middlewaresDir = "$container/Middlewares";

            // Check if the directory exists
            if ($this->isDir($middlewaresDir)) {
                // Retrieve all files from the directory
                $middlewaresDir = scandir($middlewaresDir);

                // Ensure the directory scan succeeded
                if ($middlewaresDir !== false) {
                    foreach ($middlewaresDir as $middleware) {
                        // Include only PHP files that are not symbolic links
                        if ($this->isPhpFile($middleware) && $this->isNotLink($middleware)) {
                            // Return the fully qualified class name of the middleware
                            yield $this->getClassName("$container/Middlewares/$middleware");
                        }
                    }
                }
            }
        }

        // Load additional middlewares from the Ship layer
        yield from $this->loadFromShip('Middlewares');
    }
}
