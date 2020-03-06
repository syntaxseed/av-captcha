# AVCaptcha

- This is a simple drop-in anti-spam CAPTCHA script written in PHP.
- It is loosely based on the CodeWalkers.com Simple PHP CAPTCHA (no longer online).
- Provided without any warranty or implication of fitness for any purpose.
- CAPTCHA difficulty (strength) is low to moderate, however custom captchas are usually not already broken by spammers.
- You may use and modify this script for any purpose as long as this README.md file and the following line is kept with the script:

Author: Sherri Wheeler (syntaxseed.com). Copyright (c) 2020.

## Usage

Refer to the example.php file for a complete usage example.

Configuration settings are found at the top of the avcaptcha.php file.

## Fonts

True Type Fonts can be found in various places online. Google's *Viga* font has been included as an example. Recommended to use an unusual font to increase captcha strength. Sans-serif fonts are more difficult.

- Find the .ttf file you desire and place it in the resources/fonts/ directory in this avcaptcha directory.
- Edit the settings in avcaptcha.php to set the correct font file.
