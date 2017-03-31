 <?php 

	/**
	 * Created by Erick Perez
	 * CEO & CTO APP Builder on 21/03/2017.
	 * */

/******************************************************************************
 *  Compilation:  Complex.java
 *  Execution:    Complex 1,1
 *
 *  Create a Complex number, with almost all their calculates
 *  is to optimize the clarity of the code, rather than performance.
 *  For this reason if it going to be used to hard sound analyzing
 *  you have to find a way to optimize this code
 *
 *  Limitations
 *  -----------
 *   -  The data type is "immutable" so once you create and initialize
 *  	a Complex object, you cannot change it. The "final" keyword
 *  	when declaring re and im enforces this rule, making it a
 *  	compile-time error to change the .re or .im fields after
 *  	they've been initialized.
 *
 *   -  Not the most memory efficient algorithm (because it uses
 *      an object type for representing complex numbers and because
 *      it re-allocates memory for the sub-array, instead of doing
 *      in-place or reusing a single temporary array)
 *
 ******************************************************************************/

 	class Complex {

 		private $re;
 		private $im;
 		private $running;

 		/**
	     * Constructor
	     * @param real: double for real number
	     * @param imag: double for imaginary number
	     * */
 		function __construct($real, $imag) {

 			$this->re = $real;
 			$this->im = $imag;
 			$this->running = false;
 		}

 		/**
	     * Method to change the value of real part, only if the complex number it's not involve in other process
	     * @param real: double for real number
	     * */
	    public function setReal($real) {
	    	
	    	if ( $this->running == false ) {
	    		$this->re = $real;
	    		return true;
	    	}
	    	return false;
	    }
    
	    /**
	     * Method to change the value of imaginary part, only if the complex number it's not involve in other process
	     * @param imag: double for imaginary number
	     * */
	    public function setImaginary($imag) {
	    	
	    	if ( $this->running == false ) {
	    		$this->im = $imag;
	    		return true;
	    	}
	    	return false;
	    }

	    /**
	     * This method return a String representation of a complex number
	     * */
	    public function toString() {
	    	
	        if ($this->im == 0) return "{$this->re} ";
	        if ($this->re == 0) return "{$this->im} i";
	        if ($this->im <  0) return "{$this->re} - " . -$this->im . " i";
	        return "{$this->re} + {$this->im} i";
	    }

	    public function abs() {
	    	return hypot($this->re, $this->im); // sqrt(x^2 + y^2) 
	    	//return sqrt( $this->re * $this->re + $this->im * $this->im );
	    }

	    public function phase() {
	    	return atan2($this->im, $this->re); // between -pi and pi
	    }

	    public function plus($b) {

	    	$a = $this;
	    	$real = $a->re + $b->re;
	    	$imag = $a->im + $b->im;
	    	return new Complex($real, $imag); 
	    }

	    public function minus($b) {

	    	$a = $this;
	    	$real = $a->re - $b->re;
	    	$imag = $a->im - $b->im;
	    	return new Complex($real, $imag);
	    }

	    public function times($b) {

	    	if ( $b instanceof Complex ) { // Complex numer

	    		$a = $this;
		    	$real = $a->re * $b->re - $a->im * $b->im;
		    	$imag = $a->re * $b->im + $a->im * $b->re;
		    	return new Complex($real, $imag);
	    	
	    	} else { // Scalar multiplication, return a new object whose value is (this * alpha); $b = alpha
	    		return new Complex($b * $this->re, $b * $this->im);
	    	}
	    }

	    /**
	     * This method calculate the conjugate of a complex number
	     * Remember how it's the conjugate of a number:
	     * x + yj is the conjugate of x − yj and
		 * x − yj is the conjugate of x + yj
	     * */
	    // Return a new Complex object whose value is the conjugate of this
	    public function conjugate() { 
	    	return new Complex($this->re, -$this->im); 
	    }

	    public function reciprocal() {

	    	$scale = $this->re * $this->re + $this->im * $this->im;
	    	return new Complex( $this->re / $scale, -$this->im / $scale );
	    }

	    public function re() {
	    	return $this->re;
	    }

	    public function im() {
	    	return $this->im;
	    }

	    public function divides($b) {

	    	$a = $this;
	    	return $a->times($b->reciprocal());
	    }

	    public function exp() {
	    	return new Complex( exp($this->re) * cos($this->im), exp($this->re) * sin($this->im) );
	    }

	    public function sin() {
	    	return new Complex( sin($this->re) * cosh($this->im), cos($this->re) * sinh($this->im) );
	    }

	    public function cos() {
	    	return new Complex( cos($this->re) * cosh($this->im), -sin($this->re) * sinh($this->im) );
	    }

	    public function tan() {
	    	return $this->sin()->divides($this->cos());
	    }

	    public static function staticPlus($a, $b) {

	    	$real = $a->re + $b->re;
	    	$imag = $b->im + $b->im;
	    	return new Complex($real, $imag);
	    }

 	}

  ?>