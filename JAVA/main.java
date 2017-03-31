package fft;

/**
 * Created by Erick Perez
 * CEO & CTO APP Builder on 21/03/2017.
 * */

public class main {
	
	public static void main(String[] args) {
		
		System.out.println("hola mundo");
		
		int N = 4; //Integer.parseInt("5");
        Complex[] x = new Complex[N];

        // original data
        for (int i = 0; i < N; i++) {
            //x[i] = new Complex(i, 0);
            x[i] = new Complex(-2*Math.random() + 1, i+1);
        }
        FFT.show(x, "x");
        
        Complex[] y = FFT.fft(x);
        FFT.show(y, "y = fft(x)");
        
        // take inverse FFT
        Complex[] z = FFT.ifft(y);
        FFT.show(z, "z = ifft(y)");
        
        // circular convolution of x with itself
        Complex[] c = FFT.cconvolve(x, x);
        FFT.show(c, "c = cconvolve(x, x)");

        // linear convolution of x with itself
        Complex[] d = FFT.convolve(x, x);
        FFT.show(d, "d = convolve(x, x)");
        
        
        Complex a = new Complex(5.0, 6.0);
        Complex b = new Complex(-3.0, 4.0);

        System.out.println("a            = " + a);
        System.out.println("b            = " + b);
        System.out.println("Re(a)        = " + a.re());
        System.out.println("Im(a)        = " + a.im());
        System.out.println("b + a        = " + b.plus(a));
        System.out.println("a - b        = " + a.minus(b));
        System.out.println("a * b        = " + a.times(b));
        System.out.println("b * a        = " + b.times(a));
        System.out.println("a / b        = " + a.divides(b));
        System.out.println("(a / b) * b  = " + a.divides(b).times(b));
        System.out.println("conj(a)      = " + a.conjugate());
        System.out.println("|a|          = " + a.abs());
        System.out.println("tan(a)       = " + a.tan());
	}

}

