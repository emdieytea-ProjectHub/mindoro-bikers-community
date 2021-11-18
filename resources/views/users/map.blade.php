@extends('users.layout.app')

@section('body')
     <div class="col-lg-9">
          <div class="central-meta"
               style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; background-color: rgb(240, 240, 240)">
               <div class="row">
                    <div class="col-md-5">
                         <div class="form-group">
                              <label>From</label>
                              <input type="text" name="start" id="start" class="form-control"
                                   style="background-color: #fff">
                         </div>
                    </div>
                    <div class="col-md-5">
                         <div class="form-group">
                              <label>To</label>
                              <input type="text" name="to" id="end" class="form-control" style="background-color: #fff">
                         </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-group">
                              <label>.</label><br>
                              <button type="button" class="btn btn-info btn-sm btn-block" id="btn-map">
                                   Search
                              </button>
                         </div>
                    </div>
               </div>

          </div><!-- add post new box -->
          <div class="">
               <div class="central-meta item"
                    style="border: 3px solid #0af5dd; border-radius:5px;  box-shadow: 10px 10px aquamarine; ">
                    <div id="map" style="width: 100%; height: 800px">

                    </div>
               </div>


          </div>
     </div>

@endsection
@push('custom-scripts')
     <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbvKUb3s8932MsFexXUuUtHaRYGc-N9ws&callback=initMap&libraries"
          async></script>

     <script>
          function initMap() {
               const directionsService = new google.maps.DirectionsService();
               const directionsRenderer = new google.maps.DirectionsRenderer();
               const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 10,
                    center: {
                         lat: 13.1999992,
                         lng: 120.8999964
                    },
               });
               directionsRenderer.setMap(map);

               $('body').on('click', '#btn-map', function() {
                    var start = $('#start').val();
                    var end = $('#end').val();

                    if (start == "" || end == "") {
                         return false;
                    } else {
                         calculateAndDisplayRoute(directionsService, directionsRenderer);
                    }
               })


          }

          function calculateAndDisplayRoute(directionsService, directionsRenderer) {
               directionsService.route({
                         origin: {
                              query: document.getElementById("start").value,
                         },
                         destination: {
                              query: document.getElementById("end").value,
                         },
                         travelMode: google.maps.TravelMode.DRIVING,
                    },
                    (response, status) => {
                         if (status === "OK") {
                              directionsRenderer.setDirections(response);
                         } else {
                              window.alert("Directions request failed due to " + status);
                         }
                    }
               );
          }
     </script>
@endpush
<!-- centerl meta -->
