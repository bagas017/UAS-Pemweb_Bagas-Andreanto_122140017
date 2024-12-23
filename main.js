document.addEventListener("DOMContentLoaded", () => {
    // Ambil elemen tombol dan form
    const btnRegister = document.getElementById('btnRegister');
    const btnLogin = document.getElementById('btnLogin');
    const registerSection = document.getElementById('registerSection');
    const loginSection = document.getElementById('loginSection');

    // Sembunyikan semua form saat halaman dimuat
    registerSection.style.display = 'none';
    loginSection.style.display = 'none';

    // Event klik untuk tombol Register
    btnRegister.addEventListener('click', () => {
        registerSection.style.display = 'block';
        loginSection.style.display = 'none';
    });

    // Event klik untuk tombol Login
    btnLogin.addEventListener('click', () => {
        loginSection.style.display = 'block';
        registerSection.style.display = 'none';
    });
});
