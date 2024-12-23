<?php
session_start();
include 'config.php';
include 'race_manager.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Tanggal race sesuai sirkuit
$sirkuitTanggal = [
    "Sirkuit Mont-Tremblant" => "2024-02-15",
    "Sirkuit Monza" => "2024-03-10",
    "Sirkuit Mugello" => "2024-04-20",
    "Mosport International Raceway" => "2024-05-05"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->connect();
    $raceManager = new RaceManager($db);

    $name = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $class = $_POST['class'];
    $car_type = $_POST['car_type'];
    $circuit = $_POST['circuit'];
    $race_date = $sirkuitTanggal[$circuit] ?? null;

    // Gunakan metode registerRace
    $message = $raceManager->registerRace($user_id, $name, $age, $country, $class, $car_type, $circuit, $race_date);
    echo "<script>alert('$message'); window.location.href = 'dashboard.php';</script>";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Daftar Race</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <h2 class="title-daftar-race">Daftar Race</h2>
    <form class="form-daftar-race" method="POST" action="register_race.php">
        <!-- Input Nama (Readonly) -->
        <label>Nama</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly><br><br>

        <label>Umur</label><br>
        <input type="number" name="age" min="18" max="60" required><br><br>

        <label>Negara Asal</label><br>
        <input type="text" name="country" required><br><br>

        <label>Kelas Perlombaan</label><br>
        <select name="class" required>
            <option value="F1">F1</option>
            <option value="F2">F2</option>
            <option value="F3">F3</option>
            <option value="F4">F4</option>
        </select><br><br>

        <label>Jenis Mobil</label><br>
        <select name="car_type" required>
            <option value="McLaren MP4/8A 1993">McLaren MP4/8A 1993</option>
            <option value="McLaren MP4-25A 2010">McLaren MP4-25A 2010</option>
            <option value="Ferrari F2002 2002">Ferrari F2002 2002</option>
            <option value="Mercedes F1 W05 Hybrid 2014">Mercedes F1 W05 Hybrid 2014</option>
            <option value="Red Bull Racing RB9 2013">Red Bull Racing RB9 2013</option>
        </select><br><br>

        <label>Lokasi Sirkuit</label><br>
        <select name="circuit" id="circuitSelect" required>
            <option value="Sirkuit Mont-Tremblant">Sirkuit Mont-Tremblant</option>
            <option value="Sirkuit Monza">Sirkuit Monza</option>
            <option value="Sirkuit Mugello">Sirkuit Mugello</option>
            <option value="Mosport International Raceway">Mosport International Raceway</option>
        </select><br><br>

        <label>Tanggal Race</label><br>
        <input type="text" id="raceDate" name="race_date" readonly><br><br>

        <button class="btn-daftar-race" type="submit">Daftar</button>
    </form>

    <script>
        // Data tanggal race sesuai sirkuit
        const sirkuitTanggal = {
            "Sirkuit Mont-Tremblant": "2024-02-15",
            "Sirkuit Monza": "2024-03-10",
            "Sirkuit Mugello": "2024-04-20",
            "Mosport International Raceway": "2024-05-05"
        };

        // Update tanggal race berdasarkan sirkuit
        const circuitSelect = document.getElementById('circuitSelect');
        const raceDateInput = document.getElementById('raceDate');

        circuitSelect.addEventListener('change', function () {
            const selectedCircuit = circuitSelect.value;
            raceDateInput.value = sirkuitTanggal[selectedCircuit];
        });

        // Set tanggal default saat halaman dimuat
        window.addEventListener('load', () => {
            raceDateInput.value = sirkuitTanggal[circuitSelect.value];
        });
    </script>

    <script>
        // Ambil elemen form
        const formElements = document.querySelectorAll('input, select');

        // Fungsi untuk menyimpan data form ke localStorage
        formElements.forEach(element => {
            element.addEventListener('input', () => {
                localStorage.setItem(element.name, element.value);
            });
        });

        // Fungsi untuk memuat data form dari localStorage
        window.addEventListener('load', () => {
            formElements.forEach(element => {
                const savedValue = localStorage.getItem(element.name);
                if (savedValue) {
                    element.value = savedValue;
                }
            });
        });
    </script>

</body>
</html>
