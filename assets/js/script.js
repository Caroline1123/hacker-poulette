const form = document.querySelector("#contact-form");

form.addEventListener("submit", (e) => {
  const honeypot = document.querySelector("#website");
  if (honeypot.value.length != 0) {
    /// MAKE SURE THAT THE HONEYWELL blocks submission to BE as it isn't the case right now!!!!
    return false;
  }
});
