<?php
$this->insertFigur(1, "Allgemeine Regeln");
$this->insertFigur(2, "Bauer");
$this->insertFigur(3, "Läufer");
$this->insertFigur(4, "Springer");
$this->insertFigur(5, "Turm");
$this->insertFigur(6, "Dame");
$this->insertFigur(7, "König");


// Allgemeine Regeln Quiz start //

$this->insertQuizQuestion(1,1,"1. Wie viele unterschiedliche Figurentypen gibt es?", "", 1);

$this->insertQuizQuestionOption(1,"8");
$this->insertQuizQuestionOption(1,"6");
$this->insertQuizQuestionOption(1,"4");
$this->insertQuizQuestionOption(1,"2");


$this->insertQuizQuestion(1,2,"2. Wie viele Schachfiguren gibt es auf dem Schachbrett?", "", 3);

$this->insertQuizQuestionOption(2,"64");
$this->insertQuizQuestionOption(2,"128");
$this->insertQuizQuestionOption(2,"16");
$this->insertQuizQuestionOption(2,"32");
$this->insertQuizQuestionOption(2,"8");
$this->insertQuizQuestionOption(2,"4");


$this->insertQuizQuestion(1,3,"3. Wer darf den ersten Zug machen?", "", 0);

$this->insertQuizQuestionOption(3,"Weißer Spieler");
$this->insertQuizQuestionOption(3,"Schwarzer Spieler");
$this->insertQuizQuestionOption(3,"Niemand");
$this->insertQuizQuestionOption(3,"Schiedsrichter");


$this->insertQuizQuestion(1,4,"4. Wie viele Figuren hat der schwarze Spieler?", "", 2);

$this->insertQuizQuestionOption(4,"64");
$this->insertQuizQuestionOption(4,"128");
$this->insertQuizQuestionOption(4,"16");
$this->insertQuizQuestionOption(4,"32");
$this->insertQuizQuestionOption(4,"8");
$this->insertQuizQuestionOption(4,"4");


$this->insertQuizQuestion(1,5,"5. Was braucht man alles, um ein Schachspiel zu starten?", "", 4);

$this->insertQuizQuestionOption(5,"Schachbrett, Schachfiguren");
$this->insertQuizQuestionOption(5,"Brotbrett, Schachfiguren");
$this->insertQuizQuestionOption(5,"Schachbrett, Wachsfiguren, Gegner");
$this->insertQuizQuestionOption(5,"König, Dame, Turm, Läufer, Springer, Bauer");
$this->insertQuizQuestionOption(5,"Schachbrett, Schachfiguren, Gegner");


$this->insertQuizQuestion(1,6,"6. Seit wann ist Schach in Europa ein sicher weit verbreitetes Spiel?", "", 3);

$this->insertQuizQuestionOption(6,"19. Jhd.");
$this->insertQuizQuestionOption(6,"2021");
$this->insertQuizQuestionOption(6,"18. Jhd.");
$this->insertQuizQuestionOption(6,"13. Jhd.");
$this->insertQuizQuestionOption(6,"21. Jhd.");
$this->insertQuizQuestionOption(6,"heute");


$this->insertQuizQuestion(1,7,"7. Wie lauten die Bezeichner der Schachbrettränder?", "", 0);

$this->insertQuizQuestionOption(7,"1-8 und a-h");
$this->insertQuizQuestionOption(7,"91-98 und a-h");
$this->insertQuizQuestionOption(7,"a-p");
$this->insertQuizQuestionOption(7,"keine Bezeichner");


$this->insertQuizQuestion(1,8,"8. Welche Reihe ist die schwarze Grundlinie?", "", 7);

$this->insertQuizQuestionOption(8,"Reihe 1");
$this->insertQuizQuestionOption(8,"Reihe 2");
$this->insertQuizQuestionOption(8,"Reihe 3");
$this->insertQuizQuestionOption(8,"Reihe 4");
$this->insertQuizQuestionOption(8,"Reihe 5");
$this->insertQuizQuestionOption(8,"Reihe 6");
$this->insertQuizQuestionOption(8,"Reihe 7");
$this->insertQuizQuestionOption(8,"Reihe 8");


$this->insertQuizQuestion(1,9,"9. Ist das Spiel vorbei, wenn ein Spieler „Schach“ sagt?", "", 1);

