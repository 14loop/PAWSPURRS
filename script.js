document.addEventListener('DOMContentLoaded', () => {
  // Log In Modal Elements
  const loginModal = document.getElementById('loginModal'); // Modal element
  const loginOpenButton = document.querySelector('.login-btn'); // Button to open the modal
  const loginSubmitButton = document.getElementById('loginButton'); // Login button inside modal
  const closeLoginModal = document.querySelector('.login-close'); // Modal close button

  // Ensure the Login Modal elements exist before adding listeners
  if (loginModal) {
      // Handle Opening the Login Modal
      if (loginOpenButton) {
          loginOpenButton.addEventListener('click', () => {
              loginModal.style.display = 'block'; // Show the modal
          });
      }
  // Handle Login Modal Logic
  if (loginButton && loginModal && loginModal) {
    loginButton.onclick = () => { loginModal.style.display = 'block'; };
    closeLoginModal.onclick = () => { LoginModal.style.display = 'none'; };
    window.onclick = (event) => {
        if (event.target === loginModal) loginModal.style.display = 'none';
    };
}
// Show login modal if redirected
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get("view") === "login") {
    document.getElementById("loginModal").style.display = "block";
}

const message = urlParams.get("message");
if (message === "not_logged_in") {
    alert("You must log in to access this page.");
}


      // Handle Closing the Login Modal
      if (closeLoginModal) {
          closeLoginModal.addEventListener('click', () => {
              loginModal.style.display = 'none'; // Close the modal on clicking the X
          });
      }

      // Handle clicking outside the modal to close it
      window.addEventListener('click', (event) => {
          if (event.target === loginModal) {
              loginModal.style.display = 'none';
          }
      });

      // AJAX Login Submission
const submitLogin = document.getElementById('submitLogin');
if (submitLogin) {
    submitLogin.addEventListener('click', function (e) {
        e.preventDefault();

              // Get login inputs
              const email = document.getElementById('loginEmail')?.value.trim();
              const password = document.getElementById('loginPassword')?.value.trim();

              // Validate inputs
              if (!email || !password) {
                  alert("Please enter both email and password.");
                  return;
              }

              const formData = { email, password };

              // Send AJAX request
              fetch('/wwwroot/login.php', {
                  method: 'POST',
                  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                  body: new URLSearchParams(formData)
              })
                  .then(response => response.text())
                  .then(data => {
                      if (data.toLowerCase().includes('login successful')) {
                          alert('Login successful! Redirecting...');
                          window.location.href = 'appointments.php'; // Redirect on success
                      } else {
                          alert(data); // Show server response for errors
                      }
                  })
                  .catch(error => {
                      console.error('Error:', error);
                      alert('An error occurred during login. Please try again later.');
                  });
          });
      }
  } else {
      console.error("Login modal not found in the DOM.");
  }

  // Register Modal Elements
  const registerModal = document.getElementById('registerModal');
  const registerButton = document.querySelector('.register-btn');
  const closeRegisterModal = document.querySelector('.register-close');

  // Handle Register Modal Logic
  if (registerButton && registerModal && closeRegisterModal) {
      registerButton.onclick = () => { registerModal.style.display = 'block'; };
      closeRegisterModal.onclick = () => { registerModal.style.display = 'none'; };
      window.onclick = (event) => {
          if (event.target === registerModal) registerModal.style.display = 'none';
      };
  }

  // AJAX Registration Submission
  const submitRegistration = document.getElementById('submitRegistration');
  if (submitRegistration) {
      submitRegistration.addEventListener('click', function (e) {
          e.preventDefault();

          const formData = {
              firstname: document.getElementById('firstname').value.trim(),
              lastname: document.getElementById('lastname').value.trim(),
              email: document.getElementById('email').value.trim(),
              phonenumber: document.getElementById('phonenumber').value.trim(),
              password: document.getElementById('password').value.trim(),
          };

          // Validate form inputs
          for (const key in formData) {
              if (!formData[key]) {
                  alert(`Please fill in the ${key} field.`);
                  return;
              }
          }

          fetch('/wwwroot/register.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: new URLSearchParams(formData)
          })
              .then(response => response.text())
              .then(data => {
                  alert(data);
                  if (data.toLowerCase().includes('successful')) {
                      registerModal.style.display = 'none';
                      document.getElementById('registration-form').reset();
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  alert('An error occurred during registration. Please try again later.');
              });
      });
  }

  // Default Tabs and Views
  const tabs = document.querySelectorAll('.tab-btn');
  const views = document.querySelectorAll('.view');
  const defaultTab = document.querySelector('#about-us');
  
  // Helper to activate a tab and its associated view
  const activateTab = (viewId) => {
    tabs.forEach(tab => tab.classList.remove('active'));
    views.forEach(view => view.classList.remove('active'));

    const tab = Array.from(tabs).find(tab => tab.getAttribute('data-view') === viewId);
    const view = document.querySelector(`#${viewId}`);

    if (tab) tab.classList.add('active');
    if (view) view.classList.add('active');
  };

  // Parse the `view` query parameter from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const view = urlParams.get('view');

  if (view) {
    activateTab(view); // Activate the tab from the URL
  } else if (defaultTab) {
    activateTab('about-us'); // Default to About Us tab
  }

  // Add click event listeners to tabs for navigation
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const viewId = tab.getAttribute('data-view');
      activateTab(viewId);
    });
  });
});
