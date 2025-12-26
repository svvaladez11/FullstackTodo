<?php

namespace App\Ship\Core\Loaders;

use Generator;

/**
 * Class responsible for loading service providers from application containers
 * and the Ship layer. This class scans predefined directories, identifies
 * valid PHP files, and returns their fully qualified class names.
 */
final class MigrationsLoader extends BaseLoader
{
    /**
     * Loads all service providers from containers and the Ship layer.
     *
     * - Scans the 'Migrations' directory in each container to find provider classes.
     * - Includes additional providers from the 'Migrations' directory in the Ship layer.
     * - Returns fully qualified class names of the providers as a generator.
     *
     * @return Generator<string> Fully qualified class names of providers.
     */
    public function loadMigrations(): Generator
    {
        foreach ($this->getContainers() as $container) {
            $migrationsDir = "$container/Data/Migrations";

            if ($this->isDir($migrationsDir)) {
                $files = scandir($migrationsDir);
                if ($files && collect($files)->filter(fn($f) => $this->isPhpFile($f))->isNotEmpty()) {
                    yield $migrationsDir;
                }
            }
        }

        yield from $this->getShipMigrationDirs();
    }

    protected function getShipMigrationDirs(): Generator
    {
        $dir = base_path('app/Ship/Migrations');
        if ($this->isDir($dir)) {
            yield $dir;
        }
    }
}