$this->insertQuizQuestionOption(9,"Ja");
$this->insertQuizQuestionOption(9,"Nein");


$this->insertQuizQuestion(1,10,"10. Bei Schach ist es das Ziel, welche gegnerische Figur „Schachmatt“ zu setzen?", "", 3);

$this->insertQuizQuestionOption(10,"Dame");
$this->insertQuizQuestionOption(10,"Bauer");
$this->insertQuizQuestionOption(10,"Läufer");
$this->insertQuizQuestionOption(10,"König");

// Allgemeine Regeln Quiz end //


// Bauer Quiz start //

$this->insertQuizQuestion(2,1,"1. Wie viele Bauern gibt es insgesamt am Anfang auf dem Schachbrett?", "", 2);

$this->insertQuizQuestionOption(11,"4");
$this->insertQuizQuestionOption(11,"8");
$this->insertQuizQuestionOption(11,"16");
$this->insertQuizQuestionOption(11,"32");


$this->insertQuizQuestion(2,2,"2. In welche der nachfolgenden Figuren kann ein Bauer nicht umgewandelt werden?", "", 3);

$this->insertQuizQuestionOption(12,"Läufer");
$this->insertQuizQuestionOption(12,"Springer");
$this->insertQuizQuestionOption(12,"Turm");
$this->insertQuizQuestionOption(12,"König");
$this->insertQuizQuestionOption(12,"Dame");


$this->insertQuizQuestion(2,3,"3. Welche der folgenden Felder ist kein Startfeld für einen Bauern?", "", 2);

$this->insertQuizQuestionOption(13,"a2");
$this->insertQuizQuestionOption(13,"g2");
$this->insertQuizQuestionOption(13,"d6");
$this->insertQuizQuestionOption(13,"c7");
$this->insertQuizQuestionOption(13,"e7");


$this->insertQuizQuestion(2,4,"4. Welche der folgenden Züge ist bei einem Bauern nicht möglich?", "", 0);

$this->insertQuizQuestionOption(14,"1 Feld vorwärts und 1 Feld diagonal");
$this->insertQuizQuestionOption(14,"1 Feld diagonal");
$this->insertQuizQuestionOption(14,"1 Feld vorwärts");
$this->insertQuizQuestionOption(14,"2 Felder vorwärts");


$this->insertQuizQuestion(2,5,"5. Mit welchen Zug kann ein Bauer eine gegnerische Figur schlagen?", "", 3);

$this->insertQuizQuestionOption(15,"1 Feld vorwärts");
$this->insertQuizQuestionOption(15,"2 Felder vorwärts");
$this->insertQuizQuestionOption(15,"2 Felder vorwärts und einen zur Seite");
$this->insertQuizQuestionOption(15,"1 Feld diagonal");
$this->insertQuizQuestionOption(15,"2 Felder diagonal");


$this->insertQuizQuestion(2,6,"6. Kann ein Bauer eine andere Figur auf den nächsten Feld vor sich überspringen?", "", 1);

$this->insertQuizQuestionOption(16,"Ja");
$this->insertQuizQuestionOption(16,"Nein");


$this->insertQuizQuestion(2,7,"7. Welche Figur schlägt anders als sie zieht?", "", 3);

$this->insertQuizQuestionOption(17,"Springer");
$this->insertQuizQuestionOption(17,"König");
$this->insertQuizQuestionOption(17,"Läufer");
$this->insertQuizQuestionOption(17,"Bauer");


$this->insertQuizQuestion(2,8,"8. Wie viele verschiedene Bauernzüge kann Weiß ausführen?", "pawn-question8.png", 4);

$this->insertQuizQuestionOption(18,"3");
$this->insertQuizQuestionOption(18,"2");
$this->insertQuizQuestionOption(18,"7");
$this->insertQuizQuestionOption(18,"1");
$this->insertQuizQuestionOption(18,"5");


$this->insertQuizQuestion(2,9,"9. Wie viele Figuren des Gegners kann der weiße Bauer auf b4 schlagen?", "pawn-question9.png", 1);

$this->insertQuizQuestionOption(19,"0");
$this->insertQuizQuestionOption(19,"1");
$this->insertQuizQuestionOption(19,"2");
$this->insertQuizQuestionOption(19,"3");


