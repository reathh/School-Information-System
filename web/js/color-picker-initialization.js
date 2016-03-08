$(document).ready(function ($) {
    var inputField = $('#information_entry_contentColor');
    var colorPickerOptions = {
        onChange: function (hsb, hex, rgb) {
            inputField.val('#' + hex);
        }
    };

    inputField.ColorPicker(colorPickerOptions);
    if (inputField.val()) {
        inputField.ColorPickerSetColor(inputField.val().substr(1));
        console.log(inputField.val().substr(1));
    }
});