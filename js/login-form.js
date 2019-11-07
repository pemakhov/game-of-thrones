/* RegExp test input patterns */
const emailPattern = /^[A-Za-z\d][\w.-]+[A-Za-z\d]@[A-Za-z\d][\w-]+[A-Za-z\d]\.[A-Za-z]{2,3}$/;
const passPattern = /^[\w!@#$%^&*()_+-=]{8,32}$/;

/* Input validators */
const emailIsValid = () => emailPattern.test(document.getElementById('email').value);
const passIsValid = () => passPattern.test(document.getElementById('password').value);

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

/* Sets slider */
const setSlider = () => {
    $('.slider').slick({
        dots: false,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        waitForAnimate: false,
    });
};

/* jQuery functions */
$(document).ready(function () {
    setSlider();
    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');
    // const signUpForm = document.getElementById('sign-up');
    const signUpForm = document.forms.namedItem('sign-up');
    // validateSignUp(emailInput, passInput);
    signUpForm.onsubmit = (e) => {
        e.preventDefault();
        if (emailIsValid() && passIsValid()) {
            const data = new FormData(signUpForm),
                request = new XMLHttpRequest();
            request.open('POST', location.pathname, true);
            request.send(data);
            location.reload();
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
    };
});
