<?php

if (!defined('IN_APP')) {
    header("HTTP/1.0 404 Not Found");
    header("Location: /404.php"); 
    exit();
}

require_once "vendor/autoload.php";

use chillerlan\QRCode\{QRCode, QROptions}; // start using QRCode
use \chillerlan\QRCode\Common\EccLevel;

// file name/path of the database
$DatabaseName = "Data.db";
$BackupDatabaseName = "Data.db.backup";

// defining QRCode settings
$QROptions = new QROptions;
$QROptions->outputBase64 = false;
$QROptions->scale = 100;
$QROptions->imageTransparent = true;
$QROptions->drawLightModules = false;
$QROptions->svgUseFillAttributes = true;

// connect paths to avoid render glitches
// @see https://github.com/chillerlan/php-qrcode/issues/57
$QROptions->connectPaths = true;

// add a gradient via the <defs> element
// @see https://developer.mozilla.org/en-US/docs/Web/SVG/Element/defs
// @see https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
$QROptions->svgDefs = '
	<linearGradient id="rainbow" x1="1" y2="1">
		<stop stop-color="#e2453c" offset="0"/>
		<stop stop-color="#e07e39" offset="0.2"/>
		<stop stop-color="#e5d667" offset="0.4"/>
		<stop stop-color="#51b95b" offset="0.6"/>
		<stop stop-color="#1e72b7" offset="0.8"/>
		<stop stop-color="#6f5ba7" offset="1"/>
	</linearGradient>
	<style><![CDATA[
		.dark{fill: url(#rainbow);}
		.light{fill: #eee;}
	]]></style>';


