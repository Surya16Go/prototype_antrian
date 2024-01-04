/**
 * Queues
 */

'use strict';
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formValidationExamples = document.getElementById('formValidationExamples'),
      formValidationSelect2Ele = jQuery(formValidationExamples.querySelector('[name="formValidationSelect2"]')),
      formValidationTechEle = jQuery(formValidationExamples.querySelector('[name="formValidationTech"]')),
      formValidationLangEle = formValidationExamples.querySelector('[name="formValidationLang"]'),
      formValidationHobbiesEle = jQuery(formValidationExamples.querySelector('.selectpicker')),
      tech = [
        'ReactJS',
        'Angular',
        'VueJS',
        'Html',
        'Css',
        'Sass',
        'Pug',
        'Gulp',
        'Php',
        'Laravel',
        'Python',
        'Bootstrap',
        'Material Design',
        'NodeJS'
      ];

    const fv = FormValidation.formValidation(formValidationExamples, {
      fields: {
        formValidationName: {
          validators: {
            notEmpty: {
              message: 'Please enter your name'
            },
            stringLength: {
              min: 6,
              max: 30,
              message: 'The name must be more than 6 and less than 30 characters long'
            },
            regexp: {
              regexp: /^[a-zA-Z0-9 ]+$/,
              message: 'The name can only consist of alphabetical, number and space'
            }
          }
        },
        formValidationAlamat: {
          validators: {
            notEmpty: {
              message: 'Please enter your address'
            },
          }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: function (field, ele) {
            // field is the field name & ele is the field element
            switch (field) {
              case 'formValidationKeperluan':
              case 'formValidationName':
              case 'formValidationEmail':
              default:
                return '.row';
            }
          }
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            // `e.field`: The field name
            // `e.messageElement`: The message element
            // `e.element`: The field element
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
          //* Move the error message out of the `row` element for custom-options
          if (e.element.parentElement.parentElement.classList.contains('custom-option')) {
            e.element.closest('.row').insertAdjacentElement('afterend', e.messageElement);
          }
        });
      },
    }).on('core.form.valid', function () {
      // You can submit the form
      // wizardValidationForm.submit()
      // or send the form data to server via an Ajax request
      // To make the demo simple, I just placed an alert
      var formData = new FormData(formValidationExamples)
      let csrfToken = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: "http://127.0.0.1:8000/" + "queues",
        type: 'POST',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (response, status, xhr) {
          printDiv();
          toastr.success(response.message);
          $(wizardValidationForm).trigger("reset");
          $('#createSKCK').modal('hide');
          validationStepper.to(0);
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Info!',
            text: xhr.responseJSON.message,
            icon: 'info',
            customClass: {
              confirmButton: 'btn btn-info'
            }
          });
          $(wizardValidationForm).trigger("reset");
          $('#createSKCK').modal('hide');
          validationStepper.to(0);
        }
      });
    })
  })();
});