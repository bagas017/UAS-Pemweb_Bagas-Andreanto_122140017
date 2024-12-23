document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById('loginForm');
    const loginPasswordInput = document.getElementById('loginPassword');
    const loginErrorMsg = document.getElementById('loginErrorMsg');
    const loginEmailInput = document.getElementById('loginEmail');
    const registerSection = document.getElementById('registerSection');
    const loginSection = document.getElementById('loginSection');

    // Event 1: Validasi panjang password
    loginPasswordInput.addEventListener('input', function () {
        if (loginPasswordInput.value.length < 8) {
            loginErrorMsg.textContent = "Password harus minimal 8 karakter.";
        } else {
            loginErrorMsg.textContent = "";
        }
    });

    // Event 2: Validasi format email
    loginEmailInput.addEventListener('blur', function () {
        if (!loginEmailInput.value.includes('@')) {
            loginErrorMsg.textContent = "Masukkan email yang valid.";
        } else {
            loginErrorMsg.textContent = "";
        }
    });

    // Event 3: Validasi saat form dikirim
    loginForm.addEventListener('submit', function (e) {
        if (loginPasswordInput.value.length < 8) {
            e.preventDefault();
            loginErrorMsg.textContent = "Password harus minimal 8 karakter.";
        } else if (!loginEmailInput.value.includes('@')) {
            e.preventDefault();
            loginErrorMsg.textContent = "Masukkan email yang valid.";
        }
    });

    // Deteksi status dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const loginStatus = urlParams.get('error');
    const successStatus = urlParams.get('success');

    // Tampilkan pesan berdasarkan status dengan overlay
    if (loginStatus === 'invalid_email' || loginStatus === 'invalid_password') {
        // Buat layer overlay
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = 0;
        overlay.style.left = 0;
        overlay.style.width = '100vw';
        overlay.style.height = '100vh';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        overlay.style.color = 'white';
        overlay.style.display = 'flex';
        overlay.style.justifyContent = 'center';
        overlay.style.alignItems = 'center';
        overlay.style.zIndex = 9999;
        overlay.innerHTML = `<div style="text-align: center;">
                                <h2>${loginStatus === 'invalid_email' ? 'Login gagal: Email tidak ditemukan.' : 'Login gagal: Password salah.'}</h2>
                                <button id="closeOverlay" style="margin-top: 20px; padding: 10px 20px; font-size: 16px;">Tutup</button>
                             </div>`;
        document.body.appendChild(overlay);

        // Tambahkan event untuk tombol tutup overlay
        document.getElementById('closeOverlay').addEventListener('click', () => {
            overlay.remove();
        });
    } else if (successStatus === 'true') {
        alert("Login berhasil!");
    }
});
