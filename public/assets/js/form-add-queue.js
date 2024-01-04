/**
 *  Form Wizard
 */

'use strict';

function printDiv() {
  var a = window.open('http://127.0.0.1:8000/queue/print', '', 'height=500, width=500');
  a.document.getElementsByTagName('body')[0].setAttribute('style', 'width: 58mm;');
  a.document.execCommand('print', false, null);
  a.document.querySelectorAll('header,footer').forEach(function (item) {
    item.style.display = 'none';
  });
  a.print();
  setTimeout(function () {
    a.close();
  }, 1000);
}

(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker');

  // Wizard Validation
  // --------------------------------------------------------------------
  const wizardValidation = document.querySelector('#wizard-validation');
  if (typeof wizardValidation !== undefined && wizardValidation !== null) {
    // Wizard form
    const wizardValidationForm = wizardValidation.querySelector('#wizard-validation-form');
    // Wizard steps
    const wizardValidationFormStep1 = wizardValidationForm.querySelector('#account-details-validation');
    const wizardValidationFormStep2 = wizardValidationForm.querySelector('#personal-info-validation');
    // Wizard next prev button
    const wizardValidationNext = [].slice.call(wizardValidationForm.querySelectorAll('.btn-next'));
    const wizardValidationPrev = [].slice.call(wizardValidationForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardValidation, {
      linear: true
    });

    // Account details
    const FormValidation1 = FormValidation.formValidation(wizardValidationFormStep1, {
      fields: {
        passFoto: {
          validators: {}
        },
        fcKTP: {
          validators: {}
        },
        fcKK: {
          validators: {}
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Personal info
    const FormValidation2 = FormValidation.formValidation(wizardValidationFormStep2, {
      fields: {
        keperluan: {
          validators: {
            notEmpty: {
              message: 'Keperluan tidak boleh kosong.'
            }
          }
        },
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // You can submit the form
      // wizardValidationForm.submit()
      // or send the form data to server via an Ajax request
      // To make the demo simple, I just placed an alert
      var formData = new FormData(wizardValidationForm)
      let csrfToken = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: "http://127.0.0.1:8000/" + "queue",
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
    });

    wizardValidationNext.forEach(item => {
      item.addEventListener('click', event => {
        // When click the Next button, we will validate the current step
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;

          case 1:
            FormValidation2.validate();
            break;

          default:
            break;
        }
      });
    });

    wizardValidationPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {

          case 1:
            validationStepper.previous();
            break;

          case 0:

          default:
            break;
        }
      });
    });
  }
})();
