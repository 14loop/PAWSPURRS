<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paws & Purrs Pet Grooming</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="banner">
    <div class="title-section">
    <h1 class="title">Paws & Purrs</h1>
    <h2 class="subtitle">Pet Grooming</h2>
    </div>
<div class="modal-buttons">
<!-- Log In Button -->
<div class="login-button" class="modal-buttons">
  <button id="loginButton" class="login-btn">Log In</button>

  <!-- Login Modal -->
  <div id="loginModal" class="modal">
    <div class="modal-content">
      <span class="close login-close">&times;</span> <!-- Unique class -->
      <h2>Log In</h2>
      <form id="loginForm">
        <label for="loginEmail">Email</label>
        <input type="email" id="loginEmail" required>

        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" required>

        <button type="button" id="submitLogin">Log In</button>
      </form>
    </div>
  </div>

<!-- Register Button -->
<div class="register-button" class="modal-buttons">
  <button class="register-btn">Register</button>
</div>
<!-- Registration Modal -->
<div id="registerModal" class="modal">
  <div class="modal-content">
      <span class="register-close">&times;</span> <!-- Unique close button class -->
      <h2>Register</h2>
      <form id="registration-form">
          <label for="firstname">First Name</label>
          <input type="text" id="firstname" required>

          <label for="lastname">Last Name</label>
          <input type="text" id="lastname" required>

          <label for="email">Email</label>
          <input type="email" id="email" required>

          <label for="phonenumber">Phone Number</label>
          <input type="text" id="phonenumber" required>

          <label for="password">Password</label>
          <input type="password" id="password" required>

          <button type="button" id="submitRegistration">Register</button>
      </form>
  </div>
</div>
</div> <!-- Close login-button div -->
</div> <!-- Close register-button div -->
</div> <!-- Close modal-buttons div -->
  </header>

  <nav class="tabs">
    <button class="tab-btn" data-view="about-us">About Us</button>
    <button class="tab-btn" data-view="our-work">Our Work</button>
    <button class="tab-btn" data-view="appointments">Appointments</button>
  </nav>

  <main class="content">
    <section id="about-us" class="view active">
      <h2>About Us</h2>
      <p>Welcome to Paws & Purrs Pet Grooming! We care for your furry friends like our own.</p>
      <img src="images/before_after.jpeg" alt="Dog before and after grooming" class="about-us-image">
    </section>
    <section id="our-work" class="view">
      <h2>Our Work</h2>
      <p>We stand by the quality of our work, feel free to stay with your pet or drop them off. 
      Either way we are commited to providing amazing grooming transformations that leave your pets feeling fresh, clean and happy!</p>
      <div class="gallery">
        <img src="images/soapy_dog.png" alt="Dog with a cute haircut" class="gallery-item">
        <img src="images/trimmed_terriers.jpeg" alt="Small groomed terrier dogs" class="gallery-item">
        <img src="images/cat_bath.jpeg" alt="Soapy cat" class="gallery-item">
        <img src="images/close.jpeg" alt="Dog with a cute haircut" class="gallery-item">
        <img src="images/Cat_nail_trimming.jpeg" alt="Dog with a cute haircut" class="gallery-item">
      </div>
      <div class="testimonials">
        <h3>Hear from our clients:</h3>
        <blockquote>
          <p>"Paws & Purrs did an amazing job with Max! He looks so adorable and smells great!"</p>
          <cite>- Emily R.</cite>
        </blockquote>
        <blockquote>
          <p>"The team at Paws & Purrs is the best! My cat Lulu is usually shy, but they made her so comfortable."</p>
          <cite>- Sarah L.</cite>
        </blockquote>
        <blockquote>
          <p>"I trust them with my dogs, and they always come back looking fabulous. Highly recommend!"</p>
          <cite>- Jason K.</cite>
        </blockquote>
      </div>
    </section>
    
    <section id="appointments" class="view">
      <h2>Book an Appointment</h2>
      <p>*Please log in before booking.</p>
      <form id="appointment-form" method="POST" action="submit_appointment.php">
        <label for="client_name">Your Name</label>
        <input type="text" id="client_name" name="client_name" required>

        <label for="appointment_date">Preferred Date</label>
        <input type="date" id="appointment_date" name="appointment_date" required>
    
        <label for="appointment_time">Preferred Time</label>
        <input type="time" id="appointment_time" name="appointment_time" required>
    
        <label for="pet_name">Pet's Name</label>
        <input type="text" id="pet_name" name="pet_name" required>
    
        <label for="pet_type">Pet Type</label>
        <select id="pet_type" name="pet_type" required>
          <option value="Dog">Dog</option>
          <option value="Cat">Cat</option>
          <option value="Other">Other</option>
        </select>

    
        <button type="submit">Book Appointment</button>
      </form>
    </section>
    
  </main>

  <script src="script.js"></script>
</body>
</html>
