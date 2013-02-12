# HighlanderLighter [![Build Status](https://travis-ci.org/vis7mac/highlanderlighter.png)](https://travis-ci.org/vis7mac/highlanderlighter)

> A PHP command line text highlighter made for CLIs.

## What it does

HighlanderLighter is a simple class to highlight script output in the command line, for example for CLI scripts.

It currently supports foreground colors, background colors, bold and underlined text, dimming and effects like the system bell, blinking, reverse coloring - but can always be extended by changing the data array in the class.

## Usage

	$highlanderLighter = new HighlanderLighter();
	
	$highlanderlighter->put("This is #f{red;underline}red, underlined #e{reverse}and reversed#{normal} text.");
	
	$renderedText = $highlanderlighter->render("This is #f{red;underline}red, underlined #e{reverse}and reversed#{normal} text.");

All in `#{}` is a command for HighlanderLighter. You can change that to another character when calling the initializer like so:

	$highlanderLighter = new HighlanderLighter("!");

Then, you can use it like that:

	$highlanderlighter->put("This is !f{red;underline}red, underlined !e{reverse}and reversed!{normal} text.");

After the command char comes the category, for example `f` for foreground colors, `b` for background colors, `e` for effects and nothing for anything in the `default` category.

In the brackets are, semicolon-separated, all options you want to apply.