<?php

declare(strict_types = 1);

namespace NathanDentzau\ComposerInstallersExtender\Tests\Installers;

use PHPUnit\Framework\TestCase;
use NathanDentzau\ComposerInstallersExtender\Installers\CustomInstaller;

class CustomInstallerTest extends TestCase
{
    public function testLocations(): void
    {
        $installer = (new \ReflectionClass(CustomInstaller::class))
            ->newInstanceWithoutConstructor();
        $this->assertEmpty($installer->getLocations());
    }
}
