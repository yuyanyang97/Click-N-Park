<?php
include("../connection.php");

$result = mysqli_query($conn, "select * from Driver");
$row = mysqli_fetch_assoc($result);

if(isset($_POST["state"])){
    // Capture selected state
    $state = $_POST["state"];

    // Define state and city array
    $stateArr = array(
                    "Johor" => array("Batu Pahat","Johor Bahru","Kluang","Kota Tinggi","Mersing","Muar","Pontian","Segamat","Kulai","Tangkak"),
                    "Kedah" => array("Baling","Bandar Bahru","Kota Setar","Kuala Muda","Kudang Pasu","Kulim","Langkawi","Padang Terap","Pendang","Pokok Sena","Sik","Yan"),
                    "Kelantan" => array("Bachok","Gua Musang","Jeli","Kota Bahru","Kuala Krai","Machang","Pasir Mas","Pasir Putih","Tanah Merah","Tumpat"),
                    "Melaka" => array("Alor Gajah","Melaka Tengah","Jasin"),
                    "Negeri Sembilan" => array("Jelebu,Jempol,Kuala Pilah,Port Dickson,Rembau,Seremban,Tampin"),
                    "Pahang" => array("Bentong","Bera","Cameron Highland","Kuantan","Lipis","Maran","Pekan","Raub","Rompin","Temerloh"),
                    "Perak" => array("Batang Padang","Hilir Perak","Hulu Perak","Kampar","Kerian","Kinta","Kuala Kangsar","Larut", "Matang dan Selama","Manjung","Muallim","Perak Tengah","Bagan Datoh"),
                    "Perlis" => array("Padang Besar","Kangar","Arau"),
                    "Pulau Pinang" => array("Timur Laut","Barat Daya","Seberang Perai Utara","Seberang Perai Tengah","Seberang Perai Selatan"),
                    "Sabah" => array("Kudat","Pantai Barat","Pedalaman","Sandakan","Tawau"),
                    "Sarawak" => array("Betong","Bintulu","Kapit","Kuching","Limbang","Miri","Mukah","Samarahan","Sarikei","Serian","Sibu","Sri Aman"),
                    "Selangor" => array("Gombak","Hulu Langat","Hulu Selangor","Klang","Kuala Langat","Kuala Selangor","Petaling","Sabak Bernam","Sepang"),
                    "Terengganu" => array("Besut","Dungun","Hulu Terengganu","Kemaman","Kuala Terengganu","Setiu","Kuala Nerus"),
                    "Kuala Lumpur" => array("Kepong","Batu","Wangsa Maju","Segambut","Titiwangsa","Lembah Pantai","Bukit Bintang","Cheras","Seputeh","Bandar Tun Razak","Setiawangsa"),
                );

    // Display city dropdown based on state name
    ?>
    <script src="js/bootstrap.min.js"></script>
        <div class="col-sm-10">
        <select name='editCity'>
          <option value="<?php echo $row["Driver_City"]; ?>"><?php echo $row["Driver_City"]; ?></option>
    <?php
        foreach($stateArr[$state] as $value){
            echo "<option>". $value . "</option>";
        }
        echo "</select>";
        echo "</div>";
}
?>
