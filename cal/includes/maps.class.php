<?php
	/*
	* Google Maps
	* A google maps class for this project
	* Paulo Regina
	* Version 1.1 - August 2016
	* www.pauloreg.com
	*/
	
	class GoogleMaps
	{
		public function to_maps($msg)
		{
			if(stripos($msg, '[[') !== false)
			{
				preg_match_all("/\[([^\]]*)\]/", $msg, $matches);
				$rep1 = str_replace('[lat=', '', $matches[1][0]);
				$rep2 = str_replace('long=', '', $matches[1][1]);
				$coordenate = $rep1.','.$rep2;
				
				$dc = $matches[0][0].$matches[0][1].']';
				
				if(stripos($dc, 'lat') != true && stripos($dc, 'long') != true)
				{
					return $msg;
				}
				
				$find = array(',', '.', '-', ' ');
				$change = array('', '', '', '');
				
				$custom_id = 'l_'.str_replace($find, $change, $coordenate);
				
				$params = $custom_id.','.$coordenate;
	
				$result = '<div class="map-embed" id="'.$custom_id.'" rel="'.$coordenate.'"></div>';
			 	$result .= '
				<script type="text/javascript">google_maps('.$params.');</script>
				';

				$t_c = str_replace($dc, $result, $msg);
				return $t_c;
			} else {
				return $msg;	
			}
		}
	}
	
	$maps = new GoogleMaps();
	
?>