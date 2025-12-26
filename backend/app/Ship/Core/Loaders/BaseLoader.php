<?php

namespace App\Ship\Core\Loaders;

use Generator;

/**
 * Abstract base class for loaders.
 * Provides methods for working with containers and elements of the Ship architecture in the project.
 *
 * Main tasks:
 * - Scanning and loading containers (Containers).
 * - Loading files and classes from Ship.
 * - Checking and processing paths (whether it is a section, PHP file, directory).
 */
abstract class BaseLoader
{
    /**
     * Retrieves the list of all containers in the project.
     * Containers are found in the 'app/Containers' folder, including their sections.
     *
     * @return Generator<string> A generator of strings containing the paths to the containers.
     */
    protected function getContainers(): Generator
    {
        $containersPath = base_path('app/Containers'); // Base path to the container's folder.

        $paths = scandir($containersPath); // Scan the contents of the container's folder.
        if ($paths) {
            foreach ($paths as $path) {
                if ($this->isSection($path)) { // If it's a container section.
                    $sectionPaths = scandir("$containersPath/$path"); // Scan the section's folder.
                    if ($sectionPaths) {
                        foreach ($sectionPaths as $sectionPath) {
                            if ($this->isNotLink($sectionPath)) { // Ignore links to the current and parent directories.
                                yield "$containersPath/$path/$sectionPath"; // Yield the full path to the section.
                            }
                        }
                    }
                } elseif ($this->isNotLink($path)) { // If it's not a section but a valid path.
                    yield "$containersPath/$path"; // Yield the path.
                }
            }
        }
    }

    /**
     * Loads classes from a specific directory in 'app/Ship'.
     *
     * @param string $path The path within the Ship folder.
     * @return Generator<string> A generator of class names as strings.
     */
    protected function loadFromShip(string $path): Generator
    {
        $shipPath = base_path('app/Ship/' . $path); // Base path to the Ship folder.

        $paths = scandir($shipPath); // Scan the contents of the given directory.
        if ($paths) {
            foreach ($paths as $path) {
                if ($this->isNotLink($path) && $this->isPhpFile($path)) { // Check if it's a PHP file and not a link.
                    yield $this->getClassName("$shipPath/$path"); // Yield the full class name.
                }
            }
        }
    }

    /**
     * Checks if the path is a container section.
     *
     * @param string $path The path to check.
     * @return bool True if the path is a section (ends with 'Section').
     */
    protected function isSection(string $path): bool
    {
        return str_ends_with($path, 'Section');
    }

    /**
     * Checks that the path is not a link to the current or parent directory.
     *
     * @param string $path The path to check.
     * @return bool True if the path is not '.' or '..'.
     */
    protected function isNotLink(string $path): bool
    {
        return $path !== "." && $path !== "..";
    }

    /**
     * Checks if the given path is a directory.
     *
     * @param string $path The path to check.
     * @return bool True if it is a directory.
     */
    protected function isDir(string $path): bool
    {
        return is_dir($path);
    }

    /**
     * Checks if the file is a PHP file.
     *
     * @param string $path The file path.
     * @return bool True if the file has a 'php' extension.
     */
    protected function isPhpFile(string $path): bool
    {
        return pathinfo($path, PATHINFO_EXTENSION) === 'php';
    }

    /**
     * Converts the file path to the full class name.
     *
     * @param string $filePath The full file path.
     * @return string The full class name.
     */
    protected function getClassName(string $filePath): string
    {
        // Convert absolute path to relative.
        $relativePath = str_replace(base_path('app'), 'App', $filePath);
        // Replace path separators and remove extension.
        return str_replace(['/', '.php'], ['\\', ''], $relativePath);
    }
}
