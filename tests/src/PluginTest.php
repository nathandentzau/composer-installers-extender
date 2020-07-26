<?php

declare(strict_types = 1);

namespace NathanDentzau\ComposerInstallersExtender\Tests;

use Composer\Composer;
use Composer\IO\IOInterface;
use PHPUnit\Framework\TestCase;
use Composer\Installer\InstallationManager;
use NathanDentzau\ComposerInstallersExtender\Installers\Installer;
use NathanDentzau\ComposerInstallersExtender\Plugin;

class PluginTest extends TestCase
{
    protected Composer $composer;

    protected IOInterface $io;

    public function setUp(): void
    {
        parent::setUp();

        $this->composer = $this->createMock(Composer::class);
        $this->composer
            ->method('getConfig')
            ->willReturn(new class {
                public function get($name)
                {
                    return null;
                }
            });
        $this->composer
            ->method('getPackage')
            ->willReturn(new class {
                public function getExtra(): array {
                    return [];
                }
            });

        $this->io = $this->createMock(IOInterface::class);
    }

    public function testActive(): void
    {
        $installationManager = $this->createMock(InstallationManager::class);
        $installationManager
            ->expects($this->once())
            ->method('addInstaller')
            ->with(new Installer($this->io, $this->composer));

        $this->composer
            ->expects($this->once())
            ->method('getInstallationManager')
            ->willReturn($installationManager);

        // There is no output to test from the activate method. Only test for
        // method call expectations.
        $plugin = new Plugin();
        $plugin->activate($this->composer, $this->io);
    }
}
