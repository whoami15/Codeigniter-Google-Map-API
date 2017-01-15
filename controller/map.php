<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

    var $template = 'template';

    public function __construct() {
            parent::__construct();
           
            $this->load->library('googlemaps');
            $this->load->model('Mapmodel');

      

    }

    public function index() {
        $data['title'] = 'Crime Map';
        $config = array();
        $config['center'] = '12.900000, 121.0793705';
        $config['zoom'] = '9';
        $config['places'] = TRUE;
        $config['placesAutocompleteInputID'] = 'myPlaceSearch';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = "markers_map[0].setVisible(false);
        var place = placesAutocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
            map.setZoom(15);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);
        }

        markers_map[0].setPosition(place.geometry.location);
        markers_map[0].setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''), (place.address_components[1] && place.address_components[1].short_name || ''), (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }";


        $this->googlemaps->initialize($config);
        // initialize the map
        $this->googlemaps->initialize($config);

        // get the markers, loop through the markers and add them to the map
        $infoMarkers = $this->Mapmodel->get_map();
        foreach ($infoMarkers as $infoMarker) {
            $marker = array();
            $marker['position'] = $infoMarker->crimeLat.",".$infoMarker->crimeLong;
            $marker['infowindow_content'] = $infoMarker->crimeDate.",<br>".$infoMarker->crimeLoc.",<br>".$infoMarker->crimeDesc;

            $marker['icon'] = $infoMarker->crimeIcon;
        $this->googlemaps->add_marker($marker);
         
        }

        // create the map with added markers
        $data['map'] = $this->googlemaps->create_map();

        $data['content'] = 'map/index';
        $this->load->view($this->template,$data);



    }

}

?>
