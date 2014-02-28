# pake-cli
> Locate and run a locally installed pake instance

Install this and `pake` will find and execute pake from the bin folder as managed by Composer.

This is based on the concept from [grunt-cli][gcli].

## Use

In a project, install pake with composer by creating a composer.json file and run `php composer.phar install`.

````json
{
    "require": {
        "indeyets/pake": "~1.99"
    }
}
````

This will provide the pake bin in `./vendor/bin/pake`. Install the pake-cli file into your path, and you'll be able to simply run `pake`.

[gcli]: https://github.com/gruntjs/grunt-cli