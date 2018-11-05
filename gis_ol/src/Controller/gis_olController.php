<?php

namespace Drupal\gis_ol\Controller;

use Drupal\Core\Controller\ControllerBase;

class gis_olController extends ControllerBase {
  public function content() {
	$fname='C:\\Bitnami\\drupal-8.5.4-0\\apps\\drupal\\htdocs\\sites\\all\\modules\\gis_ol\\debug.html';
	file_put_contents($fname,date('d-m-Y H:i:s').': In controller::content<br>'.file_get_contents($fname));
	$nids = \Drupal::entityQuery('node')->condition('type', 'gis_ol')->execute();
	$nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
	$r='';
	if ($nodes) {
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
		}
	} else {
		$r='Er zijn geen nodes van het content-type \'gis_ol\'  gevonden.';
	}
    return [
      '#type' => 'markup',
      '#markup' => $r,
    ];
  }

}