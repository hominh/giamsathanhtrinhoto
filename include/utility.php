<?php
	function loadObjectList( $result ) {        
		$array = array();
		if ($result && mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_object( $result )) {
			    $array[] = $row;
			}
			mysql_free_result( $result );			
		}
		return $array;
	}

	function distanceGeoPoints ($lat1, $lng1, $lat2, $lng2) {
		$earthRadius = 6371;
		$dLat = deg2rad($lat2-$lat1);
		$dLng = deg2rad($lng2-$lng1);
		$a = sin($dLat/2) * sin($dLat/2) +
		cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
		sin($dLng/2) * sin($dLng/2);
		$c = 2 * atan2(sqrt($a), sqrt(1-$a));
		$dist = $earthRadius * $c;
		return $dist;
	}

?>