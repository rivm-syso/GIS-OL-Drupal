# GIS-OL-Drupal
<p>The gis_ol module provides in a contenttype in Drupal which allows editors to define their own maps. The module uses Openlayers; An open source javascript library which can be used to build GIS-applications.</p>
<p>An editor can create maps with a variaty of options<ul>
	<li>Select base layers</li>
	<li>Configure additional layers</li>
	<li>Configure data filtering and - downloading</li>
	<li>Configure behaviour (zoom buttons, fulscreen button, etc.)</li>
	<li>Etc.</li>
</ul></p>

## Getting Started

### Prerequisites

<ol>
	<li>The module uses jQuery</li>
</ol>

### Installing

<ol>
	<li>Copy the files to the folder: ....drupal\htdocs\sites\all\modules\gis_ol</li>
	<li>Install the module via the admin-extend functionality.</li>
</ol>

### General use

<ol>
	<li>Add content; Choose &quot;GIS Openlayers Map&quot;.</li>
	<li>Configure the map.</li>
	<li>View the result.</li>
</ol>

### Aditional

<ul>
<li>In order to place the map as a part of a webpage, you will have to extend the contenttype &quot;Basic page&quot; (or &quot;Paragraph&quot;, or &hellip;) with a reference-field (referring to the gis_ol contenttype)</li>
<li>It is possible to add multiple maps to a webpage (or paragraph)</li>
<li>Choose &quot;GIS Openlayers module settings&quot; from the &quot;Configuration&quot; -&gt; &quot;Development&quot; section to list all maps/nodes (or use the URL: /drupal/gis_ol)</li>
</ul>


## Built With

<p>Openlayers 4.1 - 4.2<br>Proj4<br>jQuery autocomplete</p>

## Authors

Rob Beffers (SSC-Campus/RDG)