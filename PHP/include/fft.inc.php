<?php 

	/**
	 * Created by Erick Perez
	 * CEO & CTO APP Builder on 21/03/2017.
	 * */

/******************************************************************************
 *  Compilation:  FFT.java
 *  Execution:    FFT N
 *  Dependencies: Complex.java
 *
 *  Compute the FFT and inverse FFT of a length N complex sequence.
 *  Bare bones implementation that runs in O(N log N) time. Our goal
 *  is to optimize the clarity of the code, rather than performance.
 *
 *  Limitations
 *  -----------
 *   -  Assumes N is a power of 2
 *
 *   -  Not the most memory efficient algorithm (because it uses
 *      an object type for representing complex numbers and because
 *      it re-allocates memory for the sub-array, instead of doing
 *      in-place or reusing a single temporary array)
 *
 ******************************************************************************/

	class FFT {

		/**
		 * This method calculate Fast Fourier Transform of x[]
		 * This method assuming the length is a power of 2
		 * */
	    public static function ffta($x /* array */ ) {
	    	
	        $N = count($x);

	        // Base case
	        if ( $N == 1 ) return array( $x[0] );

	        // Radix 2 Cooley-Tukey FFT
	        if ( $N % 2 != 0 ) { echo "<br>N is not a power of 2<br>"; }

	        // FFT of even terms
	        $even = array();//new Complex[N/2];
	        for ( $k = 0; $k < $N/2; $k++ ) {
	            $even[$k] = $x[2*$k];
	        }
	        $q = FFT::ffta($even);

	        // FFT of odd terms
	        $odd  = $even;  // reuse the array
	        for ( $k = 0; $k < $N/2; $k++ ) {
	            $odd[$k] = $x[2*$k + 1];
	        }
	        $r = FFT::ffta($odd);

	        // Combine
	        $y = array();
	        for ( $k = 0; $k < $N/2; $k++ ) {
	            
	            $kth = -2 * $k * pi() / $N;
	            $wk = new Complex(cos($kth), sin($kth));
	            $y[$k]       = $q[$k]->plus($wk->times($r[$k]));
	            $y[$k + $N/2] = $q[$k]->minus($wk->times($r[$k]));
	        }
	        return $y;
	    }

	     /**
	     * This method calculate Inverse Fast Fourier Transform of x[]
	     * This method assuming the length is a power of 2
	     * */
	    public static function ifft($x) {
	    	
	        $N = count($x);
	        $y = array();

	        // Take conjugate
	        for ( $i = 0; $i < $N; $i++ ) {
	            $y[$i] = $x[$i]->conjugate();
	        }

	        // Compute forward FFT
	        $y = FFT::ffta($y);

	        // Take conjugate again
	        for ( $i = 0; $i < $N; $i++ ) {
	            $y[$i] = $y[$i]->conjugate();
	        }

	        // Divide by N
	        for ( $i = 0; $i < $N; $i++ ) {
	            $y[$i] = $y[$i]->times(1.0 / $N);
	        }

	        return $y;
	    }

	     /**
	     * This method calculate the circular convolution of x and y
	     * Remember the convolution operation calculate the output 
	     * - for any linear time invariant system given its input and its impulse response.
	     * It's circular, 'cause it's considering that the support of the signal is periodic (as in a circle, hance the name).
	     * */
	    public static function cconvolve($x, $y) {

	        // Should probably pad x and y with 0s so that they have same length and are powers of 2
	        if ( count($x) != count($y) ) { echo "<br>Dimensions don't agree<br>"; }

	        $N = count($x);

	        // Compute FFT of each sequence
	        $a = FFT::ffta($x);
	        $b = FFT::ffta($y);

	        // Point-wise multiply
	        $c = array();
	        for ( $i = 0; $i < $N; $i++) {
	            $c[$i] = $a[$i]->times($b[$i]);
	        }

	        // Compute inverse FFT
	        return FFT::ifft($c);
	    }

	    /**
	     * This method calculate the linear convolution of x and y
	     * Remember the convolution operation calculate the output 
	     * - for any linear time invariant system given its input and its impulse response.
	     * */
	    public static function convolve($x, $y) {
	    	
	        $ZERO = new Complex(0, 0);

	        $a = array();
	        for ( $i = 0; $i < count($x); $i++ ) $a[$i] = $x[$i];
	        for ( $i = count($x); $i < 2*count($x); $i++ ) $a[$i] = $ZERO;

	        $b = array();
	        for ( $i = 0; $i < count($y); $i++ ) $b[$i] = $y[$i];
	        for ( $i = count($y); $i < 2*count($y); $i++ ) $b[$i] = $ZERO;

	        return FFT::cconvolve($a, $b);
	    }

	     /**
	     * This method display an array of COmplex numbers
	     * */
	    public static function show($x, $title) {

	    	echo $title . "<br>";
	    	echo "----------------------------- <br>";
	    	for ( $i = 0; $i < count($x) ; $i++ ) { 
	    		echo $x[$i]->toString() . "<br>";
	    	}
	    	echo "<br>";
	    }
	}

 ?>