$this->insertQuizQuestion(2,10,"10. In wie vielen Zügen gelangt der schwarze Bauer vom Feld e7 auf das Feld e3?", "pawn-question10.PNG", 2);

$this->insertQuizQuestionOption(20,"2");
$this->insertQuizQuestionOption(20,"5");
$this->insertQuizQuestionOption(20,"3 und 4");
$this->insertQuizQuestionOption(20,"2 und 3");
$this->insertQuizQuestionOption(20,"6");
$this->insertQuizQuestionOption(20,"5 und 6");

// Bauer Quiz end //


// Läufer Quiz start //

$this->insertQuizQuestion(3,1,"1. Welche Figur wechselt nie seine Feldfarbe?", "", 2);

$this->insertQuizQuestionOption(21, "Bauer");
$this->insertQuizQuestionOption(21, "Springer");
$this->insertQuizQuestionOption(21, "Läufer");
$this->insertQuizQuestionOption(21, "Turm");
$this->insertQuizQuestionOption(21, "Dame");
$this->insertQuizQuestionOption(21, "König");


$this->insertQuizQuestion(3,2,"2. Wie viele Läufer gibt es insgesamt am Anfang auf dem Schachbrett?", "", 3);

$this->insertQuizQuestionOption(22,"1");
$this->insertQuizQuestionOption(22,"8");
$this->insertQuizQuestionOption(22,"2");
$this->insertQuizQuestionOption(22,"4");


$this->insertQuizQuestion(3,3,"3. Wie viele Züge braucht der weiße Läufer mindestens, um nach g5 zu gelangen?", "bishop-question2.PNG", 1);

$this->insertQuizQuestionOption(23,"3");
$this->insertQuizQuestionOption(23,"2");
$this->insertQuizQuestionOption(23,"1");
$this->insertQuizQuestionOption(23,"4");


$this->insertQuizQuestion(3,4,"4. Auf welchen Feldern starten die weißen Läufer?", "", 2);

$this->insertQuizQuestionOption(24,"c8 und f8");
$this->insertQuizQuestionOption(24,"d1 und e1");
$this->insertQuizQuestionOption(24,"c1 und f1");
$this->insertQuizQuestionOption(24,"a3 und h3");


$this->insertQuizQuestion(3,5,"5. Kann der schwarze Läufer jemals den Bauer auf c2 schlagen?", "bishop-question5.PNG", 1);

$this->insertQuizQuestionOption(25,"Ja");
$this->insertQuizQuestionOption(25,"Nein");


$this->insertQuizQuestion(3,6,"6. Kann der Läufer andere Figuren überspringen?", "", 1);

$this->insertQuizQuestionOption(26,"Ja");
$this->insertQuizQuestionOption(26,"Nein");


$this->insertQuizQuestion(3,7,"7. Auf wie viele Felder kann der schwarze Läufer im nächsten Zug ziehen?", "bishop-question7.png", 3);

$this->insertQuizQuestionOption(27,"3");
$this->insertQuizQuestionOption(27,"2");
$this->insertQuizQuestionOption(27,"1");
$this->insertQuizQuestionOption(27,"0");


$this->insertQuizQuestion(3,8,"8. Welche Figur steht am Anfang nicht neben einem Läufer?", "", 3);

$this->insertQuizQuestionOption(28,"Bauer");
$this->insertQuizQuestionOption(28,"Dame");
$this->insertQuizQuestionOption(28,"König");
$this->insertQuizQuestionOption(28,"Turm");
$this->insertQuizQuestionOption(28,"Springer");


$this->insertQuizQuestion(3,9,"9. Wie viele Felder kann der Läufer maximal ziehen?", "bishop-question2.PNG", 2);

$this->insertQuizQuestionOption(29,"2");
$this->insertQuizQuestionOption(29,"1");
$this->insertQuizQuestionOption(29,"5");
$this->insertQuizQuestionOption(29,"4");
$this->insertQuizQuestionOption(29,"0");


$this->insertQuizQuestion(3,10,"10. Auf welchen Feldern kann der weiße Läufer Figuren schlagen?", "bishop-question10.PNG", 2);

