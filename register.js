const registerForm = document.getElementById('registerForm');
const registerPasswordInput = document.getElementById('password');
const registerConfirmPasswordInput = document.getElementById('confirmPassword');
const registerErrorMsg = document.getElementById('errorMsg');


// Event 1: Validasi panjang password
registerPasswordInput.addEventListener('input', function () {
    if (registerPasswordInput.value.length < 8) {
        registerErrorMsg.textContent = "Password harus minimal 8 karakter.";
    } else {
        registerErrorMsg.textContent = "";
    }
});

// Event 2: Validasi kesesuaian password dan konfirmasi
registerConfirmPasswordInput.addEventListener('input', function () {
    if (registerConfirmPasswordInput.value !== registerPasswordInput.value) {
        registerErrorMsg.textContent = "Password dan konfirmasi tidak cocok.";
    } else {
        registerErrorMsg.textContent = "";
    }
});

// Event 3: Validasi saat form dikirim
registerForm.addEventListener('submit', function (e) {
    if (registerPasswordInput.value.length < 8) {
        e.preventDefault();
        registerErrorMsg.textContent = "Password harus minimal 8 karakter.";
    } else if (registerConfirmPasswordInput.value !== registerPasswordInput.value) {
        e.preventDefault();
        registerErrorMsg.textContent = "Password dan konfirmasi tidak cocok.";
    } else {
        alert("Registrasi berhasil!");
    }
});
