<?php

namespace Elgentos\Cypress\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class InstallPlugin implements PluginInterface
{

    public function activate(Composer $composer, IOInterface $io)
    {
        var_dump('HeyyyyACTIVATE');
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // TODO: Implement deactivate() method.
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // TODO: Implement uninstall() method.
    }
}