$this->insertQuizQuestionOption(30,"d5");
$this->insertQuizQuestionOption(30,"keine");
$this->insertQuizQuestionOption(30,"b6 und e7");
$this->insertQuizQuestionOption(30,"b6, e7 und f2");

// Läufer Quiz end //


// Springer Quiz start //

$this->insertQuizQuestion(4,1,"1. Auf wie viele Felder kann der weiße Springer ziehen?", "knight-question1.PNG", 4);

$this->insertQuizQuestionOption(31,"3");
$this->insertQuizQuestionOption(31,"4");
$this->insertQuizQuestionOption(31,"5");
$this->insertQuizQuestionOption(31,"6");
$this->insertQuizQuestionOption(31,"7");
$this->insertQuizQuestionOption(31,"8");


$this->insertQuizQuestion(4,2,"2. Was ist das Besondere am Springer?", "", 2);

$this->insertQuizQuestionOption(32,"Er ist die schnellste Figur");
$this->insertQuizQuestionOption(32,"Er kann eigene Figuren schlagen");
$this->insertQuizQuestionOption(32,"Er kann andere Figuren überhüpfen");
$this->insertQuizQuestionOption(32,"Er kann sich in eine andere Figur umwandeln");


$this->insertQuizQuestion(4,3,"3. In einen bekannten Sprichwort heißt es, Springer am Rand bringt...", "", 3);

$this->insertQuizQuestionOption(33,"Glück");
$this->insertQuizQuestionOption(33,"den Sieg");
$this->insertQuizQuestionOption(33,"eine Dame");
$this->insertQuizQuestionOption(33,"Schand");
$this->insertQuizQuestionOption(33,"eine Niederlage");


$this->insertQuizQuestion(4,4,"4. Wie viele Springer hat jeder Spieler?", "", 1);

$this->insertQuizQuestionOption(34,"8");
$this->insertQuizQuestionOption(34,"2");
$this->insertQuizQuestionOption(34,"4");
$this->insertQuizQuestionOption(34,"6");


$this->insertQuizQuestion(4,5,"5. Welche allgemeine Schrittreihenfolge trifft für den Springer zu?", "", 1);

$this->insertQuizQuestionOption(35,"1 Feld vorwärts und 1 Feld rechts");
$this->insertQuizQuestionOption(35,"2 Felder vorwärts / rechts / rückwärts / links und 1 Feld links / rechts");
$this->insertQuizQuestionOption(35,"1 Feld vorwärts, 1 Feld rechts, 1 Feld rückwärts und 1 Feld links");
$this->insertQuizQuestionOption(35,"1 Feld diagonal");
$this->insertQuizQuestionOption(35,"2 Felder diagonal und 1 Feld links / rechts");


$this->insertQuizQuestion(4,6,"6. Kann der Springer vom Schachbrett springen?", "", 1);

$this->insertQuizQuestionOption(36,"Ja");
$this->insertQuizQuestionOption(36,"Nein");


$this->insertQuizQuestion(4,7,"7. Welchem Tier ähnelt die Figur des Springers am meisten?", "", 2);

$this->insertQuizQuestionOption(37,"Esel");
$this->insertQuizQuestionOption(37,"Zebra");
$this->insertQuizQuestionOption(37,"Pferd");
$this->insertQuizQuestionOption(37,"Hund");


$this->insertQuizQuestion(4,8,"8. Wie viele Felder kann der Springer aktuell erreichen?", "knight-question8.PNG", 2);

$this->insertQuizQuestionOption(38,"0");
$this->insertQuizQuestionOption(38,"2");
$this->insertQuizQuestionOption(38,"4");
$this->insertQuizQuestionOption(38,"6");
$this->insertQuizQuestionOption(38,"8");


$this->insertQuizQuestion(4,9,"9. Auf welchen Feldern kann der weiße Springer Figuren schlagen?", "knight-question9.PNG", 3);

$this->insertQuizQuestionOption(39,"d7, e6, a4");
$this->insertQuizQuestionOption(39,"Kein Feld");
$this->insertQuizQuestionOption(39,"b7, d7");
$this->insertQuizQuestionOption(39,"b7, d7, e6");


$this->insertQuizQuestion(4,10,"10. Der elegante Sprung des Springer ähnelt welchem Buchstaben?", "", 2);

