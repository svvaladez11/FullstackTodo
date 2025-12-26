<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory as ViewFactoryContract;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Factory as ViewFactory;

if (!function_exists('containerViewPath')) {
    function containerViewPath(string $view): string
    {
        $parts = explode('@', $view);
        $partsLength = count($parts);

        if ($partsLength === 1) {
            $parts = [...explode(":", $parts[0])];
            $container = Str::ucfirst($parts[0]);
            $view = $parts[1];
            $viewPath = app_path("Containers/$container/UI/WEB/Views/$view.blade.php");
        } else {
            $parts = [$parts[0], ...explode(":", $parts[1])];
            $section = Str::ucfirst($parts[0]);
            $container = Str::ucfirst($parts[1]);
            $view = $parts[2];
            $viewPath = app_path("Containers/$section/$container/UI/WEB/Views/$view.blade.php");
        }

        return $viewPath;
    }
}

if (!function_exists('containerView')) {
    /**
     *  Get the evaluated view contents for the given view.
     *
     * @phpstan-param string|null $view
     * @phpstan-param array<string, mixed>|Arrayable<int, mixed> $data
     * @phpstan-param array<string, mixed> $mergeData
     * @phpstan-return ($view is null ? ViewFactoryContract : View)
     */
    function containerView(
        ?string $view = null,
        array|Arrayable $data = [],
        array $mergeData = [],
    ): ViewFactoryContract|View {
        /** @phpstan-var ViewFactory $factory */
        $factory = app(ViewFactoryContract::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        $view = (string)$view;
        $view = containerViewPath($view);

        return $factory->file($view, $data, $mergeData);
    }
}
