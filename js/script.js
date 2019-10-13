/* RegExp test input patterns */
const emailPattern = /^[A-Za-z\d][\w.-]+[A-Za-z\d]@[A-Za-z\d][\w-]+[A-Za-z\d]\.[A-Za-z]{2,3}$/;
const passPattern = /^[\w!@#$%^&*()_+-=]{8,32}$/;
const namePattern = /([A-Za-z\d]+)$/;
const hobbiesPattern = /^(?:\b\w+\b[\s\r\n]*){3,250}$/;

/* Input validators */
const emailIsValid = () => emailPattern.test(document.getElementById('email').value);
const passIsValid = () => passPattern.test(document.getElementById('password').value);
const nameIsValid = () => namePattern.test(document.getElementById('name').value);
const hobbiesAreValid = () => hobbiesPattern.test(document.getElementById('hobbies').value);
const houseIsSelected = () => document.getElementById('house').value !== '0';

/* Successfully signed up message */
const afterSignUpMessage = 'Thank you for signing up and filling in information.'
        + ' But our websight is under construction yet.'
        + ' We are terribly sorry.';

/* Checks when document is ready and runs a function */
const documetIsReady = (fn) => {
  // see if DOM is already available
  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    // call on next available tick
    setTimeout(fn, 1);
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
};

/* Validates input while typing.
 * input - an input to validate;
 * validator - the function that validates the input.
 */
const validateOnType = (input, validator) => {
  input.addEventListener('keyup', () => {
    if (validator()) {
      input.classList.remove('invalid-input');
    } else {
      input.classList.add('invalid-input');
    }
  });
};

/* Adds or removes class indicating invalid input
 * to the select/option input
 */
const validateHouseIsSelected = () => {
  const houseSelect = document.getElementById('house');
  if (!houseIsSelected()) {
    houseSelect.classList.add('invalid-input');
  } else {
    houseSelect.classList.remove('invalid-input');
  }
};

/* Validates the first page */
const validateSignUp = (emailInput, passInput) => {
  emailInput.addEventListener('focusout', () => {
    if (!emailIsValid()) {
      emailInput.classList.add('invalid-input');
      validateOnType(emailInput, emailIsValid);
    }
  });
  passInput.addEventListener('focusout', () => {
    if (!passIsValid()) {
      passInput.classList.add('invalid-input');
      validateOnType(passInput, passIsValid);
    }
  });
};

/* Validates the second page */
const validateDetailedInfo = (nameInput, houseSelect, hobbiesArea) => {
  nameInput.addEventListener('focusout', () => {
    if (!nameIsValid()) {
      nameInput.classList.add('invalid-input');
      validateOnType(nameInput, nameIsValid);
    }
  });
  hobbiesArea.addEventListener('focusout', () => {
    if (!hobbiesAreValid()) {
      hobbiesArea.classList.add('invalid-input');
      validateOnType(hobbiesArea, hobbiesAreValid);
    }
  });
  houseSelect.addEventListener('change', validateHouseIsSelected);
};

/* Conceils the code related to the first page and reveals the second page,
 * if all inputs passed validation.
 */
const goForeward = () => {
  document.getElementById('first-page').style.display = 'none';
  document.getElementById('second-page').style.display = 'block';
  const nameInput = document.getElementById('name');
  const houseSelect = document.getElementById('house');
  const hobbiesArea = document.getElementById('hobbies');
  const saveButton = document.getElementById('save');
  validateDetailedInfo(nameInput, houseSelect, hobbiesArea);
  saveButton.addEventListener('click', () => {
    if (nameIsValid() && hobbiesAreValid() && houseIsSelected()) {
      alert(afterSignUpMessage);
    } else {
      if (!nameIsValid()) {
        nameInput.classList.add('invalid-input');
        validateOnType(nameInput, nameIsValid);
      }
      if (!hobbiesAreValid()) {
        hobbiesArea.classList.add('invalid-input');
        validateOnType(hobbiesArea, hobbiesAreValid);
      }
      if (!houseIsSelected()) {
        houseSelect.classList.add('invalid-input');
        houseSelect.addEventListener('change', validateHouseIsSelected);
      }
    }
  });
};

/* Shows the message about successful validation,
 * if all inputs passed validation.
 */
documetIsReady(() => {
  const emailInput = document.getElementById('email');
  const passInput = document.getElementById('password');
  const signUpButton = document.getElementById('sign-up');
  validateSignUp(emailInput, passInput);
  signUpButton.addEventListener('click', () => {
    if (emailIsValid() && passIsValid()) {
      goForeward();
    } else {
      if (!emailIsValid()) {
        emailInput.classList.add('invalid-input');
        validateOnType(emailInput, emailIsValid);
      }
      if (!passIsValid()) {
        passInput.classList.add('invalid-input');
        validateOnType(passInput, passIsValid);
      }
    }
  });
});
