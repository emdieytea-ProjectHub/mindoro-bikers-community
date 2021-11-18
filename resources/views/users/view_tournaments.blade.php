@extends('users.layout.app')

@section('body')
     <div class="col-lg-6">
          <div class="loadMore">
               <div class="central-meta item">
                    <div class="user-post" style="margin-top: 30px">
                         <div class="friend-info">
                              <div class="friend-name">
                                   <ins>
                                        <a href="time-line.html" title="">
                                             {{ $tournament->name }}
                                        </a>
                                   </ins>
                                   <span>published: {{ $tournament->created_at->diffForHumans() }}</span>
                              </div>
                              <div class="post-meta">
                                   <div id="map" style="width: 100%; height: 400px"></div>
                                   <div class="we-video-info">
                                        <input type="hidden" id="start" value="{{ $tournament->start }}">
                                        <input type="hidden" id="end" value="{{ $tournament->end }}">
                                        <div class="row">
                                             <div class="col-md-6">
                                                  <strong>
                                                       From:
                                                  </strong>
                                                  {{ $tournament->start }}
                                             </div>
                                             <div class="col-md-6">
                                                  <strong>
                                                       TO:
                                                  </strong>
                                                  {{ $tournament->end }}
                                             </div>
                                        </div>
                                   </div>

                              </div>
                         </div>

                    </div>
               </div>
          </div>
          <div class="central-meta item">
               <h4> Joined Participants</h4>
               <div>
                    @if ($tournament_groups <= 0)
                         <p>No Participants yet.</p>
                    @else
                         @foreach ($tournament_groups as $group)
                              <table class="table">
                                   <thead>
                                        <tr class="text-uppercase">
                                             <th colspan="3">{{ $group['group'] }}</th>
                                        </tr>
                                        <tr>
                                             <th>Name</th>
                                             <th>Age</th>
                                             <th>Address</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        @foreach ($group['members'] as $member)
                                             <tr>
                                                  <td>{{ $member['name'] }}</td>
                                                  <td>{{ $member['age'] }}</td>
                                                  <td>{{ $member['location'] }}</td>
                                             </tr>
                                        @endforeach
                                   </tbody>
                              </table>
                         @endforeach
                    @endif
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

               calculateAndDisplayRoute(directionsService, directionsRenderer);
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
