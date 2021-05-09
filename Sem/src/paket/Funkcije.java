package paket;

import javax.swing.text.AttributeSet;
import javax.swing.text.BadLocationException;
import javax.swing.text.PlainDocument;

//Ogranièenje na jedno slovo

public class Funkcije extends PlainDocument {
	private static final long serialVersionUID = 1L;
	private int limit;

	protected Funkcije(int limit) {
		super();
		this.limit = limit;
   }

	protected static String vrijeme(long poc, long kraj){
		return "Time elapsed: " + (poc - kraj) / 1000.0 + " seconds";
	}
	
	public void insertString(int offset, String str, AttributeSet attr)
			throws BadLocationException {
	  if (str == null) return;

	  if ((getLength() + str.length()) <= limit) 
		  	super.insertString(offset, str, attr);
  }	
}
