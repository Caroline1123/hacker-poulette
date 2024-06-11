const form = document.querySelector("#contact-form");

form.addEventListener("submit", (e) => {
  e.preventDefault();

  // Checks if any data was submitted in honeypot field. If so, don't handle form data.
  const honeypot = document.querySelector("#website");
  if (honeypot.value.length != 0) {
    return false;
  }

  // Collect all form data into new object
  let formData = new FormData(form);
  // Send data to PHP to handle server side validation
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./assets/php/forms.php", true);

  // Handles validation response
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Response OK : form data valid after verification, display success alert
        alert("Form submitted successfully!");
        form.reset();
      } else {
        // something went wrong: display errors
        let response = JSON.parse(xhr.responseText);
        if (response.errors) {
          for (let key in response.errors) {
            let errorElement = document.getElementById(key + "-error");
            if (errorElement) {
              errorElement.innerHTML = response.errors[key];
            }
          }
        }
      }
    }
  };
  xhr.send(formData);
});
