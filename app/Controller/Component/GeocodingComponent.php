<?php

App::uses('Component', 'Controller');

class GeocodingComponent extends Component {

    public function get_lat_lng($address = null) {
        
        if (!empty($address)) {
            $prepAddr = str_replace(' ', '+', $address);
            $geocode = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . $prepAddr . "&sensor=false");
            $output = json_decode($geocode, true);
            if ($output['status'] == "OK") {
                $lat = $output['results'][0]['geometry']['location']['lat'];
                $lng = $output['results'][0]['geometry']['location']['lng'];
                $map_code = array("status" => "ok", "lat" => $lat, "lng" => $lng);
                return $map_code;
            } else {
                $map_code = array("status" => "zero", "lat" => "00.00", "lng" => "00.00");
                return $map_code;
            }
        } else {
            $map_code = array("status" => "zero", "lat" => "00.00", "lng" => "00.00");
            return $map_code;
        }
    }

}

?>