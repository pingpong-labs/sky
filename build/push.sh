#!/bin/sh

git push origin master
git subtree push --prefix=src/Pingpong/Widget git@github.com:pingpong-labs/widget.git master
git subtree push --prefix=src/Pingpong/Shortcode git@github.com:pingpong-labs/shortcode.git master
git subtree push --prefix=src/Pingpong/Menus git@github.com:pingpong-labs/menus.git master
git subtree push --prefix=src/Pingpong/Presenters git@github.com:pingpong-labs/presenters.git master
git subtree push --prefix=src/Pingpong/Modules git@github.com:pingpong-labs/modules.git master