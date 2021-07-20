<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;

class MakeModelCommand extends ModelMakeCommand
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\\Models";
    }
}
