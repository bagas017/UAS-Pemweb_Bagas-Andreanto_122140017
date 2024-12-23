<?php
class RaceManager {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    // Metode 1: Mendaftarkan race
    public function registerRace($user_id, $name, $age, $country, $class, $car_type, $circuit, $race_date) {
        $query = "INSERT INTO race_registration (user_id, name, age, country, class, car_type, circuit, race_date) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('isisssss', $user_id, $name, $age, $country, $class, $car_type, $circuit, $race_date);
        if ($stmt->execute()) {
            return "Pendaftaran berhasil untuk $name.";
        } else {
            return "Gagal mendaftar: " . $stmt->error;
        }
    }

    // Metode 2: Mengambil detail race berdasarkan ID
    public function getRaceDetails($id) {
        $query = "SELECT * FROM race_registration WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
