package paket;

import java.awt.*;
import java.awt.event.*;
import java.sql.*;
import java.util.*;
import javax.swing.*;
import javax.swing.border.*;

@SuppressWarnings({ "serial" })
public class Dizajn extends JFrame {    
	private JPanel contentPane;
	protected long start, end;

	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					Dizajn frame = new Dizajn("Igra");
					frame.setVisible(true);
				}
				
				catch (Exception e) {e.printStackTrace();}
			}
		});
	}

	
	protected Dizajn(String rijec) {
		//Postavljanje naslova i slièice
		setTitle("Hangman 2017. ©");
		setIconImage(Toolkit.getDefaultToolkit().getImage("src/Favicon.png"));
		
		
	    
	    //Okvir
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(512, 288, 250, 425);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		contentPane.setLayout(new BorderLayout(6, 6));
		
		setContentPane(contentPane);
		getContentPane().setBackground(Color.WHITE);
	    getContentPane().setLayout(new BorderLayout());
	    setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

		JSplitPane splitPaneTekst = new JSplitPane();
		contentPane.add(splitPaneTekst, BorderLayout.WEST);
		
		
		
        //Gumbi za pokušaj i poèetak nove igre		
		JSplitPane splitPaneGumbi = new JSplitPane();
		contentPane.add(splitPaneGumbi, BorderLayout.SOUTH);
		
		JButton btnPocetak = new JButton("New game");
		btnPocetak.setBackground(Color.LIGHT_GRAY);
		btnPocetak.setContentAreaFilled(false);
		btnPocetak.setOpaque(true);
		JButton btnPotvrda = new JButton("Confirm letter");
		
		splitPaneGumbi.setLeftComponent(btnPocetak);
		splitPaneGumbi.setRightComponent(btnPotvrda);
		splitPaneGumbi.setMaximumSize(new Dimension(520, 200));
		btnPotvrda.setEnabled(false);
		
		
		
		//Okvir za rijeè za riješavanje
		JTextArea tekst = new JTextArea();
		tekst.setEditable(false);
		splitPaneTekst.setRightComponent(tekst);
		tekst.setFont(new Font("Verdana", Font.BOLD, 12));
		tekst.setBackground(new Color(255, 250, 250));
		
		
		
		//Okviri za tekst
		JSplitPane splitPane_1 = new JSplitPane();
		splitPaneTekst.setLeftComponent(splitPane_1);
		
		JLabel lblUnesiteSlovo = new JLabel("Unesite slovo:");
		JTextField textField = new JTextField();
	    textField.setDocument(new Funkcije(1));
	    
		splitPane_1.setRightComponent(textField);
		splitPane_1.setLeftComponent(lblUnesiteSlovo);
		
	    splitPaneTekst.setOrientation(JSplitPane.VERTICAL_SPLIT);
	    contentPane.add(splitPaneTekst);

	    String zadatak, str = null, count = null;
	    double nasum;
	    
	    
	try {
		//Otvaranje veze prema bazi i upit za prebrojavanje rijeci
		Class.forName("org.h2.Driver");
		Connection con = DriverManager.getConnection("jdbc:h2:~/Rijeci", "sa", "");
		Statement st = con.createStatement();
		String doseg = ("SELECT COUNT(rijec) FROM rijeci;");
		ResultSet brojac = st.executeQuery(doseg);
		if(brojac.next()) count = brojac.getString("COUNT(rijec)");
		
		//Konverzija rijeci u decimalni broj, te onda u prirodni broj
		nasum = Double.parseDouble(count);
		int prirodni_broj = (int)nasum;
		
		//Stvaranje nasumiènog broja (najveæa vrijednost "COUNT(rijec)", a najmanja 0)
		Random rand = new Random();
		nasum = rand.nextInt(prirodni_broj);
		if(nasum == 0) ++nasum;

		//Dohvat rijeci
		String upit = ("SELECT rijec FROM rijeci where ID = " + nasum + ";");
		ResultSet redak = st.executeQuery(upit);
		if(redak.next()) str = redak.getString("rijec");

		st.close();
	}
	
	catch (ClassNotFoundException e) {e.printStackTrace();}
	
	catch (SQLException e) {e.printStackTrace();}

	    //Postavljanje slike, duljine 200px
	    ImageIcon uvoz = new ImageIcon(getClass().getClassLoader().getResource("Pokusaj 0.png"));
		Image image = uvoz.getImage();
		Image newimg = image.getScaledInstance(
				200, (int) (200 * 1.25),  java.awt.Image.SCALE_SMOOTH);
		uvoz = new ImageIcon(newimg);

		JLabel opis = new JLabel(uvoz);
		getContentPane().add(opis, BorderLayout.NORTH);
		opis.setAlignmentX(20);
		opis.setVisible(false);

		JLabel[] opis_pog = new JLabel[7];
		opis_pog[0] = opis;
		opis_pog[0].setVisible(true);		
		

		//Dozvoljena vrijednost slova (od a do z; od A do Z) u ASCII formatu
		zadatak = str;
		final String rang = "^[a-zA-Z]";
		String zadatak_skriven[] = new String[zadatak.length()];
		HashSet<String> set = new HashSet<String>();
		
		btnPotvrda.addActionListener(new ActionListener(){
			private int i;
			private boolean bool, pravo_slovo, zavrsetak;
			private int k;
			
			public void actionPerformed(ActionEvent arg0) {
				//Dohvaæanje slova i resetiranje
				String unos = textField.getText();
				textField.setText("");

				//Provjera da li je znak slovo abecede
				if(unos.matches(rang)) {
					set.add(unos);
					pravo_slovo = true;
					char[] slovo = new char[zadatak.length()];
					unos = unos.toLowerCase();
					char ispit = unos.charAt(0);
					slovo = zadatak.toCharArray();
					tekst.setText("");
					
					//Provjera da li postoji unešeno slovo u zadatku
					if(zadatak.contains(unos)){
						bool = true;
						
						//Postavljanje znaka "_" na unešeno slovo
						for(k = 0; k < zadatak.length(); k++){
							if(slovo[k] == ispit) zadatak_skriven[k] = unos;
							
						tekst.append(zadatak_skriven[k]);
						}
						
						//Provjera da li je zadatak završen (ne smije biti znak "_" prikazan)
						for(k = 0; k < zadatak_skriven.length; k++){
							if(zadatak_skriven[k].contains("_") == false) {
								if(k == zadatak_skriven.length - 1) zavrsetak = true;
							}
							
							else k = zadatak_skriven.length;
						}
						
						//Victory!
						if(zavrsetak){
							end = System.currentTimeMillis();
							
							tekst.append("\nYou win! Congratulations!\n" 
							+ Funkcije.vrijeme(end, start));
							if (i > 0) tekst.append("\nNumber of mistakes: " + i);
							
							btnPotvrda.setEnabled(!zavrsetak);
							btnPocetak.setEnabled(zavrsetak);
						}
					}
					
					//Ako postoji slovo u abecedi, ali nije pogoðeno slovo
					else {
						bool = false;
						for(k = 0; k < zadatak.length(); k++)
							tekst.append(zadatak_skriven[k]);
					}

					tekst.append("\n");
				}
				
				//Ako unešeno slovo nije dio abecede
				else {
					JOptionPane.showMessageDialog(null, "Insert only characters.");
					bool = true;
					pravo_slovo = false;
				}
				
				//Prikaz unešenih slova, bilo toènih ili ne
				if(pravo_slovo) {
					tekst.append("Letters typed: ");
					for (String slova: set) tekst.append(slova + " ");
				}
				
				
				
				if(!bool){					
					i++;
					
				//Otvaranje slike i postavljanje velièine
				ImageIcon uvoz_pog = 
						new ImageIcon(getClass().getClassLoader().
								getResource("Pokusaj " + i + ".png"));
				
				Image image = uvoz_pog.getImage();
				Image nova_slika = image.getScaledInstance(200, (int) (200 * 1.25),
						java.awt.Image.SCALE_SMOOTH);  
				
				uvoz_pog = new ImageIcon(nova_slika);
				
				//Zamjena slike za svaku novu pogrešku
				opis_pog[i] = new JLabel(uvoz_pog);
				getContentPane().add(opis_pog[i], BorderLayout.NORTH);
				opis_pog[i].setAlignmentX(20);
				opis_pog[i].setVisible(!bool);
				
				opis_pog[i-1].setVisible(bool);
				
				//You lose!
				if(i == 6) {
					end = System.currentTimeMillis();
					
					tekst.append("\nGAME OVER\n" + Funkcije.vrijeme(end, start));
					btnPotvrda.setEnabled(bool);
					btnPocetak.setEnabled(!bool);

					i = 0;
					btnPocetak.setBackground(Color.LIGHT_GRAY);
					}
				}
			}
		});
		
		btnPocetak.addActionListener(new ActionListener(){
			protected boolean prvi = true;
			
			public void actionPerformed(ActionEvent arg0) {
				btnPotvrda.setEnabled(prvi);
				btnPocetak.setEnabled(!prvi);

				//Ako nije prvi put pokrenut program
					if(this.prvi == false) {
						tekst.setText("");
						opis_pog[6].setVisible(!prvi);
					}
					
					else prvi = false;

					//Poèetak mjerenja milisekunda te prikaz zadataka
					opis_pog[0].setVisible(true);
					start = System.currentTimeMillis();
					
					for(int j = 0; j < zadatak.length(); j++) {
						zadatak_skriven[j] = "_ ";
						tekst.append(zadatak_skriven[j]);
				}
			}
		});
	}
}
