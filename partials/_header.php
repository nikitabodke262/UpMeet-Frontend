<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/UpMeet">UpMeet </a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/UpMeet">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="contact.php"  aria-disabled="true">Contact </a>
    </li>
  </ul>

  </form>

  <button class="btn btn-success ml-2" data-toggle="modal" data-target="#loginModal">Login  </button>
  <button class="btn btn-success mx-2"  data-toggle="modal" data-target="#signupModal">SignUp</button>
  </div>
</div>
</nav>';

include  'partials/_login_modal.php';
include  'partials/_signup_modal.php';