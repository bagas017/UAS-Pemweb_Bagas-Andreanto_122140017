<?php
session_start();
include 'config.php'; // Pastikan file config.php di-include

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

// Buat koneksi database menggunakan class Database
$db = (new Database())->connect();

// Ambil data berdasarkan ID
$id = $_GET['id'];
$query = "SELECT * FROM race_registration WHERE id = ?";
$stmt = $db->prepare($query); // Gunakan $db, bukan $conn
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name']; // Nama tidak dapat diubah
    $age = $_POST['age'];
    $country = $_POST['country'];
    $class = $_POST['class'];
    $car_type = $_POST['car_type'];
    $circuit = $_POST['circuit'];
    $race_date = $sirkuitTanggal[$circuit] ?? null;

    $updateQuery = "UPDATE race_registration SET age = ?, country = ?, class = ?, car_type = ?, circuit = ?, race_date = ? WHERE id = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param('isssssi', $age, $country, $class, $car_type, $circuit, $race_date, $id);
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "<script>alert('Gagal mengupdate data.'); window.location.href = 'update.php?id=$id';</script>";
    }
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Race</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>
<body>
    <h2 class="title-update-race">Update Race</h2>
    <form class="form-update-race" method="POST" action="update.php?id=<?php echo $id; ?>">
        <!-- Input Nama (Readonly) -->
        <label>Nama</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($data['name']); ?>" readonly><br><br>

        <label>Umur</label><br>
        <input type="number" name="age" min="18" max="60" value="<?php echo htmlspecialchars($data['age']); ?>" required><br><br>

        <label>Negara Asal</label><br>
        <input type="text" name="country" value="<?php echo htmlspecialchars($data['country']); ?>" required><br><br>

        <label>Kelas Perlombaan</label><br>
        <select name="class" required>
            <option value="F1" <?php if ($data['class'] === 'F1') echo 'selected'; ?>>F1</option>
            <option value="F2" <?php if ($data['class'] === 'F2') echo 'selected'; ?>>F2</option>
            <option value="F3" <?php if ($data['class'] === 'F3') echo 'selected'; ?>>F3</option>
            <option value="F4" <?php if ($data['class'] === 'F4') echo 'selected'; ?>>F4</option>
        </select><br><br>

        <label>Jenis Mobil</label><br>
        <select name="car_type" required>
            <option value="McLaren MP4/8A 1993" <?php if ($data['car_type'] === 'McLaren MP4/8A 1993') echo 'selected'; ?>>McLaren MP4/8A 1993</option>
            <option value="McLaren MP4-25A 2010" <?php if ($data['car_type'] === 'McLaren MP4-25A 2010') echo 'selected'; ?>>McLaren MP4-25A 2010</option>
            <option value="Ferrari F2002 2002" <?php if ($data['car_type'] === 'Ferrari F2002 2002') echo 'selected'; ?>>Ferrari F2002 2002</option>
            <option value="Mercedes F1 W05 Hybrid 2014" <?php if ($data['car_type'] === 'Mercedes F1 W05 Hybrid 2014') echo 'selected'; ?>>Mercedes F1 W05 Hybrid 2014</option>
            <option value="Red Bull Racing RB9 2013" <?php if ($data['car_type'] === 'Red Bull Racing RB9 2013') echo 'selected'; ?>>Red Bull Racing RB9 2013</option>
        </select><br><br>

        <label>Lokasi Sirkuit</label><br>
        <select name="circuit" id="circuitSelect" required>
            <?php foreach ($sirkuitTanggal as $circuit => $date): ?>
                <option value="<?php echo $circuit; ?>" <?php if ($data['circuit'] === $circuit) echo 'selected'; ?>>
                    <?php echo $circuit; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Tanggal Race</label><br>
        <input type="text" id="raceDate" name="race_date" value="<?php echo htmlspecialchars($data['race_date']); ?>" readonly><br><br>

        <button class="btn-update-race" type="submit">Update</button>
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
    </script>
</body>
</html>
