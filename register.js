document.getElementById("register-form").addEventListener("submit", function (e) {
    e.preventDefault();
  
    const idNumber = document.getElementById("idNumber").value.trim();
    const address = document.getElementById("address").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const messageBox = document.getElementById("message");
  
    if (password !== confirmPassword) {
      messageBox.style.color = "red";
      messageBox.textContent = "Passwords do not match!";
      return;
    }
  
    messageBox.style.color = "green";
    messageBox.textContent = "Registration successful!";
    console.log({ idNumber, address, mobile, email, password });
  
    e.target.reset();
  });
  
