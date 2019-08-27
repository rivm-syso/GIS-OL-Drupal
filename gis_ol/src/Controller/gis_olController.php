<?php

namespace Drupal\gis_ol\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class gis_olController
 *
 */
class gis_olController extends ControllerBase {

	/**
	 * Implements content
	 *
	 * @return array HtmlRenderer
	 *
	 */
	public function content() {
		if (isset($_GET['help'])) {
			$r='<h2>Help</h2>';
			$r.='Deze help bevat de volgende onderwerpen:<ol><li><a href="#form">Formaat en uiterlijk</a></li><li><a href="#basis">Basiskaarten</a></li><li><a href="#knop">Knoppen en overige controls</a></li><li><a href="#layer">Layer definities</a><ol><li><a href="#layerWMSinput">Layer van het type WMS Input</a></li><li><a href="#layerVectortile">Layer van het Vector type</a></li></ol></li><li><a href="#data">Data weergave</a></li></ol>';
			$r.='<h3><a name="form">Formaat en uiterlijk</a></h3>';
			$r.='<p><table>';
			$r.='<tr><td>Aspect ratio:</td><td>De hoogte van de kaart wordt berekend a.d.h.v. de breedte en de aspect-ratio. De breedte hangt af van de ruimte op de pagina (en het device). De default aspect-ratio is dit 1.2.</td></tr>';
			$r.='<tr><td>Kleurstelling:</td><td>De kleurstelling (vlgs. de rijkshuisstijl) die moet worden gebruikt. De waarde \'Automatisch\' zorgt er voor dat de kleur zich aanpast aan de kleur van het menu. Deze instelling niet op productie gebruiken.</td></tr>';
			$r.='</table></p>';
			$r.='<h3><a name="basis">Basiskaarten</a></h3>';
			$r.='<p>De basiskaarten worden geladen vanaf: https://geodata.nationaalgeoregister.nl/tiles/service/wmts.<table>';
			$r.='<tr><td>brt achtergrondkaart:</td><td>layer = brtachtergrondkaart</td></tr>';
			$r.='<tr><td>Luchtfoto:</td><td>layer = 2017_ortho25</td></tr>';
			$r.='<tr><td>Topografisch:</td><td>layer = top25raster (Let op: topografische gegevens worden pas zichtbaar op een schaal vanaf 1:25.000)</td></tr>';
			$r.='</table></p>';
			$r.='<h3><a name="knop">Knoppen en overige controls</a></h3>';
			$r.='<p>In elke hoek van de kaart zijn knoppen beschikbaar die de redacteur aan - of uit kan zetten. Linksboven staan knoppen mbt zoomen en locatie. Rechtsboven staan knoppen mbt layers en filters. Linksonder staan knoppen mbt schaal en positie en rechtsonder de timeslider.<table>';
			$r.='<tr><th colspan="2"><b>Links boven</b></th></tr>';
			$r.='<tr><td>In- en uitzoomen:</td><td>Knop om in- en uit te zoomen.</td></tr>';
			$r.='<tr><td>Locatie zoeker:</td><td>De locatiezoeker bestaat uit een invoerveld en 2 knoppen (\'Start zoeken\' en \'Ga naar mijn locatie\'). Als de bezoeker typt in het invoerveld, dan worden de 5 beste zoekresultaten getoond. Door op \'Start zoeken\' te klikken wordt ingezoemt op het bovenste zoekresultaat. Men kan ook direct op een zoekresultaat klikken om daarop in te zoomen, of op de knop \'Zoom in op mijn locatie\'. De browser gebruikt dan de locatie-gegevens van het betreffende device, als deze voorhanden zijn.</td></tr>';
			$r.='<tr><td>Zoom extend:</td><td>Toon geheel Nederland. Dit is ook het default zoom-niveau.</td></tr>';
			$r.='<tr><td>Full screen:</td><td>De meeste devices bieden de mogelijkheid om het volledige scherm te benutten (IOS/Apple vaak niet). Als het device dit ondersteunt, dan is de full screen knop zichtbaar. Bij het wisselen wordt het zoom-level aangepast voor een betere gebruikerservaring.</td></tr>';
			$r.='</table></p><p><table>';
			$r.='<tr><th colspan="2"><b>Rechts boven</b></th></tr>';
			$r.='<tr><td>Layers:</td><td>Toon wel/niet een layers-knop die een window opent met de (gekozen) basislagen en de overige lagen.<br>De bezoeker kan in dit window 1 basislaag selecteren. Verder zijn de volgende opties beschikbaar:<ul><li>Selecteren; Kan de bezoeker 1 laag aanzetten (en daarmee de huidige laag uit), of kunnen alle lagen willekeurig aan - en uit worden gezet.</li><li>Wordt bij deze laag een opacity-slider getoond om de mate van doorschijnen te kunnen wijzigen, of niet.</li><li>Wordt bij deze laag een download-knop getoond of niet? Er zijn drie mogelijkheden; Nee, Ja-download data van geheel Nederland, of Ja-Vraag gebruiker te kiezen om de data van geheel Nederland te downloaden of alleen de data in de bounding-box (zichtabre deel op de kaart).</li><li>Wordt bij deze laag een knop getoond om op data.rivm.nl te zoeken naar metadata, of niet. Als zoekterm wordt de layername gebruikt.</li><li>Wordt bij deze laag een knop getoond om de legenda weer te geven, of niet.</li><li>De instelling achter of onder de laagnaam bepaalt waar de knoppen worden geplaatst. Bij korte laagnamen is achter beter, bij lange namen kunnen de knoppen beter onder de naam wordn geplaatst. Let op; Smartphones hebben niet zo veel ruimte.</li></ul></td></tr>';
			$r.='<tr><td>Filterknop:</td><td>Het tonen van een filterknop. Als de bezoeker deze knop gebruikt wordt een window geopend waarin de bezoeker filters op kan geven volgens de definitie per layer.<br>Er worden alleen filters getoond van layers die aan staan.</td></tr>';
			$r.='<tr><td>Filtervelden gedrag:</td><td>Default worden alle filters van de zichtbare layers getoond. Er kan echter worden gekozen om de bezoeker 1 invoerveld te presenteren dat op 2 of meer lagen wordt toegepast. Hierbij kan worden gekozen om dit te doen voor alle velden met een gelijke veldnaam (op de server) of met hetzelfde label.<br><br><b>Voorbeelden</b><br>Stel je hebt 2 lagen met de volgende veld-definities:<table><tr><th>Layer</th><th>Veldnaam</th><th>Label</th><th>Filtertype</th></tr><tr><td>Geiten</td><td>gemeente_naam</td><td>Gemeente</td><td>String \'like\'</td></tr><tr><td></td><td>aantal</td><td>Aantal</td><td>number \'range\' 0 30000 2500</td></tr><tr><td>Schapen</td><td>plaats</td><td>Gemeente</td><td>String \'like\'</td></tr><tr><td></td><td>aantal</td><td>Aantal</td><td>number \'range\' 0 30000 2500</td></tr><tr><td></td><td>jaar_telling</td><td>Jaar</td><td>number \'range\' 2015 2018 1</td></tr></table><br>NB: De getallen bij \'filtertype\' worden gebruikt als minimum -, maximum waarde en stapgrootte (de waarde wordt met de stapgrootte verhoogd/verlaagd mbv pijltjes in het invoerveld).<br><ol><li>De instelling \'Filter gedrag\' staat op \'Toon alle filters\'. De bezoeker zet beide lagen aan, klikt op de filter-knop en krijgt een window met 5 velden (Gemeente, Aantal, Gemeente, Aantal, Jaar) waarop kan worden gefilterd. Zo kan de gebruiker in 1 filtering dus fiteren op \'Toon mij alle gemeenten met EDE in de naam en meer dan 5000 geiten en alle gemeenten met MEER in de naam en minder dan 7500 schapen.\' </li><li>De instelling \'Filter gedrag\' staat op \'1 filter bij gelijke veldnamen\'. De bezoeker zet beide lagen aan, klikt op de filter-knop en krijgt een window met 4 velden (Gemeente, Aantal, Gemeente, <del>Aantal</del>, Jaar) waarop kan worden gefilterd. De veldnamen \'aantal\' worden samengevoegd. Zo kan de gebruiker in 1 filtering dus fiteren op \'Toon mij alle gemeenten met EDE in de naam en meer dan 5000 geiten en alle gemeenten met MEER in de naam en meer dan 5000 schapen.\' </li><li>De instelling \'Filter gedrag\' staat op \'1 filter bij gelijk label\'. De bezoeker zet beide lagen aan, klikt op de filter-knop en krijgt een window met 3 velden (Gemeente, Aantal, <del>Gemeente</del>, <del>Aantal</del>, Jaar) waarop kan worden gefilterd. De veldnamen \'Gemeente\' en \'Aantal\' (let op de hoofdletter) worden samengevoegd. Zo kan de gebruiker in 1 filtering dus fiteren op \'Toon mij alle gemeenten met EDE in de naam en meer dan 5000 geiten en alle gemeenten met EDE in de naam en meer dan 5000 schapen.\' </li></ol></td></tr>';
			$r.='</table></p><p><table>';
			$r.='<tr><th colspan="2"><b>Links onder</b></th></tr>';
			$r.='<tr><td>Scalebar:</td><td>Toon de schaal van de kaart, afhankelijk van het zoom-niveau.</td></tr>';
			$r.='<tr><td>Co&ouml;dinaten:</td><td>Toon de co&ouml;rdinaten als de bezoeken met de muis over de kaart beweegt.</td></tr>';
			$r.='</table></p><p><table>';
			$r.='<tr><th colspan="2"><b>Rechts onder</b></th></tr>';
			$r.='<tr><td>Timeslider:</td><td>Het tonen van een timeslider; Een schuifbalk waarmee de bezoeker &eacute;&eacute;n layer aan zet (en de andere layers uit). De timeslider kan in combinatie met de layers-knop worden gebruikt maar dat hoeft niet. Op optie \'Met play-knop\' toont ook een knop waarmee de lagen automatisch achter elkaar worden afgespeeld.</td></tr>';
			$r.='<tr><td>Interval:</td><td>Het aantal miliseconden tussen het tonen van opeenvolgende layers, na het drukken op de play-knop.</td></tr>';
			$r.='</table></p>';
			$r.='<h3><a name="layer">Layer definities</a></h3>';
			$r.='<p>Op de basiskaart(en) kunnen 1 of meer layers (lagen) worden getoond. Deze layers zijn van een bepaald type. Daarmee is ook bepaald op welke server de layer te vinden is. Per layer kunnen er verschillende zaken worden ingesteld. De uiteindelijke werking voor de gebruiker hangt af van deze instellingen, in combinatie met de mogelijkheden van de layer- en filterknop.</p>';
			$r.='<table><tr><td>Cache met laag-informatie legen</td><td>Het laden van alle beschikbare layers duurt lang. Daarom zijn ze in een cache geplaatst. Als aan een bron (b.v. rivm.data.nl) een layer is toegevoegd moet de cache worden geleegd, zodat die nieuwe layer hier zichtbaar wordt. Als het vinkje aan wordt gezet en de kaart wordt opgeslagen worden alle layers opnieuw ingelezen.</td></tr>';
			$r.='</table></p><p>Instellingen per layer:<table>';
			$r.='<tr><td>Pos:</td><td>Positie van de laag. Positie 1 ligt boven op de basiskaart en de layer op positie 2 ligt op de eerste layer.</td></tr>';
			$r.='<tr><td>Type:</td><td><ul><li>WMS; WMS-layer vanaf geodata.rivm.nl</li><li>WMS (input); WMS-layer vanaf geodata.rivm.nl met de mogelijkheid om meldingen van bezoekers te registreren.<br>Dit type geeft ook de mogelijkheid om de volgende instellingen te doen:<ul><li>Inleidende tekst; Als de bezoeker op de kaart klikt, verschijnt een window met deze tekst.</li><li>Uitleidende tekst; Als de bezoeker data heeft ingevoerd, wordt deze boodschap getoond.</li><li>Ok knop; De tekst op de Ok knop (bv Melding doen).</li><li>Cancelknop; De tekst op de cancelknop (bv Annuleren).</li></ul></li><li>data.rivm.nl; WMS-layer vanaf data.rivm.nl</li></ul></td></tr>';
			$r.='<tr><td>Layer:</td><td>De naam zoals deze aan de bron (zie type) bekend is. Bij het klikken op dit veld wordt een window geopend, waar een zoekterm kan worden opgegeven. De layers die aan de zoekterm voldoen worden getoond en uit deze lijst kan een layer worden gekozen.</td></tr>';
			$r.='<tr><td>Layernaam (in Drupal):</td><td>Laagnaam zoals deze in Drupal bekend is. Houdt deze naam zo kort mogelijk ivm de beschikbare ruimte (m.n. op mobiele devices).</td></tr>';
			$r.='<tr><td>Opacity:</td><td>Init&euml;le doorzichtigheid van de layer. Als bij de layers-knop de optie \'Met transparantie-knoppen\' is gekozen, dan kan de bezoeker deze init&iuml;ele doorzichtigheid aanpassen.</td></tr>';
			$r.='<tr><td>Initi&euml;el:</td><td>Het wel/niet zichtbaar zijn van een laag als de pagina is geladen. De bezoeker kan dit aanpassen als de layers-knop en/of de timeslider wordt getoond.</td></tr>';
			$r.='<tr><td>Features:</td><td>Deze instelling bepaald per layer of bij het klikken op de kaart gezocht moet worden naar \'data\' op de betreffende locatie (zie ook <a href="#data">Data weergave</a>):<ul><li>Nee (klikken op de kaart heeft voor deze layer geen resultaat)</li><li>Toon als laag aan staat (en de bezoeker klik op de kaart)</li><li>Altijd tonen (als de bezoeker op de kaart klikt, ongeacht of de laag aan staat)</li></ul>NB: Features is de GIS term voor homogene verzamelingen van algemene kenmerken met dezelfde ruimtelijke representatie, zoals punten, lijnen of veelhoeken, en een gemeenschappelijke set attribuutkolommen. In deze Help spreken we over \'velden\' (naam van de atribuutkolom) en \'data\' (de waarde voor deze feature).</td></tr>';
			$r.='<tr><td>Velden:</td><td>Na klikken op deze knop, verschijnt een window waarin de velden van deze laag worden getoond. Deze velden worden gelezen ingelezen vanaf de server en de volgende opties kunnen voor gebruik binnen Drupal worden opgegeven:<ul><li>Label, bij voorkeur een kort en goed leesbaar label (b.v. beginnen met een hoofdletter).</li><li>Eenheid; Een eventuele eenheid die achter de waarde wordt geplakt.</li><li>Align; Het al dan niet rechts uitlijnen van de waarde.</li><li>Filter; De definitie van het filter op dit veld (als de filter-knop aan staat). Deze definities bepaalt hoe de bezoeker op een bepaald veld kan filteren: <ul><li>string; optie of waarde exact gelijk moet zijn aan het filter, of dat er met een zogenaamde \'like\' moet worden gefilterd</li><li>number; optie of het getal kleiner, gelijk, etc. is aan het filtergetal dat door de bezoeker wordt ingegeven, of dat het getal in een range moet vallen. Bij deze opties kunnen minimum en maximum getallen worden aangegeven waarbinnen het getal van de bezoeker moet liggen. Ook de stapgrootte (de waarde wordt met de stapgrootte verhoogd/verlaagd mbv pijltjes in het invoerveld) kan worden opgegeven.</li><li>date; opties idem aan \'number\'.</li></ul></ul></td></tr>';
			$r.='</table></p>';
			$r.='<h4><a name="layerWMSinput">Layers van het type WMS input</a></h4>';
			$r.='<p>Bij dit type layer kan de website bezoeker klikken op de kaart om een melding te doen op dat specifieke punt. Er verschijnt een dialoog-window met de velden waarvan is opgegeven dat deze als invoer-veld moeten worden behandeld (bij de velddefinities). De overige tekst in het window, alsmede de knop-teksten en de bedank-melding kunnen onder de layer-definitie worden opgegeven.</p>';
			$r.='<h4><a name="layerVectortile">Layers van het Vector type</a></h4>';
			$r.='<p>Voor elke vector tile dienen de legenda en het uiterlijk te worden geprogrammeeerd. De programmacode wordt onder de layer-definitie ingevoerd en moet voldoen aan:<ol><li>De code start met de decalaratie van het styles object:<br><div style="margin-left: 40px;"><code>styles={<br>&nbsp;&nbsp;&nbsp;&nbsp;\'Legenda 0\': new ol.style.Style({<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fill: new ol.style.Fill({color: \'green\'}),<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;stroke: new ol.style.Stroke({color: \'red\',width: 1})<br>&nbsp;&nbsp;&nbsp;&nbsp;}),<br>&nbsp;&nbsp;&nbsp;&nbsp;\'Legenda 1\': new ol.style.Style({<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fill: new ol.style.Fill({color: \'wheat\'}),<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;stroke: new ol.style.Stroke({color: \'black\',width: 1})<br>&nbsp;&nbsp;&nbsp;&nbsp;}),<br>};</code></div></li><li>Vervolgens code waarin de variabele \'style\' wordt gezet op een waarde uit het \'styles\' object. Bijvoorbeeld:<br><div style="margin-left: 40px;"><code>style=styles[\'Legenda 0\'];</code></div></li><li>Als er meerdere stylen zijn, dat kan de variabele \'properties\' worden gebruikt om de juiste stijl te kiezen. Bijvoorbeeld:<br><div style="margin-left: 40px;"><code>if (properties.GRAY_SCALE<0.5) {<br>&nbsp;&nbsp;&nbsp;&nbsp;style=styles[\'Legenda 0\'];<br>} else {<br>&nbsp;&nbsp;&nbsp;&nbsp;style=styles[\'Legenda 1\'];<br>}</code></div><br>Het \'properties\' object bevat alle velden van een specifieke feature.</li></ol></p>';
			$r.='<h3><a name="data">Data weergave</a></h3>';
			$r.='<p>Als de bezoeker op de kaart klik, wordt voor elke laag (Zie \'Features\' bij instellingen per layer) informatie (data) over die positie opgevraagd. Op 1 positie kunnen zich meerdere features bevinden en een feature kan uit meerdere velden bestaan.<br>De aard en hoeveelheid aan data kan enorm (per klik) verschillen. Als de mogelijkheid bestaat om veel data op veel layers op te vragen, dan is het van belang om een passende keuze te maken uit onderstaande mogelijkheden.<table>';
			$r.='<tr><td>Positie data-window</td><td>Na klikken op de kaart wordt een window getoond met een driehoek aan de onderkant, die wijst naar de positie. Als er niet genoeg ruimte is om het window binnen de kaart te tonen, dan verschuift (pan) de kaart naar links onder om meer ruimte te cre&euml;ren.<br>Als er dan nog onvoldoende ruimte is dan wordt een vertikale en/of horizontale schuifbalken getoond.<br>De gebruiker kan meerdere keren achter elkaar op de kaart klikken om data op te vragen. Bij het sluiten van het window (door op \'X\' te klikken) verschuift de kaart terug naar de oorspronkelijke positie.<br><br> Bij het tonen van data worden de velddefinities gebruikt zoals deze zijn beschreven bij de layer-instellingen. Alleen de velden met een weergave-naam worden getoond. Als er geen enkel veld een wergave-naam heeft, dan worden alle velden getoond.<br><br>Als de keuze \'Indien mogelijk onder de muisklik en over de pagina\' is aangevinkt, dan wordt zonodig geprobeerd om een window te maken dat breder is dan de kaart (wel smaller dan de beschikbare ruimte op de pagina). Dit window valt dan deels over de zijkant/onderkant van de kaart.</td></tr>';
			$r.='<tr><td>Melding bij \'geen data\'</td><td>Als er geen data bekend is op de klik-locatie, dan wordt deze melding weergegeven. Als deze melding leeg is, dan wordt er geen melding getoond.</td></tr>';
			$r.='<tr><td>Ordening bij meerdere lagen/features:</td><td><ul><li>Lagen en features vertikaal; Toon alle data onder elkaar, gegroepeerd per laag en binnen de laag per feature.</li><li>Lagen horizontaal, features vertikaal; Toon alle data in een tabel. Gebruik voor elke laag een kolom en voor elke feature een rij.</li><li>Lagen vertikaal, features horizontaal; Idem, maar dan andersom.</li><li>Kruistabel Lagen horizontaal, properties vertikaal; Maak een tabel met de lagen in de eerste rij. De (unieke) veldnamen komen in de eerste kolom. De data wordt vervolgens in de juiste cel (laag, veldnaam) gezet.</li><li>Kruistabel Lagen vertikaal, properties horizontaal; idem, maar dan andersom.</li></ul></td></tr>';
			$r.='<tr><td>Toon laagnaam bij features</td><td>Soms is het van belang om de laagnaam te tonen, maar het kan ook storend werken (overbodige informatie of onnodig innemen van ruimte). Dit is vaak het geval als vooraf bekend is dat er slechts 1 feature kan zijn op een bepaalde positie. Vandaar dat de laagnaam kan worden onderdrukt.</td></tr>';
			$r.='<tr><td></td><td>';

			$r.='<b>Voorbeeld 1</b>';
			$r.='<br>Stel je hebt 2 layers met de volgende definities:<table><tr><th>Layer</th><th>Features</th><th>Veldnaam</th><th>Label</th><th>Eenheid</th></tr><tr><td>Geiten per gemeente</td><td>Altijd tonen</td><td>gemeente</td><td>Gemeente</td><td></td></tr><tr><td></td><td></td><td>count</td><td>Aantal geiten</td><td></td></tr><tr><td>Q-koorts</td><td>Altijd tonen</td><td>woonplaats</td><td>Gemeente</td><td></td></tr><tr><td></td><td></td><td>occurences</td><td>Ziektegevallen</td><td></td></tr></table>';
			$vb='<table style="flex: 1 0 180px; margin: 0 100px 0 40px;"><tr><td colspan="2"><b>Geiten per gemeente</b></td></tr><tr><td>Gemeente</td><td>Barneveld</td></tr><tr><td style="border-bottom: 1px solid gray;">Aantal Geiten</td><td style="border-bottom: 1px solid gray;">12345</td></tr><tr><td>Gemeente</td><td>Ede</td></tr><tr><td>Aantal Geiten</td><td>54321</td></tr><tr><td colspan="2"><b>Q-koorts</b></td></tr><tr><td>Gemeente</td><td>Ede</td></tr><tr><td style="border-bottom: 1px solid gray;">Ziektegevallen</td><td style="border-bottom: 1px solid gray;">12</td></tr><tr><td>Gemeente</td><td>Barneveld</td></tr><tr><td>Ziektegevallen</td><td>34</td></tr></table>';
			$r.='<div style="display: flex; margin-top: 20px;"><div style="flex: 0 1 auto;">Als de optie \'Toon laagnaam bij features\' aan staat  en de ordening op \'Lagen en features vertikaal\' en de bezoeker klikt op de kaart in de buurt van Ede, dan wordt het volgende data-window getoond:<br><br>(NB: Er zijn dus op beide layers op dat punt 2 features gevonden.)</div>'.$vb.'</div>';
			$vb='<table style="flex: 1 0 180px; margin: 0 100px 0 40px;"><tr><td colspan="2"><b>Geiten per gemeente</b></td><td colspan="2"><b>Q-koorts</b></td></tr><tr><td>Gemeente</td><td>Barneveld</td><td>Gemeente</td><td>Ede</td></tr><tr><td style="border-bottom: 1px solid gray;">Aantal Geiten</td><td style="border-bottom: 1px solid gray;">12345</td><td style="border-bottom: 1px solid gray;">Ziektegevallen</td><td style="border-bottom: 1px solid gray;">12</td></tr><tr><td>Gemeente</td><td>Ede</td><td>Gemeente</td><td>Barneveld</td></tr><tr><td>Aantal Geiten</td><td>54321</td><td>Ziektegevallen</td><td>34</td></tr></table>';
			$r.='<div style="display: flex; margin-top: 20px;"><div style="flex: 0 1 auto;">Als de ordening vervolgens op \'Lagen horizontaal en features vertikaal\' wordt gezet, dan wordt het volgende data-window getoond:</div>'.$vb.'</div>';

			$r.='<b>Voorbeeld 2</b>';
			$r.='<br>Stel je hebt 3 layers met de volgende definities:<table><tr><th>Layer</th><th>Features</th><th>Veldnaam</th><th>Label</th><th>Eenheid</th></tr><tr><td>Concentratie 2017</td><td>Altijd tonen</td><td>conc_stof_2017</td><td>2017</td><td>µg/m³</td></tr><tr><td>Concentratie 2018</td><td>Altijd tonen</td><td>conc_stof_2018</td><td>2018</td><td>µg/m³</td></tr><tr><td>Concentratie 2019</td><td>Altijd tonen</td><td>conc_stof_2019</td><td>2019</td><td>µg/m³</td></tr></table>';
			$vb='<table style="flex: 1 0 180px; margin: 0 100px 0 40px;"><tr><td>2017</td><td>15.7  µg/m³</td></tr><tr><td>2018</td><td>12.56  µg/m³</td></tr><tr><td>2019</td><td>11.3  µg/m³</td></tr></table>';
			$r.='<div style="display: flex; margin-top: 20px;"><div style="flex: 0 1 auto;">Als de optie \'Toon laagnaam bij features\' uit staat en de bezoeker klikt op de kaart, dan wordt het volgende data-window getoond:</div>'.$vb.'</div>';
			$vb='<table style="flex: 1 0 180px; margin: 0 100px 0 40px;"><tr><td colspan="2"><b>Concentratie 2017</b></td></tr><tr><td>2017</td><td>15.7  µg/m³</td></tr><tr><td colspan="2"><b>Concentratie 2018</b></td></tr><tr><td>2018</td><td>12.56  µg/m³</td></tr><tr><td colspan="2"><b>Concentratie 2019</b></td></tr><tr><td>2019</td><td>11.3  µg/m³</td></tr></table>';
			$r.='<div style="display: flex; margin-top: 20px;"><div style="flex: 0 1 auto;">Als de optie \'Toon laagnaam bij features\' aan staat en de bezoeker klikt op de kaart, dan wordt het volgende data-window getoond:<br><br>(In dit geval zou je de labels kunnen wijzigen in \'Conc. stofnaam\' o.i.d.)</div>'.$vb.'</div>';

			$r.='<b>Voorbeeld 3</b>';
			$r.='<br>Stel je hebt 3 layers met de volgende definities:<table><tr><th>Layer</th><th>Features</th><th>Veldnaam</th><th>Label</th><th>Eenheid</th></tr><tr><td>2017</td><td>Altijd tonen</td><td>conc_2017</td><td>Conc. stof µg/m³</td><td></td></tr><tr><td>2018</td><td>Altijd tonen</td><td>conc_2018</td><td>Conc. stof µg/m³</td><td></td></tr><tr><td>2019</td><td>Altijd tonen</td><td>conc_2019</td><td>Conc. stof µg/m³</td><td></td></tr></table>';
			$vb='<table style="flex: 1 0 180px; margin: 0 100px 0 40px;"><tr><td></td><td><b>Concentratie µg/m³</b></td></tr><tr><td><b>2017</b></td><td>15.7</td></tr><tr><td><b>2018</b></td><td>12.56</td></tr><tr><td><b>2019</b></td><td>11.3</td></tr></table>';
			$r.='<div style="display: flex; margin-top: 20px;"><div style="flex: 0 1 auto;">Als de optie \'Toon laagnaam bij features\' uit staat en de ordening op \'Kruistabel, Lagen verticaal en properties horizontaal\' en de bezoeker klikt op de kaart, dan wordt het volgende data-window getoond:<br><br>Omdat de 3 labels gelijk zijn, worden ze in 1 kolom geplaatst.</div>'.$vb.'</div>';

			$r.='</td></tr>';
			$r.='</table></p>';
		} else {
			// Find node id's of type gis_ol
			$nids = \Drupal::entityQuery('node')->condition('type', 'gis_ol')->execute();
			// Get nodes
			$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
			$r='<h2>Node listing</h2>';
			if ($nodes) {
				$t=0;
				foreach ($nodes as $node) {
					$r.='<div>';
					$r.='<div>Node '.$node->nid->value.': '.htmlspecialchars($node->title->value).'</div>';
					$body=$node->gis_ol_body->value;
					$body=preg_replace("/\r\n/","\r",$body);
					$body=preg_replace("/\n/","\r",$body);
					$body=explode("\r",$body);
					$ldefs=$node->gis_ol_layer_definities->value;
					$ldefs=str_replace("\r\n","\r",$ldefs);
					$ldefs=str_replace("\n","\r",$ldefs);
					$ldefs=explode("\r",$ldefs);
					$r.='<table id="gis_ol_t_'.$t.'">';
					$r.='<tr><td>Status:</td><td>'.$node->status->value.'</td></tr>';
					$r.='<tr><td>Created:</td><td>'.date('d-m-Y H:i:s',$node->created->value).'</td></tr>';
					$r.='<tr><td>Changed:</td><td>'.date('d-m-Y H:i:s',$node->changed->value).'</td></tr>';
					$parms='';
					foreach ($body as $b) {
						if ($b!='' && substr($b,0,4)!='tmp=') {
							$parms.=$b.'<br>';
						}
					}
					$r.='<tr><td>Parameters:</td><td>'.$parms.'</td></tr>';
					$parms='<table>';
					foreach ($ldefs as $ldef) {
						if ($ldef!='') {
							$ldef=explode('|',$ldef);
							$parms.='<tr><td>Type:</td><td>'.$ldef[0].'</td></tr>';
							$parms.='<tr><td>Layer:</td><td>'.$ldef[2].'</td></tr>';
							$velden=explode(',',$ldef[7]);
							$parms.='<tr><td>Field definitions:</td><td>'.implode('<br>',$velden).'</td></tr>';
						}
					}
					$parms.='</table>';
					$r.='<tr><td>Layers:</td><td>'.$parms.'</td></tr>';
					$r.='</table>';
					$r.='</div>';
					$t++;
				}
			} else {
				$r='Er zijn geen nodes van het content-type \'gis_ol\'  gevonden.';
			}
		}
		return [
//		  '#type' => 'markup',
//		  '#markup' => $r,
			'#children'=>$r,
		];
	}

}