$this->insertQuizQuestionOption(40,"T");
$this->insertQuizQuestionOption(40,"B");
$this->insertQuizQuestionOption(40,"L");
$this->insertQuizQuestionOption(40,"P");
$this->insertQuizQuestionOption(40,"E");
$this->insertQuizQuestionOption(40,"I");

// Springer Quiz end //


// Trum Quiz start //

$this->insertQuizQuestion(5,1,"1. Wie viele Züge braucht der weiße Turm minimal, um nach b7 zu gelangen?", "rock-question1.PNG", 0);

$this->insertQuizQuestionOption(41,"3");
$this->insertQuizQuestionOption(41,"2");
$this->insertQuizQuestionOption(41,"1");
$this->insertQuizQuestionOption(41,"4");
$this->insertQuizQuestionOption(41,"0");
$this->insertQuizQuestionOption(41,"10");


$this->insertQuizQuestion(5,2,"2. Wie viele Türme haben der weiße und schwarze Spieler zusammen zu Beginn des Spiels auf dem Schachbrett?", "", 4);

$this->insertQuizQuestionOption(42,"7");
$this->insertQuizQuestionOption(42,"8");
$this->insertQuizQuestionOption(42,"2");
$this->insertQuizQuestionOption(42,"5");
$this->insertQuizQuestionOption(42,"4");


$this->insertQuizQuestion(5,3,"3. Wie nennt sich ein schönes Kunstwerk, das auch mit 0-0 oder 0-0-0 bezeichnet wird, das der Turm mit seinem König als Bewegung durchführen kann?", "", 3);

$this->insertQuizQuestionOption(43,"Hochade");
$this->insertQuizQuestionOption(43,"Rochenade");
$this->insertQuizQuestionOption(43,"Stochade");
$this->insertQuizQuestionOption(43,"Rochade");
$this->insertQuizQuestionOption(43,"Schochade");
$this->insertQuizQuestionOption(43,"Marmelade");


$this->insertQuizQuestion(5,4,"4. Wie bewegt sich ein  Turm?", "", 2);

$this->insertQuizQuestionOption(44,"1 Feld vorwärts");
$this->insertQuizQuestionOption(44,"Mehrere Felder diagonal");
$this->insertQuizQuestionOption(44,"Mehrere Felder vorwärts / rechts / rückwärts / links");
$this->insertQuizQuestionOption(44,"Mehrere Felder vorwärts / rechts / diagonal / links");


$this->insertQuizQuestion(5,5,"5. Mit welchen Turm kann der weiße König das in Frage 4 angesprochene „schöne Kunstwerk“ im nächsten Zug vollziehen?", "rock-question5.PNG", 3);

$this->insertQuizQuestionOption(45,"a8 und h8");
$this->insertQuizQuestionOption(45,"b1, a8, h1 und h8");
$this->insertQuizQuestionOption(45,"b1");
$this->insertQuizQuestionOption(45,"h1");
$this->insertQuizQuestionOption(45,"b1 und h1");


$this->insertQuizQuestion(5,6,"6. Werden bei dem „schönen Kunstwerk“ die beteiligten Figuren immer um die gleiche Anzahl an Feldern versetzt?", "", 1);

$this->insertQuizQuestionOption(46,"Ja");
$this->insertQuizQuestionOption(46,"Nein");


$this->insertQuizQuestion(5,7,"7. Mit welcher Bewegung schlägt der Turm eine gegnerische Figur?", "", 3);

$this->insertQuizQuestionOption(47,"1 Feld diagonal");
$this->insertQuizQuestionOption(47,"1 Feld rückwärts");
$this->insertQuizQuestionOption(47,"Belibige Anzahl an Feldern diagonal");
$this->insertQuizQuestionOption(47,"Belibige Anzahl an Feldern vorwärts / rechts / rückwärts / links");


$this->insertQuizQuestion(5,8,"8. Welche Figuren sind die direkten Nachbarn des Turms auf dem Schachbrett vor Spielbeginn?", "", 1);

$this->insertQuizQuestionOption(48,"Bauer und König");
$this->insertQuizQuestionOption(48,"Bauer und Springer");
$this->insertQuizQuestionOption(48,"Springer und Dame");
$this->insertQuizQuestionOption(48,"Läufer");
$this->insertQuizQuestionOption(48,"Bauer, Turm und König");
$this->insertQuizQuestionOption(48,"Springer");


