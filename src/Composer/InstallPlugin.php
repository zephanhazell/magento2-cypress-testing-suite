<?php

namespace Elgentos\Cypress\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

final class InstallPlugin implements PluginInterface
{

    /** @noinspection RealpathInStreamContextInspection */
    public function activate(Composer $composer, IOInterface $io): void
    {
        $projectPath = realpath($composer->getConfig()->get('vendor-dir') . '/../');
        $packagePath = realpath(__DIR__ . '/../../');

        preg_match(
            sprintf(';^%s/(.+)$;', $projectPath),
            $packagePath,
            $matches
        );
        $relativePackagePath = $matches[1];

        self::ensureFile($packagePath . '/cypress.json', $projectPath . '/cypress.json', $io);
        self::ensureLink($relativePackagePath . '/cypress', $projectPath . '/cypress', $io);
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
        // no-op
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
        // no-op
    }

    private static function ensureFile(string $source, string $target, IOInterface $io) : void
    {
        if (file_exists($target)) {
            return;
        }
        $io->write(sprintf('Copying %s to %s', $source, $target));
        copy($source, $target);
    }

    private static function ensureLink(string $source, string $target, IOInterface $io) : void
    {
        if (file_exists($target)) {
            return;
        }
        $io->write(sprintf('Linking %s to %s', $target, $source));
        symlink($source, $target);
    }
}
