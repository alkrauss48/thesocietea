site-start
==========

A starter site kit that includes normalize.css, Susy 2 Grid, SASS compilation, Compass, Coffeescript compilation,
automatic CSS and JS minification, and a few custom mixins and javascript snippets.

## Installation
```bash
git clone https://github.com/Staplegun-US/site-start.git
cd site-start
bundle # To get your gems installed
npm install # To install your node packages
```

We use bundler here to install Susy and Compass gems and manage dependencies.
Bundler ensures that your gem versions are the ones that are explicitly defined in the
`Gemfile`. These gems are only
installed in the local project directory, and won't affect any global gems you use. If you need to use
the CLI tools these gems provide, run `bin/sass` or `bin/compass`, or prefix your
command with `bundle exec`

## Usage

The `index.html` comes preset with your doctypes, google analytics settings,
css/js inclusions, and a basic semantic body to get you started. To make full
use of the site-start though, you'll want to use grunt.

## Grunt

To run grunt:
```bash
grunt
```

Here's the assets directory structure:
```
assets
+-- css
|   +--screen.css
+-- coffee
|   +--_script.coffee
+-- js
|   +--ie
|   |   +-- ...
|   +--_script.js
|   +--_coffee.js
|   +--script.min.js
|   +--ie.min.js
+-- sass
|   +--concat.scss
|   +--_screen.scss
```

Running grunt will do the following for you
#### CSS
* Concatinate sass files prefixed with an underscore in the `assets/sass/`
  directory, into `assets/sass/concat.scss`
* Compile `assets/sass/concat.scss` into `assets/css/screen.css`, as well as
  minimize that file

Grunt runs the Sass task with `bundle exec` and automatically includes the
susy grid toolkit, so as long as you have
installed your gems with bundler, grunt will be using the right versions of susy
and compass.

#### JS
* Concatinate coffeescript files prefixed with an underscore in the
  `assets/coffee/` directory, into `assets/js/\_coffee.js`
* Compile javascript files prefixed with an underscore in the `assets/js`
  directory, into `assets/js/scripts.min.js`, and minify that file
* Compile all javascript files in `assets/js/ie/` into `assets/js/ie.min.js`, and
  minify that file

And after all this occurs, grunt will continue to watch the necessary files for
updates automatically, and run the necessary grunt tasks when any files are
changed.

If you add in any sass/coffee/js files that you don't want automatically
compiled, then just don't prefix those files with an underscore.

All of the final result files that Grunt compiles for you are already
included in the `index.html`, so hack away without worry!

========
## [Staplegun](http://staplegun.us)
