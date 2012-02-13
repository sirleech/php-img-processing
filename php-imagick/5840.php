<?php
// imageMagick (php5 imagick) test
// text justification constants
define("LEFT", 1);
define("CENTER", 2);
define("RIGHT", 3);

$text = "Estimated landscape water
flows and stores 2009-10";

/* Read the images */
$im = new Imagick("5840.png");
$drops = new Imagick("precip.svg");
$drops->setImageOpacity(.5);
$dropsPng = new Imagick("precip24.png");
$pal_bk = new Imagick("pal_bk.png");

// Composite
$im ->compositeImage($drops, Imagick::COMPOSITE_DEFAULT, 100, 200); 
$im ->compositeImage($pal_bk, Imagick::COMPOSITE_DEFAULT, 200, 400); 

//drop shadow
$shadow = $dropsPng->clone(); 
$shadow->setImageBackgroundColor( new ImagickPixel( 'black' ) ); 
$blur=10;
$shadow->shadowImage( 100, $blur, 0, 0 ); 
$shadow->compositeImage( $dropsPng, Imagick::COMPOSITE_OVER, -1, -1 ); 
$im ->compositeImage($shadow, Imagick::COMPOSITE_DEFAULT, 200, 300); 

/* Create a border for the image */
$im->borderImage(new ImagickPixel("gray"), 1, 1);

//draw object
$draw = new ImagickDraw();

//title
$draw->setFontSize(36);
$draw->settextkerning(-1);
$draw->setFont("../fonts/HelveticaNeueLight.ttf");
$draw->setTextAlignment(RIGHT);
$draw->setFillColor('#ffffff');
$draw->annotation(700, 50,$text );
//small text
$draw->setFontSize(15);
$draw->setTextAlignment(LEFT);
$draw->annotation(20, 70, "Hello World!");
//
$draw->setFont("../fonts/HelveticaNeueBold.ttf");
$draw->annotation(100,200, "SVG Opacity:0.5");
$draw->annotation(200,400, 'PNG-24 tranparency and drop shadow');
//circle
$draw->setFillColor('green');    // Set up some colors to use for fill and outline
$draw->setStrokeColor( new ImagickPixel( 'black' ) );
$draw->setStrokeWidth('5');
$draw->circle( 300, 200, 220, 220 );    // Draw the circle already 

//draw
$im->drawImage($draw);

/* Output the image*/
header("Content-Type: image/png");
echo $im;
?>

