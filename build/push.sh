#!/bin/sh

git push origin master
git subtree push --prefix=src/Pingpong/Widget git@github.com:pingpong-labs/widget.git master
git subtree push --prefix=src/Pingpong/Shortcode git@github.com:pingpong-labs/shortcode.git master
git subtree push --prefix=src/Pingpong/Menus git@github.com:pingpong-labs/menus.git master
git subtree push --prefix=src/Pingpong/Presenters git@github.com:pingpong-labs/presenters.git master
git subtree push --prefix=src/Pingpong/Modules git@github.com:pingpong-labs/modules.git master
git subtree push --prefix=src/Pingpong/Testing git@github.com:pingpong-labs/testing.git master
git subtree push --prefix=src/Pingpong/Generators git@github.com:pingpong-labs/generators.git master
git subtree push --prefix=src/Pingpong/Validator git@github.com:pingpong-labs/validator.git master
git subtree push --prefix=src/Pingpong/Oembed git@github.com:pingpong-labs/oembed.git master
git subtree push --prefix=src/Pingpong/Trusty git@github.com:pingpong-labs/trusty.git master