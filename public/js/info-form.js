/* RegExp test input patterns */
const namePattern = /(^[A-Za-z0-9]{1,25})$/;
const hobbiesPattern = /^(?:\b\w+\b[\s\r\n]*){3,250}$/;

/* Input validators */
const nameIsValid = () => namePattern.test(document.getElementById('name').value);
const hobbiesAreValid = () => hobbiesPattern.test(document.getElementById('hobbies').value);
const houseIsSelected = () => $('.select-house').val() !== '0';

/* Validates input while typing.
 * input - an input to validate;
 * validator - the function that validates the input.
 */
const validateDetailsOnType = (input, validator) => {
    input.addEventListener('keyup', () => {
        if (validator()) {
            input.classList.remove('invalid-input');
        } else {
            input.classList.add('invalid-input');
        }
    });
};

/* Adds validation event listener for name and hobbies inpus */
const validateDetailedInfo = (nameInput, hobbiesArea) => {
    nameInput.addEventListener('focusout', () => {
        if (!nameIsValid()) {
            nameInput.classList.add('invalid-input');
            validateDetailsOnType(nameInput, nameIsValid);
        }
    });
    hobbiesArea.addEventListener('focusout', () => {
        if (!hobbiesAreValid()) {
            hobbiesArea.classList.add('invalid-input');
            validateDetailsOnType(hobbiesArea, hobbiesAreValid);
        }
    });
};

/* The list of Great Houses of Westeros.
 * Indes of a house in the list complies with
 * the appropriate index of image in slider.
 */
const houses = [
    'arryn',
    'baratheon',
    'greyjoy',
    'martell',
    'lannister',
    'stark',
    'targaryen',
    'tully',
    'tyrell',
];

/* Set custom select-option (Select2) */
const setSelect = () => {
    $('.select-house').select2({
        width: '100%',
        theme: 'bootstrap4',
        minimumResultsForSearch: -1,
    });
};

/* Sets the appropriate slide on select option */
const setSelectListener = () => {
    let freeze = false;
    const $slider = $('.slider');
    $('.select-house').on('select2:select', () => {
        const selectedHouse = $('.select-house').val();
        if (selectedHouse === '0') {
            freeze = false;
            $slider.slick('slickPlay');
            /* Makes it highlighted when unselected */
            $('span.select2-container').addClass('invalid-input');
        } else {
            freeze = true;
            const houseIndex = houses.indexOf(selectedHouse);
            $slider.slick('slickPause');
            $slider.slick('slickGoTo', houseIndex);
            /* Removes highlight when selected */
            $('span.select2-container').removeClass('invalid-input');
        }
    });
};

/* jQuery functions */
$(document).ready(function () {
    setSelect();
    setSelectListener();
    const nameInput = document.getElementById('name');
    const hobbiesArea = document.getElementById('hobbies');
    const saveForm = document.forms.namedItem('save');
    validateDetailedInfo(nameInput, hobbiesArea);
    saveForm.onsubmit = (e) => {
        e.preventDefault();
        if (nameIsValid() && hobbiesAreValid() && houseIsSelected()) {
            const data = {name: nameInput.value, house: $('.select-house').val(), hobbies: hobbiesArea.value};
            $.post('index.php', data, function (result) {
                $('.content').html(result);
            });
        } else {
            if (!nameIsValid()) {
                nameInput.classList.add('invalid-input');
                validateDetailsOnType(nameInput, nameIsValid);
            }
            if (!hobbiesAreValid()) {
                hobbiesArea.classList.add('invalid-input');
                validateDetailsOnType(hobbiesArea, hobbiesAreValid);
            }
            if (!houseIsSelected()) {
                $('span.select2-container').addClass('invalid-input');
            }
        }
    };
});
