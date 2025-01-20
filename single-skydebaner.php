<?php
/* Template Name: Skydebaner */
get_header(); // Indlæser headeren
?>

<div class="content">

    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('<?php echo esc_url(get_field('hero_image')); ?>');">
        <div class="hero-text">
            <h1><?php echo esc_html(get_field('hero_text')); ?></h1>
        </div>
    </div>

    <div class="map-container">
        <!-- Venstre kolonne -->
        <div class="text-content">
            <h2><?php echo esc_html(get_field('map_title')); ?></h2>
            <p><?php echo esc_html(get_field('map_description')); ?></p>
            <ul>
                <li>Rød markerer indendørs skydebaner, hvor der trænes under beskyttede forhold.</li>
                <li>Blå viser udendørs skydebaner, der giver mulighed for træning i åbne omgivelser.</li>
                <li>Grøn indikerer terrænskydebaner, som er designet til at simulere realistiske forhold i naturlige landskaber.</li>
            </ul>
        </div>

        <!-- Højre kolonne (kortet) -->
        <div id="map" style="height: 500px;"></div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Opret kortet
                var map = L.map('map').setView([56, 10], 7); // Midten af Danmark

                // Tilføj OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Skydebane data med typer
                var ranges = [
                    { name: 'Skydebane A', lat: 55.6761, lng: 12.5683, type: 'Indendørs' },
                    { name: 'Skydebane B', lat: 57.0467, lng: 9.9359, type: 'Udendørs' },
                    { name: 'Skydebane C', lat: 56.1629, lng: 10.2039, type: 'Militær' }
                ];

                // Funktion til at vælge farve baseret på type
                function getMarkerColor(type) {
                    switch (type) {
                        case 'Indendørs': return 'red'; // Rød for indendørs
                        case 'Udendørs': return 'blue'; // Blå for udendørs
                        case 'Militær': return 'green'; // Grøn for militær
                        default: return 'gray'; // Standardfarve
                    }
                }

                // Tilføj farvede markører
                ranges.forEach(function (range) {
                    var color = getMarkerColor(range.type); // Hent farven baseret på typen

                    L.circleMarker([range.lat, range.lng], {
                        color: color,         // Kantens farve
                        fillColor: color,     // Udfyldningsfarve
                        fillOpacity: 0.8,     // Gennemsigtighed
                        radius: 8             // Størrelse på cirklen
                    }).addTo(map)
                      .bindPopup(`<strong>${range.name}</strong><br>Type: ${range.type}`);
                });
            });
        </script>
    </div>

</div>

<?php
get_footer(); // Indlæser footeren
?>
