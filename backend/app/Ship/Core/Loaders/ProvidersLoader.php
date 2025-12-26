<?php

namespace App\Ship\Core\Loaders;

use Generator;

/**
 * Class responsible for loading service providers from application containers
 * and the Ship layer. This class scans predefined directories, identifies
 * valid PHP files, and returns their fully qualified class names.
 */
final class ProvidersLoader extends BaseLoader
{
    /**
     * Loads all service providers from containers and the Ship layer.
     *
     * - Scans the 'Providers' directory in each container to find provider classes.
     * - Includes additional providers from the 'Providers' directory in the Ship layer.
     * - Returns fully qualified class names of the providers as a generator.
     *
     * @return Generator<string> Fully qualified class names of providers.
     */
    public function loadProviders(): Generator
    {
        // Iterate through all containers to find their providers
        foreach ($this->getContainers() as $container) {
            $providersDir = "$container/Providers";

            // Check if the directory exists
            if ($this->isDir($providersDir)) {
                // Retrieve all files from the directory
                $providersDir = scandir($providersDir);

                // Ensure the directory scan succeeded
                if ($providersDir !== false) {
                    foreach ($providersDir as $provider) {
                        // Include only PHP files that are not symbolic links
                        if ($this->isPhpFile($provider) && $this->isNotLink($provider)) {
                            // Return the fully qualified class name of the provider
                            yield $this->getClassName("$container/Providers/$provider");
                        }
                    }
                }
            }
        }

        // Load additional providers from the Ship layer
        yield from $this->loadFromShip('Providers');
    }
}
