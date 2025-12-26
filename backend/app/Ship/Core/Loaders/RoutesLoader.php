<?php

namespace App\Ship\Core\Loaders;

use Generator;

/**
 * Class responsible for loading route files from different parts of the project.
 * This class extends the BaseLoader class and provides methods to load WEB and API route files
 * from the containers' UI directories.
 */
final class RoutesLoader extends BaseLoader
{
    public const string HOME = 'admin.home';

    /**
     * Loads web route files for the application.
     * It iterates through all containers and looks for route files inside the 'UI/WEB/Routes' directory.
     *
     * If the directory exists and contains route files, each file path is yielded as a string.
     *
     * @return Generator<string> A generator of strings containing the paths to the web route files.
     */
    public function loadWebRoutes(): Generator
    {
        // Iterate over all containers to find web route files
        foreach ($this->getContainers() as $container) {
            $routesDir = "$container/UI/WEB/Routes/"; // Define the path to the web routes directory.

            // Check if the 'Routes' directory exists in the container
            if ($this->isDir($routesDir)) {
                $routesDir = scandir("$container/UI/WEB/Routes"); // Scan the 'Routes' directory.

                // If the directory was successfully scanned, iterate over its contents
                if ($routesDir !== false) {
                    foreach ($routesDir as $route) {
                        // Skip the current ('.') and parent ('..') directory links
                        if ($this->isNotLink($route)) {
                            yield "$container/UI/WEB/Routes/$route"; // Yield the full path to the route file.
                        }
                    }
                }
            }
        }
    }

    /**
     * Loads API route files for the application.
     * It iterates through all containers and looks for route files inside the 'UI/API/Routes' directory.
     *
     * If the directory exists and contains route files, each file path is yielded as a string.
     *
     * @return Generator<string> A generator of strings containing the paths to the API route files.
     */
    public function loadApiRoutes(): Generator
    {
        // Iterate over all containers to find api route files
        foreach ($this->getContainers() as $container) {
            $routesDir = "$container/UI/API/Routes"; // Define the path to the api routes directory.

            // Check if the 'Routes' directory exists in the container
            if ($this->isDir($routesDir)) {
                $routesDir = scandir($routesDir); // Scan the 'Routes' directory.

                // If the directory was successfully scanned, iterate over its contents
                if ($routesDir !== false) {
                    foreach ($routesDir as $route) {
                        // Skip the current ('.') and parent ('..') directory links
                        if ($this->isNotLink($route)) {
                            yield "$container/UI/API/Routes/$route"; // Yield the full path to the route file.
                        }
                    }
                }
            }
        }
    }
}
