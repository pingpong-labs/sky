#!/bin/sh
#
BRANCH=$1

git push origin $BRANCH
git subtree push --prefix=src/Pingpong/Widget git@github.com:pingpong-labs/widget.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Shortcode git@github.com:pingpong-labs/shortcode.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Menus git@github.com:pingpong-labs/menus.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Presenters git@github.com:pingpong-labs/presenters.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Modules git@github.com:pingpong-labs/modules.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Testing git@github.com:pingpong-labs/testing.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Generators git@github.com:pingpong-labs/generators.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Trusty git@github.com:pingpong-labs/trusty.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Themes git@github.com:pingpong-labs/themes.git $BRANCH --squash
git subtree push --prefix=src/Pingpong/Support git@github.com:pingpong-labs/support.git $BRANCH --squash
