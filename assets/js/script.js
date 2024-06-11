const form = document.querySelector("#contact-form");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  // Clear all alerts in the form.
  let errors = document.querySelectorAll(".error");
  for (let error of errors) {
    error.classList.remove("alert-warning");
    error.classList.remove("alert");
    error.classList.remove("mt-1");
    error.classList.remove("p-1");
    error.innerHTML = "";
  }

  // Checks if any data was submitted in honeypot field. If so, don't handle form data.
  const honeypot = document.querySelector("#website");
  if (honeypot.value.length != 0) {
    return false;
  }

  // Collect all form data into new object
  let formData = new FormData(form);

  // Send data to PHP to handle server-side validation
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./assets/php/forms.php", true);

  // Handles validation response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let response = JSON.parse(xhr.responseText);
        console.log(response);

        // Response OK: form data valid after verification, display success alert
        if (!response.valid) {
          for (let key in response.errors) {
            let errorElement = document.getElementById(key + "-error");
            if (errorElement) {
              errorElement.innerHTML = response.errors[key];
              errorElement.classList.add("alert-warning");
              errorElement.classList.add("alert");
              errorElement.classList.add("mt-1");
              errorElement.classList.add("p-1");
            }
          }
        } else {
          alert("Form submitted successfully!");
          form.reset();
        }
      } else {
        console.error("Form submission failed with status: " + xhr.status);
      }
    }
  };

  xhr.send(formData);
});
