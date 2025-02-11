<?php
/* Template Name: Skydebaner */
get_header(); // Indlæser headeren
?>


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
        <div id="map" style=""></div>

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
                    { name: 'Kalvebod bane O', lat: 55.63665677711636, lng: 12.553140596952916, type: 'Udendørs' },
                    { name: 'Frederiksberg slot', lat: 55.67144718740535,  lng: 12.525133723100435, type: 'Indendørs' },
                    { name: 'NW hjørne af Høvelte Kaserne', lat: 55.85496470438123, lng:  12.397978955668444, type: 'Indendørs' },
                    { name: 'Skive Garnison 300 meter', lat: 56.54205688692086,  lng: 9.04727317712255, type: 'Udendørs' },
                    { name: 'Skive Garnison 100 meter', lat: 56.54205688692086,  lng: 9.04727317712255, type: 'Udendørs' },
                    { name: 'Skive Garnison 25 meter', lat: 56.54205688692086, lng: 9.04727317712255, type: 'Udendørs' },
                    { name: 'Skive Garnison skarpkastningsbane', lat: 56.54205688692086, lng: 9.04727317712255, type: 'Udendørs' },
                    { name: 'Holstebro Garnison 300 meter', lat: 56.34968096143961, lng: 8.601991738845514, type: 'Udendørs' },
                    { name: 'Holstebro Garnison 50 meter', lat: 56.34968096143961, lng: 8.601991738845514, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sjælsø L1', lat: 55.865811611753244, lng: 12.406699523405578, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sjælsø L2', lat: 55.865811611753244, lng: 12.406699523405578, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sjælsø K1', lat: 55.865811611753244, lng: 12.406699523405578, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sjælsø P1', lat: 55.865811611753244, lng: 12.406699523405578, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sjælsø P2', lat: 55.865811611753244, lng: 12.406699523405578, type: 'Udendørs' },
                    { name: 'Varde Garnison 200 meter', lat: 55.60994765140869, lng: 8.470170696957881,  type: 'Udendørs' },
                    { name: 'Varde Garnison 50 meter', lat: 55.60994765140869, lng: 8.470170696957881,  type: 'Udendørs' },
                    { name: 'Varde Garnison 25 meter', lat: 55.60994765140869, lng: 8.470170696957881,  type: 'Udendørs' },
                    { name: 'Vrøgum 1', lat: 55.64687136361617, lng: 8.25557110967761, type: 'Udendørs' },
                    { name: 'Vrøgum 2', lat: 55.64687136361617, lng: 8.25557110967761, type: 'Udendørs' },
                    { name: 'Vrøgum 3', lat: 55.64687136361617, lng: 8.25557110967761, type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Risbjerg', lat: 55.89071126928729, lng: 9.109536183439694,  type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Sdr. Omme', lat: 55.82735817227213, lng: 8.974215066280802,   type: 'Udendørs' },
                    { name: 'Skydebaneanlæg Måde', lat: 55.45586481211853, lng: 8.51763105461199, type: 'Udendørs' },
                    { name: 'Hjemmeværnsskolens Skydebaneanlæg', lat: 55.817550426426735, lng: 8.196587453936294,   type: 'Udendørs' },
                    { name: 'Hyby Fælled Syd', lat: 55.5923436377233, lng: 9.778111025785602, type: 'Udendørs' },
                    { name: 'Hyby Fælled Nord', lat: 55.5923436377233, lng: 9.778111025785602, type: 'Udendørs' },
                    { name: 'Urlev', lat: 55.758164949830174, lng: 9.801074781618635, type: 'Udendørs' },
                    { name: 'St. Almstok', lat: 55.68591148877547, lng: 9.138500206527567, type: 'Udendørs' },
                    { name: 'Bredebro', lat: 55.047294850610015, lng: 8.84614546622803, type: 'Udendørs' },
                    { name: 'Søgård - Bjergskov', lat: 54.94098441574456, lng: 9.451147098770221,   type: 'Udendørs' },
                    { name: 'Gram', lat: 55.3029456920091, lng: 9.041211723009168,  type: 'Udendørs' },
                    { name: 'Søgård øvelsesterræn skarpkastningsbane', lat: 54.9630885753849, lng: 9.431114492948879,  type: 'Udendørs' },
                    { name: 'Aborg', lat: 55.30819146703765, lng: 9.90024468256763,  type: 'Udendørs' },
                    { name: 'Langesø', lat: 55.4152600821839, lng: 10.204098166252864,  type: 'Udendørs' },
                    { name: 'Ulveholm', lat: 54.90056501584439, lng: 10.329784796903263,  type: 'Udendørs' },
                    { name: 'Bøjden', lat: 55.09188206854352, lng: 10.080798439244827,  type: 'Udendørs' },
                    { name: 'Lejbølle', lat: 55.01601774591441, lng: 10.898499639239756,  type: 'Udendørs' },
                    { name: 'Gesten', lat: 55.52886950434235, lng: 9.186205954616945,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje A 200 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje B 200 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje C 200 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje A 30 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje B 30 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje C 30 meter', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje pistolbane 1', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Aalborg, Lindholm Høje pistolbane 2', lat: 57.08220773879299, lng: 9.914781197051934,  type: 'Udendørs' },
                    { name: 'Flyvestation Aalborg testskydebane', lat: 57.0978740969173, lng: 9.854235783559874,  type: 'Udendørs' },
                    { name: 'Vandstedgaard', lat: 57.44963654267334, lng: 9.957382254748634,  type: 'Udendørs' },
                    { name: 'Læsø', lat: 57.29510751229241, lng: 10.966030412409218,  type: 'Udendørs' },
                    { name: 'Svanfolk', lat: 56.844605873427994, lng: 10.084917227720593,  type: 'Udendørs' },
                    { name: 'Nr. Miler', lat: 57.12143810582962, lng: 9.240641284815982,  type: 'Udendørs' },
                    { name: 'Tolstrup', lat: 56.820675306864906, lng: 9.512976852562785,  type: 'Udendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Hanstholm', lat: 57.117869694402394, lng: 8.617767168218716,  type: 'Indendørs' },
                    { name: 'Kongsøre', lat: 55.82561658807719, lng: 11.732975372699517,  type: 'Udendørs' },
                    { name: 'Nakskov', lat: 54.81450688199441, lng: 11.138398281554931,  type: 'Udendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Byrum', lat: 57.2549391420987, lng: 11.002993110556966,  type: 'Indendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Aalborg', lat: 57.03337891200697, lng: 9.904668812391062,  type: 'Indendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Fjerritslev', lat: 57.09068737212175, lng: 9.268838968216851,  type: 'Indendørs' },
                    { name: 'Ulfborg 25 meter', lat: 56.2598583778898, lng: 8.348829437474652,  type: 'Udendørs' },
                    { name: 'Ulfborg 600 meter', lat: 56.2598583778898, lng: 8.348829437474652,  type: 'Udendørs' },
                    { name: 'Ulfborg 200 meter', lat: 56.2598583778898, lng: 8.348829437474652,  type: 'Udendørs' },
                    { name: 'Ulfborg 300 meter', lat: 56.2598583778898, lng: 8.348829437474652,  type: 'Udendørs' },
                    { name: 'Ulfborg hjortebane', lat: 56.2598583778898, lng: 8.348829437474652,  type: 'Udendørs' },
                    { name: 'Skanderborg, Stilling salonskydebaneanlæg', lat: 56.03560177954267, lng: 9.924021514595424,  type: 'Indendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Nyjels', lat: 55.35757285336255, lng: 9.198358596934032,  type: 'Indendørs' },
                    { name: 'Hjemmeværnets salonskydebaneanlæg, Gram', lat: 55.28996203033633, lng: 9.054126781586946,  type: 'Indendørs' },
                    { name: 'Rødskebølle 200 meter', lat: 55.08339012321965, lng: 10.57865172290641,  type: 'Udendørs' },
                    { name: 'Rødskebølle 25 meter', lat: 55.08339012321965, lng: 10.57865172290641,  type: 'Udendørs' },
                    { name: 'Holmens 1', lat: 55.68677414549385, lng: 12.60773408346329,  type: 'Indendørs' },
                    { name: 'Holmens 2', lat: 55.68677414549385, lng: 12.60773408346329,  type: 'Indendørs' },
                    { name: 'Skalstrup 100 meter', lat: 55.584396658590926, lng: 12.112700639278144,  type: 'Udendørs' },
                    { name: 'Skalstrup 300 meter', lat: 55.584396658590926, lng: 12.112700639278144,  type: 'Udendørs' },
                    { name: 'Hjemmeværnets skydeterræn, Karby Odde', lat: 56.54244844374565, lng: 9.041672539343443,  type: 'Terræn' },
                    { name: 'Egebaksande 200 meter', lat: 56.94767164562308, lng: 8.448724514318267,  type: 'Udendørs' },
                    { name: 'Jeghøj', lat: 56.88099662798088, lng: 8.386130370051825,  type: 'Udendørs' },
                    { name: 'Skrydstrup 200 meter', lat: 55.23897883681666, lng: 9.256583704806786,  type: 'Udendørs' },
                    { name: 'Skrydstrup 25 meter', lat: 55.23897883681666, lng: 9.256583704806786,  type: 'Udendørs' },
                    { name: 'Klosterhede', lat: 56.48994844206267, lng: 8.359748209933707,  type: 'Udendørs' },
                    { name: 'Hjøllund', lat: 56.07761004719326, lng: 9.398774539311674,  type: 'Udendørs' },
                    { name: 'Bjerringbro', lat: 56.36915409336991, lng: 9.606437979810819,  type: 'Udendørs' },
                    { name: 'Fløjstrup', lat: 56.413652116429226, lng: 10.26623550864948,  type: 'Udendørs' },
                    { name: 'Constantia', lat: 56.44965844546808, lng: 10.723793898857853,  type: 'Udendørs' },
                    { name: 'Randers Nord', lat: 56.493953838294196, lng: 10.044550885367821,  type: 'Udendørs' },
                    { name: 'Østerhede, Samsø', lat: 55.92774198390577, lng: 10.587738025884894,  type: 'Udendørs' },
                    { name: 'Timring', lat: 56.18399819131725, lng: 8.673726796990184,  type: 'Udendørs' },
                    { name: 'Dejbjerg', lat: 56.03054270498303, lng: 8.452224541130196,  type: 'Udendørs' },
                    { name: 'Munklinde', lat: 56.22340788569761, lng: 9.157893727678053,  type: 'Udendørs' },
                    { name: 'Fredericia hallen salonskydebaneanlæg', lat: 55.5773057994533, lng: 9.727640226836892,  type: 'Indendørs' },
                    { name: 'Ulfborg skyttecenter', lat: 56.25990009147494, lng: 8.348883081652847,  type: 'Udendørs' },
                    { name: 'Korsholm indendørs skydearena', lat: 55.95320522699128, lng: 8.514110939303201,  type: 'Indendørs' },
                    { name: 'Haderslev Vesterskov 200 meter', lat: 55.27979590001853, lng: 9.479655585369967,  type: 'Udendørs' },
                    { name: 'Haderslev Vesterskov 25 meter', lat: 55.27979590001853, lng: 9.479655585369967,  type: 'Udendørs' },
                    { name: 'Ådalen', lat: 55.12214554531713, lng: 14.722704486480819,  type: 'Udendørs' },
                    { name: 'Varde øvelsesplads, skarpkastningsanlæg', lat: 55.60997795090223, lng: 8.47017069695114,  type: 'Udendørs' },
                    { name: 'Radarhoved Skagens', lat: 57.743107970977405, lng: 10.602985725933378,  type: 'Udendørs' },
                    { name: 'Hanebjerg Skyttecenter, Hullet', lat: 55.87832595091432, lng: 12.238354212311938,  type: 'Udendørs' },
                    { name: 'Hanebjerg Skyttecenter, Hesteskoen', lat: 55.87832595091432, lng: 12.238354212311938,  type: 'Udendørs' },
                    { name: 'Hanebjerg Skyttecenter, Hjørnet', lat: 55.87832595091432, lng: 12.238354212311938,  type: 'Udendørs' },
                    { name: 'Hanebjerg Skyttecenter, Hulningen', lat: 55.87832595091432, lng: 12.238354212311938,  type: 'Udendørs' },
                    { name: 'Våben-Fabrikkens indendørs skydecenter', lat: 55.66477560465775, lng: 12.361967781612355,  type: 'Indendørs' },
                    { name: 'Korsør, Magleø', lat: 55.3371919967594, lng: 11.151531025768318,  type: 'Udendørs' },
                    { name: 'Forsvarets Sanitetskommando, skydecontainer', lat: 56.143842270537114, lng: 10.146949981644868,  type: 'Indendørs' },
                    { name: 'Lille tirpitz, testskydebane', lat: 55.616033436811364, lng: 8.235736680827472,  type: 'Udendørs' },
                    { name: 'Indendørs skydecontainer, Hal 5', lat: 55.62016313131112, lng: 8.237939068116207,  type: 'Indendørs' },
                    { name: 'Ørnhøj Hallen', lat: 56.20007505703409, lng: 8.56811108164872,  type: 'Indendørs' },
                    { name: 'Ulfborg L2117', lat: 56.259923927788904, lng: 8.349011827680513,  type: 'Udendørs' },
                    { name: 'Lejbølle civilskyttecenter', lat: 55.01601774591441, lng: 10.898499639239756,  type: 'Udendørs' },
                    { name: 'Feltskydebane Arktisk basisuddannelse Sandflugtsdalen', lat: 67.1669960535853, lng: -50.34691331673037,  type: 'Udendørs' },
                    { name: 'Feltskydebane Nordlandet, Nuuk', lat: 64.15520694723965, lng: -51.401600778821276,  type: 'Udendørs' },
                    { name: 'Grønnedal, Grønland', lat: 61.26682787586924, lng: -48.47964435262226,  type: 'Udendørs' },
                    { name: 'Dalgas pistolskydebane TV1', lat: 56.52688762241292, lng: 9.227882166328543,  type: 'Udendørs' },
                    { name: 'Dalgas pistolskydebane TH1', lat: 56.52688762241292, lng: 9.227882166328543,  type: 'Udendørs' },
                    { name: 'Dalgas 200 meter', lat: 56.52688762241292, lng: 9.227882166328543,  type: 'Udendørs' },
                    { name: 'Jelling salonskydebane', lat: 55.75730693857775, lng: 9.406429494564911,  type: 'Indendørs' },
                    { name: 'Raghammer terrænbane', lat: 55.62016313131112, lng: 8.237949796951845,  type: 'Terræn' },





                ];

                // Funktion til at vælge farve baseret på type
                function getMarkerColor(type) {
                    switch (type) {
                        case 'Indendørs': return 'red'; // Rød for indendørs
                        case 'Udendørs': return 'blue'; // Blå for udendørs
                        case 'Terræn': return 'green'; // Grøn for militær
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


<?php
get_footer(); // Indlæser footeren
?>
