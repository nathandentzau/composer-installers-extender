# Composer Installers Extender

The `composer-installers-extender` is a plugin for [Composer][] that allows
any package to be installed to a directory other than the default `vendor`
directory within a project on a package-by-package basis. This plugin extends
the [`composer/installers`][] plugin to allow any arbitrary package type to be
handled by their custom installer.

The [`composer/installers`][] plugin has a finite set of supported package types
and we recognize the need for any arbitrary package type to be installed to a
specific directory other than `vendor`. This plugin allows additional package
types to be handled by the [`composer/installers`][] plugin, benefiting from
their explicit install path mapping and token replacement of package properties.

## Requirements

* PHP 7.4 or higher

## How to Install

Add `nathandentzau/composer-installers-extender` as a dependency of your project:

```bash
$ composer require nathandentzau/composer-installers-extender
```

## How to Use

The [`composer/installers`][] plugin is a dependency of this plugin and will be
automatically required as well if not already required.

To support additional package types, add an array of these types in the
`extra` property in your `composer.json`:

```json
{
    "extra": {
        "installer-types": ["library"]
    }
}
```

Then, you can add mappings for packages of these types in the same way that you
would add package types that are supported by [`composer/installers`][]:

```json
{
    "extra": {
        "installer-types": ["library"],
        "installer-paths": {
            "special/package/": ["my/package"],
            "path/to/libraries/{$name}/": ["type:library"]
        }
    }
}
```

By default, packages that do not specify a `type` will be considered the type
`library`. Adding support for this type allows any of these packages to be
placed in a different install path.

If a type has been added to `installer-types`, the plugin will attempt to find
an explicit installer path in the mapping. If there is no match either by name
or by type, the default installer path for all packages will be used instead.

Please see the README for [`composer/installers`][] to see the supported syntax
for package and type matching as well as the supported replacement tokens in
the path (e.g. `{$name}`).

## Why is This Project Forked?

Years ago I contributed to the `oomphinc/composer-installers-extender` project
to modernize the code base and add tests. Since my changes were merged into the
default branch on that project there has been no new tagged released by the
maintainer containg my changes after several years and responses to pull
requests have been slow. I've decided to maintain my own version of this package
containing all the changes I made years ago to update the code base to the
changes in PHP 7. With Composer 2 and PHP 8 on the horizon, my hope is that I
can quickly ship changes to support both new major versions. The original author
of this package, who is no longer an employee of Oomph, is still listed as an
author with updated contact information should you wish to reach out to him.

## License

[MIT License][]

[Composer]: https://getcomposer.org
[`composer/installers`]: https://github.com/composer/installers
[MIT License]: LICENSE
