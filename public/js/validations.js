function validateRegistrationForm() {
  var nameInput = document.getElementById('name');
  var emailInput = document.getElementById('email');
  var phoneInput = document.getElementById('phone');
  var passwordInput = document.getElementById('password');

  var name = nameInput.value.trim();
  var email = emailInput.value.trim();
  var phone = phoneInput.value.trim();
  var password = passwordInput.value;

  var nameErrorContainer = document.getElementById('name-error');
  var emailErrorContainer = document.getElementById('email-error');
  var phoneErrorContainer = document.getElementById('phone-error');
  var passwordErrorContainer = document.getElementById('password-error');

  var errors = [];

  if (name.length < 3) {
    errors.push("El nombre debe tener al menos 3 caracteres.");
    nameInput.classList.add('is-invalid');
    nameErrorContainer.textContent = "El nombre debe tener al menos 3 caracteres.";
  } else {
    nameInput.classList.remove('is-invalid');
    nameErrorContainer.textContent = '';
  }

  if (!/^\d+$/.test(phone)) {
    errors.push("El teléfono solo debe contener números.");
    phoneInput.classList.add('is-invalid');
    phoneErrorContainer.textContent = "El teléfono solo debe contener números.";
  } else {
    phoneInput.classList.remove('is-invalid');
    phoneErrorContainer.textContent = '';
  }

  if (password.length < 6) {
    errors.push("La contraseña debe tener al menos 6 caracteres.");
    passwordInput.classList.add('is-invalid');
    passwordErrorContainer.textContent = "La contraseña debe tener al menos 6 caracteres.";

  } else {
    passwordInput.classList.remove('is-invalid');
    passwordErrorContainer.textContent = '';
  }

  if (errors.length > 0) {
    return false;
  }

  return true;
}
