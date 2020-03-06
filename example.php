<?php
session_start();           // Make sure PHP sessions are enabled.
define("AVCAPTCHA_WEB_ROOT", "/"); // Web path root to avcaptcha files.
?>

<html>

<head>
<title>AVCaptcha</title>
</head>

<body>

<h3>AVCaptcha Example</h3>

<?php
// Check if Captcha is correct.
if (isset($_POST['submit'])) {
    $key = $_SESSION['captchakey'];
    $guess = $_POST['avcaptchaguess'];

    if ($guess!=$key) {
        echo('Captcha test failed.');
    } else {
        echo('Captcha passed.');
    }
}
?>

<form method="post" action="<?php echo($_SERVER['PHP_SELF']);?>">
    <img src="<?php echo(AVCAPTCHA_WEB_ROOT);?>avcaptcha.php" id="avcaptchaimage" style="vertical-align:middle;border:1px solid #000000;" alt="Anti-Spam Test" />&nbsp;
    <a onclick="document.getElementById('avcaptchaimage').src='<?php echo(AVCAPTCHA_WEB_ROOT);?>avcaptcha.php?ran=' + Math.random();" href="javascript:void(0);"><img src="<?php echo(AVCAPTCHA_WEB_ROOT);?>resources/reload.png" style="vertical-align:middle;" alt="Reload Captcha" title="Reload Captcha" border="0" /></a><br />
    <input name="avcaptchaguess" id="avcaptchaguess" type="text" size="15" /><br />
    <input name="submit" type="submit" value="Submit" />
</form>

</body>
</html>