$this->insertQuizQuestion(5,9,"9. Zieht der Turm wie ein Läufer oder Springer?", "", 1);

$this->insertQuizQuestionOption(49,"Ja");
$this->insertQuizQuestionOption(49,"Nein");


$this->insertQuizQuestion(5,10,"10. Wie viele Figuren können die weißen Türme zusammen schlagen?", "rock-question10.PNG", 1);

$this->insertQuizQuestionOption(50,"2");
$this->insertQuizQuestionOption(50,"3");
$this->insertQuizQuestionOption(50,"1");
$this->insertQuizQuestionOption(50,"0");
$this->insertQuizQuestionOption(50,"4");

// Turm Quiz end //


// Dame Quiz start //

$this->insertQuizQuestion(6,1,"1. Wie viele Figuren kann die weiße Dame schlagen?", "queen-question1.PNG", 2);

$this->insertQuizQuestionOption(51,"3");
$this->insertQuizQuestionOption(51,"1");
$this->insertQuizQuestionOption(51,"2");
$this->insertQuizQuestionOption(51,"4");
$this->insertQuizQuestionOption(51,"0");
$this->insertQuizQuestionOption(51,"5");


$this->insertQuizQuestion(6,2,"2. Die Dame zieht wie welche Figuren?", "", 2);

$this->insertQuizQuestionOption(52,"Läufer + Springer");
$this->insertQuizQuestionOption(52,"Springer + Turm");
$this->insertQuizQuestionOption(52,"Läufer + Turm");
$this->insertQuizQuestionOption(52,"König + Bauer");


$this->insertQuizQuestion(6,3,"3. Wie viele Damen gibt es beim Spielanfang auf dem Feld?", "", 0);

$this->insertQuizQuestionOption(53,"2");
$this->insertQuizQuestionOption(53,"3");
$this->insertQuizQuestionOption(53,"1");
$this->insertQuizQuestionOption(53,"0");


$this->insertQuizQuestion(6,4,"4. Von welchem Feld startet die schwarze Dame zu Beginn eines Spiels?", "", 2);

$this->insertQuizQuestionOption(54,"a1");
$this->insertQuizQuestionOption(54,"d1");
$this->insertQuizQuestionOption(54,"d8");
$this->insertQuizQuestionOption(54,"e8");


$this->insertQuizQuestion(6,5,"5. Die Dame gilt als...", "", 2);

$this->insertQuizQuestionOption(55,"Empfangsdame");
$this->insertQuizQuestionOption(55,"Ersatz des Königs im Spiel");
$this->insertQuizQuestionOption(55,"Alleskönnerin");


$this->insertQuizQuestion(6,6,"6. Kann eine Dame andere Figuren überspringen?", "", 1);

$this->insertQuizQuestionOption(56,"Ja");
$this->insertQuizQuestionOption(56,"Nein");


$this->insertQuizQuestion(6,7,"7. Welche Figuren befinden sich beim Spielanfang auf der Grundlinie neben der Dame?", "", 1);

$this->insertQuizQuestionOption(57,"Springer + Springer");
$this->insertQuizQuestionOption(57,"König + Läufer");
$this->insertQuizQuestionOption(57,"Läufer + Bauer");
$this->insertQuizQuestionOption(57,"König + Läufer + Bauer");


$this->insertQuizQuestion(6,8,"8. Auf welchen Feldern kann die Dame den König ins „Schach“ setzen?", "rock-question10.PNG", 2);

$this->insertQuizQuestionOption(58,"keine");
$this->insertQuizQuestionOption(58,"a2");
$this->insertQuizQuestionOption(58,"b4 und b1");
$this->insertQuizQuestionOption(58,"b5 und b1");


$this->insertQuizQuestion(6,9,"9. Auf welchen Feldern kann die schwarze Dame weiße Figuren im nächsten Zug schlagen?", "bishop-question7.PNG", 0);

$this->insertQuizQuestionOption(59,"b2 und f2");
$this->insertQuizQuestionOption(59,"b2, g1 und f2");
$this->insertQuizQuestionOption(59,"a2, b2, c2 und f2");
$this->insertQuizQuestionOption(59,"f2");
$this->insertQuizQuestionOption(59,"a1");


