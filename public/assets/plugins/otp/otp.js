const inputs        = document.querySelectorAll("input[data-type=otp]");
const button        = document.querySelector("button");
const code_field    = document.querySelector("input[name=code]");

// iterate over all inputs
inputs.forEach((input, index1) => {
    input.addEventListener('keydown', function(e) {

        // Left Arrow or Right Arrow
        if(e["which"] === 38 || e["which"] === 40)
            e.preventDefault();

        // Up Arrow or Down Arrow
        if(e["which"] === 37 || e["which"] === 39){}
    });
    input.addEventListener("keyup", (e) => {
            const currentInput  = input;
            const nextInput     = input.nextElementSibling;
            const prevInput     = input.previousElementSibling;
            // if the value has more than one character then clear it
            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            // if the next input is disabled and the current value is not empty, enable the next input and focus on it
            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            // if the backspace key is pressed
            if (e.key === "Backspace") {
                // iterate over all inputs again
                inputs.forEach((input, index2) => {
                    // if the index1 of the current input is less than or equal to the index2 of the input in the outer loop and the previous element exists, set the disabled attribute on the input and focus on the previous element
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", 'true');
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }
            // if the last input( which index number is 4) is not empty and has not disable attribute then remove disabled attribute if not then remove the disabled attribute.
            if (!inputs[4].disabled && inputs[4].value !== "") {
                code_field.value = '';
                button.removeAttribute("disabled");
                inputs.forEach(function(node) {
                    code_field.value = code_field.value+node.value;
                    //console.log(node.value);
                });
                document.querySelector('#verify_email_form_submit').click();
                return;
            }
            button.setAttribute("disabled",'true');
  });
    input.addEventListener("paste", (e) => {
        e.preventDefault();
        let paste_data = e.clipboardData.getData("text");
        // If paste data is unsigned number
        if (paste_data.match(/^\d+$/))
        {
            let paste_data_splitted = paste_data.split("");
            $.each(paste_data_splitted, function (index, value) {
                inputs[index].value = value;
                inputs[index].removeAttribute("disabled");
            });
        }
    });
});

//focus the first input which index is 0 on window load
window.addEventListener("load", () => inputs[0].focus());




// $(document).ready(function () {
//   $(".otp-form input[type=number]:first").focus();
//   let otp_fields        = $(".otp-form input[type=number]");
//   let otp_value_field   = $(".otp-form .otp-value");
//   let opt_value         = "";
//
//   otp_fields.on("input", function (e) {
//       // Force input to accept numbers only
//       $(this).val($(this).val().replace(/[^0-9]/g, ""));
//       })
//       .on("keyup", function (e) {
//           let key = e.keyCode || e.charCode;
//           // Backspace or Delete or Left Arrow or Down Arrow
//           if (key === 8 || key === 46 || key === 37 || key === 40) {
//               $(this).attr('disabled',true)
//               $(this).prev().focus();
//           }
//           // Right Arrow or Top Arrow or Value not empty
//           else if (key === 38 || key === 39 || $(this).val() !== "") {
//               $(this).next().removeAttr('disabled').focus();
//           }
//       })
//       .on("paste", function (e) {
//         let paste_data = e.originalEvent.clipboardData.getData("text");
//         let paste_data_splitted = paste_data.split("");
//         $.each(paste_data_splitted, function (index, value) {
//           otp_fields.eq(index).val(value);
//         });
//       });
// });


