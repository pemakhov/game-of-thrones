/* RegExp test input patterns */
const emailPattern = /^[A-Za-z\d][\w.-]+[A-Za-z\d]@[A-Za-z\d][\w-]+[A-Za-z\d]\.[A-Za-z]{2,3}$/;
const passPattern = /^[\w!@#$%^&*()_+-=]{8,32}$/;

/* Input validators */
const validateEmail = (email) => emailPattern.test(email);
const validatePass = (pass) => passPattern.test(pass);

/* Conceils the code related to the first page and reveals the second page */
const goForeward = () => {
  document.getElementById('first-page').style.display = 'none';
  document.getElementById('second-page').style.display = 'block';
};

/* Highlights the fields that are filled in wrongly
 * When all fields are filled in correctly, goes to
 * the second page.
 */
const validateSignUp = () => {
  const isValidEmail = validateEmail(document.getElementById('email').value);
  const isValidPass = validatePass(document.getElementById('password').value);
  if (isValidEmail && isValidPass) {
    goForeward();
  } else {
    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');
    if (!isValidEmail) {
      emailInput.classList.add('invalid-input');
    }
    if (!isValidPass) {
      passInput.classList.add('invalid-input');
    }
    emailInput.addEventListener('focusin', () => {
      emailInput.classList.remove('invalid-input');
    });
    passInput.addEventListener('focusin', () => {
      passInput.classList.remove('invalid-input');
    });
    emailInput.addEventListener('focusout', () => {
      if (!validateEmail(document.getElementById('email').value)) emailInput.classList.add('invalid-input');
    });
    passInput.addEventListener('focusout', () => {
      if (!validatePass(document.getElementById('password').value)) passInput.classList.add('invalid-input');
    });
  }
};
