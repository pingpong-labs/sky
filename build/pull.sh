#!/bin/sh

BRANCH=$1

git pull origin $BRANCH
git subtree pull --prefix=src/Pingpong/Widget git@github.com:pingpong-labs/widget.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Shortcode git@github.com:pingpong-labs/shortcode.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Menus git@github.com:pingpong-labs/menus.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Presenters git@github.com:pingpong-labs/presenters.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Modules git@github.com:pingpong-labs/modules.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Generators git@github.com:pingpong-labs/generators.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Trusty git@github.com:pingpong-labs/trusty.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Themes git@github.com:pingpong-labs/themes.git $BRANCH --squash
git subtree pull --prefix=src/Pingpong/Support git@github.com:pingpong-labs/support.git $BRANCH --squash
