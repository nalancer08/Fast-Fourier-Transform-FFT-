<?php 

	# Define the absolute path
	define( 'ABSPATH', dirname(__FILE__) );

	# Include required files
	include ABSPATH . '/include/complex.inc.php';
	include ABSPATH . '/include/fft.inc.php';

	/********************************************************************
	* 							Testing FFT Class                       *
	********************************************************************/
	$N = 4;
	$x = array();

	for ( $i = 0; $i < $N ; $i++ ) { 
		
		//$x[] = new Complex(-2*rand() + 1, $i + 1);
		$x[] = new Complex($i*2, $i + 1);
	}

	echo "Testing show array of Complex numbers";
	echo "<br>";
	FFT::show($x, "x");

	echo "Testing Fast Fourier Tranform = fft()";
	echo "<br>";
	$y = FFT::ffta($x);
	FFT::show($y, "fft(x)");

	echo "Testing Inverse Fast Fourier Transform = ifft()";
	echo "<br>";
	$z = FFT::ifft($y);
	FFT::show($z, "fft(y)");

	echo "Testing Circular Convolution";
	echo "<br>";
	$c = FFT::cconvolve($x, $x);
	FFT::show($c, "c = cconvolve(x, x)");

	echo "Testing Convolution";
	echo "<br>";
	$d = FFT::convolve($x, $x);
	FFT::show($d, "d = convolve(x, x)");


	/********************************************************************
	* 						Testing Complex Class                       *
	********************************************************************/
	$complex = new complex(5, 6);
	$complex2 = new complex(-3, 4);

	echo "hola mundo";

	echo "<br><br>";
	echo "Complex 1 to string = {$complex->toString()}";
	echo "<br>";
	echo "Complex 2 to string = {$complex2->toString()}";
	
	echo "<br><br>";
	echo "Complex ABS |a| = {$complex->abs()}";
	echo "<br>";
	echo "Complex ABS |b| = {$complex2->abs()}";
	
	echo "<br><br>";
	echo "Complex a Phase = {$complex->phase()}";
	echo "<br>";
	echo "Complex b Phase = {$complex2->phase()}";

	echo "<br><br>";
	echo "Complex a + b = {$complex->plus($complex2)->toString()}";
	echo "<br>";
	echo "Complex b + a = {$complex2->plus($complex)->toString()}";

	echo "<br><br>";
	echo "Complex a - b = {$complex->minus($complex2)->toString()}";
	echo "<br>";
	echo "Complex b - a = {$complex2->minus($complex)->toString()}";

	echo "<br><br>";
	echo "Complex a * b = {$complex->times($complex2)->toString()}";
	echo "<br>";
	echo "Complex b * a = {$complex2->times($complex)->toString()}";

	echo "<br><br>";
	echo "Complex a * alpha(2) = {$complex->times(2)->toString()}";
	echo "<br>";
	echo "Complex b * alpha(2) = {$complex2->times(2)->toString()}";

	echo "<br><br>";
	echo "Complex conjugate(a) = {$complex->conjugate()->toString()}";
	echo "<br>";
	echo "Complex conjugate(b) = {$complex2->conjugate()->toString()}";

	echo "<br><br>";
	echo "Complex reciprocal(a) = {$complex->reciprocal()->toString()}";
	echo "<br>";
	echo "Complex reciprocal(b) = {$complex2->reciprocal()->toString()}";

	echo "<br><br>";
	echo "Complex a divides b = {$complex->divides($complex2)->toString()}";
	echo "<br>";
	echo "Complex b divides a = {$complex2->divides($complex)->toString()}";

	echo "<br><br>";
	echo "Complex a exp() = {$complex->exp()->toString()}";
	echo "<br>";
	echo "Complex b exp() = {$complex2->exp()->toString()}";

	echo "<br><br>";
	echo "Complex a sin() = {$complex->sin()->toString()}";
	echo "<br>";
	echo "Complex b sin() = {$complex2->sin()->toString()}";

	echo "<br><br>";
	echo "Complex a cos() = {$complex->cos()->toString()}";
	echo "<br>";
	echo "Complex b cos() = {$complex2->cos()->toString()}";

	echo "<br><br>";
	echo "Complex a tan() = {$complex->tan()->toString()}";
	echo "<br>";
	echo "Complex b tan() = {$complex2->tan()->toString()}";

	echo "<br><br>";
	$static = Complex::staticPlus($complex, $complex2);
	echo "Static Plus a + b = {$static->toString()}";


 ?>