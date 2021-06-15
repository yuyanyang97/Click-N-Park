
// Countries
var state_arr = new Array(" ","Johor","Kedah","Kelantan","Melaka","Negeri Sembilan","Pahang","Perak","Perlis","Pulau Pinang","Sabah","Sarawak","Selangor","Terengganu","Kuala Lumpur", "Putrajaya");

// States
var s_a = new Array();
s_a[0] = "";
s_a[1] = "Batu Pahat|Johor Bahru|Kluang|Kota Tinggi|Mersing|Muar|Pontian|Segamat|Kulai|Tangkak";
s_a[2] = "Baling|Bandar Bahru|Kota Setar|Kuala Muda|Kudang Pasu|Kulim|Langkawi|Padang Terap|Pendang|Pokok Sena|Sik|Yan";
s_a[3] = "Bachok|Gua Musang|Jeli|Kota Bahru|Kuala Krai|Machang|Pasir Mas|Pasir Putih|Tanah Merah|Tumpat";
s_a[4] = "Alor Gajah|Melaka Tengah|Jasin";
s_a[5] = "Jelebu|Jempol|Kuala Pilah|Port Dickson|Rembau|Seremban|Tampin";
s_a[6] = "Bentong|Bera|Cameron Highland|Kuantan|Lipis|Maran|Pekan|Raub|Rompin|Temerloh";
s_a[7] = "Batang Padang|Hilir Perak|Hulu Perak|Kampar|Kerian|Kinta|Kuala Kangsar|Larut, Matang dan Selama|Manjung|Muallim|Perak Tengah|Bagan Datoh";
s_a[8] = "Padang Besar|Kangar|Arau";
s_a[9] = "Timur Laut|Barat Daya|Seberang Perai Utara|Seberang Perai Tengah|Seberang Perai Selatan";
s_a[10] = "Kudat|Pantai Barat|Pedalaman|Sandakan|Tawau";
s_a[11] = "Betong|Bintulu|Kapit|Kuching|Limbang|Miri|Mukah|Samarahan|Sarikei|Serian|Sibu|Sri Aman";
s_a[12] = "Gombak|Hulu Langat|Hulu Selangor|Klang|Kuala Langat|Kuala Selangor|Petaling|Sabak Bernam|Sepang";
s_a[13] = "Besut|Dungun|Hulu Terengganu|Kemaman|Kuala Terengganu|Setiu|Kuala Nerus";
s_a[14] = "Kepong|Batu|Wangsa Maju|Segambut|Titiwangsa|Lembah Pantai|Bukit Bintang|Cheras|Seputeh|Bandar Tun Razak|Setiawangsa";


function populateStates(stateElementId, cityElementId) {

    var selectedCountryIndex = document.getElementById(stateElementId).selectedIndex;

    var cityElement = document.getElementById(cityElementId);

    cityElement.length = 0; // Fixed by Julian Woods
    cityElement.options[0] = new Option('Select City', '');
    cityElement.selectedIndex = 0;

    var state_arr = s_a[selectedCountryIndex].split("|");

    for (var i = 0; i < state_arr.length; i++) {
        cityElement.options[cityElement.length] = new Option(state_arr[i], state_arr[i]);
    }
    var cityElement= '<?php echo $city ?>';
    var variableToSend = 'cityElement';
    $.post('register.php', {dcity: variableToSend});
}

function populateCountries(stateElementId, cityElementId) {
    // given the id of the <select> tag as function argument, it inserts <option> tags
    var stateElement = document.getElementById(stateElementId);
    stateElement.length = 0;
    stateElement.options[0] = new Option('Select State', '-1');
    stateElement.selectedIndex = 0;
    for (var i = 0; i < state_arr.length; i++) {
        stateElement.options[stateElement.length] = new Option(state_arr[i], state_arr[i]);
    }

    // Assigned all countries. Now assign event listener for the states.

    if (cityElementId) {
        stateElement.onchange = function () {
            populateStates(stateElementId, cityElementId);
        };
    }
    var stateElement= '<?php echo $state ?>';
    var stateva = 'stateElement';
    $.post('register.php', {dstate: stateva});
}
