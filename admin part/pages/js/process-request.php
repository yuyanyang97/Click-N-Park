<?php
if(isset($_POST["state"])){
    // Capture selected state
    $state = $_POST["state"];

    // Define state and city array
    $stateArr = array(
                    "johor" => array("Batu Pahat","Johor Bahru","Kluang","Kota Tinggi","Mersing","Muar","Pontian","Segamat","Kulai","Tangkak"),
                    "kedah" => array("Baling","Bandar Bahru","Kota Setar","Kuala Muda","Kudang Pasu","Kulim","Langkawi","Padang Terap","Pendang","Pokok Sena","Sik","Yan"),
                    "kelantan" => array("Bachok","Gua Musang","Jeli","Kota Bahru","Kuala Krai","Machang","Pasir Mas","Pasir Putih","Tanah Merah","Tumpat"),
                    "melaka" => array("Alor Gajah","Melaka Tengah","Jasin"),
                    "ns" => array("Jelebu,Jempol,Kuala Pilah,Port Dickson,Rembau,Seremban,Tampin"),
                    "pahang" => array("Bentong","Bera","Cameron Highland","Kuantan","Lipis","Maran","Pekan","Raub","Rompin","Temerloh"),
                    "perak" => array("Batang Padang","Hilir Perak","Hulu Perak","Kampar","Kerian","Kinta","Kuala Kangsar","Larut", "Matang dan Selama","Manjung","Muallim","Perak Tengah","Bagan Datoh"),
                    "perlis" => array("Padang Besar","Kangar","Arau"),
                    "pp" => array("Timur Laut","Barat Daya","Seberang Perai Utara","Seberang Perai Tengah","Seberang Perai Selatan"),
                    "sabah" => array("Kudat","Pantai Barat","Pedalaman","Sandakan","Tawau"),
                    "sarawak" => array("Betong","Bintulu","Kapit","Kuching","Limbang","Miri","Mukah","Samarahan","Sarikei","Serian","Sibu","Sri Aman"),
                    "selangor" => array("Gombak","Hulu Langat","Hulu Selangor","Klang","Kuala Langat","Kuala Selangor","Petaling","Sabak Bernam","Sepang"),
                    "terengganu" => array("Besut","Dungun","Hulu Terengganu","Kemaman","Kuala Terengganu","Setiu","Kuala Nerus"),
                    "kl" => array("Kepong","Batu","Wangsa Maju","Segambut","Titiwangsa","Lembah Pantai","Bukit Bintang","Cheras","Seputeh","Bandar Tun Razak","Setiawangsa"),
                );

    // Display city dropdown based on state name
     ?>
    <script src="js/bootstrap.min.js"></script>
        <label class="control-label col-sm-2">City: </label>
        <div class="col-sm-10">
        <select name='dcity' required>
          <option value="">Select city</option>
    <?php
        foreach($stateArr[$state] as $value){
            echo "<option>". $value . "</option>";
        }
        echo "</select>";
        echo "</div>";

}
?>
