@php
//units=For temperature in Celsius use units=metric
//5128638 is new york ID

$url = "http://api.openweathermap.org/data/2.5/weather?zip=93955,us&lang=en&units=imperial&APPID=867e131c071180125bd88b996c21d001";

$contents = file_get_contents($url);

$clima = json_decode($contents);

$temp_now = $clima->main->temp;
$windspeed = $clima->wind->speed;
$humid = $clima->main->humidity;

$temp_max=$clima->main->temp_max;
$temp_min=$clima->main->temp_min;
$icon=$clima->weather[0]->icon;

// Icons
switch ($icon) {
   case '01d':
      $icon = "<i class='wi wi-day-sunny'></i>";
   break;

   case '01n':
      $icon = "<i class='wi wi-night-clear'></i>";
   break;

   case '02d':
      $icon = "<i class='wi wi-day-cloudy'></i>";
   break;

   case '02n':
      $icon = "<i class='wi wi-night-alt-cloudy'></i>";
   break;

   case '03d':
      $icon = "<i class='wi wi-day-cloudy'></i>";
   break;

   case '03n':
      $icon = "<i class='wi wi-night-alt-cloudy'></i>";
   break;

   case '04d':
      $icon = "<i class='wi wi-day-cloudy'></i>";
   break;

   case '04n':
      $icon = "<i class='wi wi-night-alt-cloudy'></i>";
   break;

   case '09d':
      $icon = "<i class='wi wi-day-showers'></i>";
   break;

   case '09n':
      $icon = "<i class='wi wi-night-alt-rain-mix'></i>";
   break;

   case '10d':
      $icon = "<i class='wi wi-day-rain'></i>";
   break;

   case '10n':
      $icon = "<i class='wi wi-night-alt-rain'></i>";
   break;

   case '11d':
      $icon = "<i class='wi wi-day-thunderstorm'></i>";
   break;

   case '11n':
      $icon = "<i class='wi wi-night-alt-storm-showers'></i>";
   break;

   case '13d':
      $icon = "<i class='wi wi-day-snow'></i>";
   break;

   case '13n':
      $icon = "<i class='wi wi-night-snow-wind'></i>";
   break;

   case '50d':
      $icon = "<i class='wi wi-day-haze'></i>";
   break;

   case '50n':
      $icon = "<i class='wi wi-night-fog'></i>";
   break;

   default:
      // code...
      break;
}

//how get today date time PHP :P
$cityname = $clima->name;
@endphp

@extends('layouts/master')

@section('content')

   {{-- Clock --}}
   <div class="clock">
      <p class="mb-0 time"><span id="Hour"></span><span id="Minut"></span></p>
      <p class="mb-0 period">{{  \Carbon\Carbon::now('America/Los_Angeles')->format('l, F j') }}</p>
   </div>

   {{-- Carousel --}}
   <div id="carouselFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">

         <div class="carousel-item active">
            <div class="container">
               <div class="row">

                  <div class="col-auto currentWeather">

                     <div class="container">

                        <div class="row mb-2 weatherStats">
                           <div class="col-auto pl-0 pr-2">
                              <p class="mb-0"><i class='wi wi-strong-wind'></i> @php echo ceil($windspeed); @endphp MPH</p>
                           </div>
                           <div class="col-auto pr-0 pl-2">
                              <p class="mb-0"><i class='wi wi-humidity mr-1'></i> @php echo ceil($humid); @endphp%</p>
                           </div>
                        </div>

                        <div class="row">

                           <div class="col-auto pr-2 pl-0">
                              @php
                                 echo "<span class='temp_icon'>" . $icon . "</span>";
                              @endphp
                           </div>

                           <div class="col-auto pl-2 pr-0 ml-auto">
                              @php
                                 echo "<span class='tempNow'>" . ceil($temp_now) . "&deg;F</span>";
                              @endphp
                           </div>

                        </div>
                     </div>

                  </div>

                  <div class="col-auto">

                  </div>

               </div>
            </div>
         </div>

      </div>
   </div>

@endsection

@section('footer')
   <script type="text/javascript">
      function timedMsg()
      {
         var t=setInterval("change_time();",1000);
      }
      function change_time()
      {
         var d = new Date();
         var curr_hour = d.getHours();
         var curr_min = d.getMinutes();
         var curr_period = 'AM';

         if(curr_hour > 12)
            curr_hour = curr_hour - 12;
            curr_period = 'PM';

         if(curr_min < 10)
            curr_min = '0' + curr_min;

         document.getElementById('Hour').innerHTML = curr_hour + ':';
         document.getElementById('Minut').innerHTML = curr_min;
         document.getElementById('AMPM').innerHTML = curr_period;
      }
      timedMsg();
   </script>
@endsection
