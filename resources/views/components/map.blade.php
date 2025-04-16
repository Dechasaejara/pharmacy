<!-- filepath: /home/d/coder/pharmacy/resources/views/components/map.blade.php -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
{{-- {{dd($quotations)  }} --}}
<div id="map" class="w-full h-[450px] rounded-lg shadow-lg -4"  data-quotations="{{ json_encode($quotations, JSON_HEX_APOS | JSON_HEX_QUOT ) }}"></div>