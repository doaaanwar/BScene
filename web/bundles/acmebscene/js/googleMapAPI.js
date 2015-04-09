/* googleMapAPI.js
 * 
 * This js file will contain all javascript needed for the google map API
 * reference https://developers.google.com/maps/documentation/javascript/examples/places-autocomplete-addressform
 * Revision History:
 *        24.03.2015: created, doaa elfayoumi
 */



// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initialize() {
    // Create the autocomplete object, restricting the search
    // to geographical location types.
    autocomplete = new google.maps.places.Autocomplete(
            /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});
            
    //added by doaa elfayoumi for the map, 2.04.2015       
    var markers = [];
    
    
    //added by doaa elfayoumi, 09042015 to initialize the map with the center of the area covered by the website
    var mapOptions = {
        center: new google.maps.LatLng(43.436205, -80.456445),
        zoom: 8
      };
    
    
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions
    );

    

    // When the user selects an address from the dropdown,
    // populate the address fields in the form.
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        fillInAddress();
        
        //added by doaa elfayoumi for the map, 2.04.2015    
        var place = autocomplete.getPlace();
        markers = [];
        var bounds = new google.maps.LatLngBounds();

        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
        });

        markers.push(marker);

        bounds.extend(place.geometry.location);
        

        map.fitBounds(bounds);
        
        
        //added by doaa elfayoumi, 09042015 to make the map not to much zoomed
        map.setZoom(14);
       


    });
}

// [START region_fillform]
function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
        }

    }


    //update to set some value on the create event page so it can be saved on the venue entity
    document.getElementById("lng").value = place.geometry.location;
    document.getElementById("name").value = place.name;
    document.getElementById("place_id").value = place.place_id;
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geolocation = new google.maps.LatLng(
                    position.coords.latitude, position.coords.longitude);
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}
// [END region_geolocation]
