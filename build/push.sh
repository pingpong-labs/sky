#!/bin/sh

git push origin 1.0
git subtree push --prefix=src/Pingpong/Widget git@github.com:pingpong-labs/widget.git 1.0
git subtree push --prefix=src/Pingpong/Shortcode git@github.com:pingpong-labs/shortcode.git 1.0
git subtree push --prefix=src/Pingpong/Menus git@github.com:pingpong-labs/menus.git 1.0
git subtree push --prefix=src/Pingpong/Presenters git@github.com:pingpong-labs/presenters.git 1.0
git subtree push --prefix=src/Pingpong/Modules git@github.com:pingpong-labs/modules.git 1.0
git subtree push --prefix=src/Pingpong/Testing git@github.com:pingpong-labs/testing.git 1.0
git subtree push --prefix=src/Pingpong/Generators git@github.com:pingpong-labs/generators.git 1.0
git subtree push --prefix=src/Pingpong/Validator git@github.com:pingpong-labs/validator.git 1.0
git subtree push --prefix=src/Pingpong/Oembed git@github.com:pingpong-labs/oembed.git 1.0
git subtree push --prefix=src/Pingpong/Trusty git@github.com:pingpong-labs/trusty.git 1.0
git subtree push --prefix=src/Pingpong/Themes git@github.com:pingpong-labs/themes.git 1.0