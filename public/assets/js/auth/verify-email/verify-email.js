"use strict";

/* ===== Add By Sayed - Start ===== */
// This config makes laravel to recognize $request->ajax()
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/* ===== Add By Sayed - End ===== */

// Class Definition
let verifyEmail = function () {
    // Elements
    let form;
    let submitButton;

    let handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            // Show loading indication
            submitButton.setAttribute('data-kt-indicator', 'on');

            // Disable button to avoid multiple click
            submitButton.disabled = true;
            //let params = new URLSearchParams(new FormData(form)).toString();
            console.log(new FormData(form));
                    // Check axios library docs: https://axios-http.com/docs/intro
            axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                if (response) {
                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Confirmed. please wait...",
                        icon: "success",
                        showConfirmButton: false,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    let redirectUrl = response.data.redirectBackURL;
                    if (redirectUrl) {
                        setTimeout(function () {
                            location.href = redirectUrl;
                        },500);
                    }
                }
            }).catch(function (error) {
                Swal.fire({
                    text: "Sorry, Your email verification code is invalid.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
                // Enable button
                submitButton.disabled = false;
            }).then(() => {
                // Hide loading indication
                submitButton.removeAttribute('data-kt-indicator');


            });


        });
    }


    // Public Functions
    return {
        // public functions
        init: function () {
            form = document.querySelector('#verify_email_form');
            submitButton = document.querySelector('#verify_email_form_submit');
            handleSubmitAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    verifyEmail.init();
});