$this->insertQuizQuestion(6,10,"10. Welche Dame hat die meisten Möglichkeiten gegnerische Figuren zu schlagen?", "queen-question10.PNG", 1);

$this->insertQuizQuestionOption(60,"Weiße Dame");
$this->insertQuizQuestionOption(60,"Schwarze Dame");
$this->insertQuizQuestionOption(60,"Beide gleich");

// Dame Quiz end //


// König Quiz start //

$this->insertQuizQuestion(7,1,"1. Welche Aussage über den König ist falsch?", "", 0);

$this->insertQuizQuestionOption(61,"Der schwarze König steht auf einem schwarzen Feld");
$this->insertQuizQuestionOption(61,"Der weiße König steht auf dem Feld e1");
$this->insertQuizQuestionOption(61,"Neben dem König steht seine Dame");
$this->insertQuizQuestionOption(61,"Die beiden Könige stehen beide auf einem Feld mit e");


$this->insertQuizQuestion(7,2,"2. Was wird gesagt, wenn ein König verloren hat?", "", 1);

$this->insertQuizQuestionOption(62,"Schach!");
$this->insertQuizQuestionOption(62,"Schachmatt!");
$this->insertQuizQuestionOption(62,"Verloren Meister!");
$this->insertQuizQuestionOption(62,"Verlierer!");


$this->insertQuizQuestion(7,3,"3. Was sind die Nachbarfelder des schwarzen Königs auf seiner Grundlinie?", "", 2);

$this->insertQuizQuestionOption(63,"f3 und h3");
$this->insertQuizQuestionOption(63,"e8 und g8");
$this->insertQuizQuestionOption(63,"d8 und f8");
$this->insertQuizQuestionOption(63,"a8 und c8");


$this->insertQuizQuestion(7,4,"4. Mit welcher Figur kann ein König eine Rochade durchführen?", "", 1);

$this->insertQuizQuestionOption(64,"Bauer");
$this->insertQuizQuestionOption(64,"Turm");
$this->insertQuizQuestionOption(64,"Dame");
$this->insertQuizQuestionOption(64,"Springer");


$this->insertQuizQuestion(7,5,"5. Wie viele Felder darf ein König ohne Rochade maximal ziehen?", "", 0);

$this->insertQuizQuestionOption(65,"1");
$this->insertQuizQuestionOption(65,"2");
$this->insertQuizQuestionOption(65,"beliebig viele");
$this->insertQuizQuestionOption(65,"0");


$this->insertQuizQuestion(7,6,"6. Kann ein Bauer in einen König umgewandelt werden?", "", 1);

$this->insertQuizQuestionOption(66,"Ja");
$this->insertQuizQuestionOption(66,"Nein");


$this->insertQuizQuestion(7,7,"7. Wie viele Könige haben der weiße und schwarze Spieler zusammen?", "", 0);

$this->insertQuizQuestionOption(67,"2");
$this->insertQuizQuestionOption(67,"1");
$this->insertQuizQuestionOption(67,"3");
$this->insertQuizQuestionOption(67,"0");


$this->insertQuizQuestion(7,8,"8. Auf wie viele Felder kann der weiße König im nächsten Zug ziehen?", "king-question8.PNG", 0);

$this->insertQuizQuestionOption(68,"3");
$this->insertQuizQuestionOption(68,"2");
$this->insertQuizQuestionOption(68,"7");
$this->insertQuizQuestionOption(68,"1");
$this->insertQuizQuestionOption(68,"5");


$this->insertQuizQuestion(7,9,"9. Schwarz ist am Zug. Welche Figur mit ihrem Zug setzt den König nicht „Schachmatt“?", "king-question9.PNG", 1);

$this->insertQuizQuestionOption(69,"Dame von d4 auf d1");
$this->insertQuizQuestionOption(69,"Läufer von e5 auf h2");
$this->insertQuizQuestionOption(69,"Dame von d4 auf f2");


$this->insertQuizQuestion(7,10,"10. Weiß ist am Zug. Kann der schwarze König in 2 Zügen „Schachmatt“ gesetzt werden?", "king-question10.PNG", 0);

$this->insertQuizQuestionOption(70,"Ja");
$this->insertQuizQuestionOption(70,"Nein");

// König Quiz end //
?>