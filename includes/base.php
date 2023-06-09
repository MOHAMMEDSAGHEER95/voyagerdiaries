<?php session_start();

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="https://res.cloudinary.com/dguekkhnb/image/upload/v1684652397/Voyager_2_uzfcsa.png"
          height="50"
          alt="Logo"
          loading="lazy"
          style="border-radius: 50%;"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php 
  if (isset($_SESSION['user_id'])) {
    echo '/create-reviews.php';
  } else {
    echo '/login.php';
  } 
?>">Add Reviews</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php 
  if (isset($_SESSION['user_id'])) {
    echo '/my-reviews.php';
  } else {
    echo '/login.php';
  } 
?>">My Reviews</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Avatar -->
      <div class="dropdown mr-100">
      <?php
      
if (isset($_SESSION['user_id'])) {
    ?>
        
          <img
            src="https://img.freepik.com/free-icon/user_318-159711.jpg?w=2000"
            class="rounded-circle menu_avatar"
            height="25"
            alt="Black and White Portrait of a Man"
            loading="lazy"
          />
      
        <?php }
        else {

            echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
        echo '<li class="nav-item">';
          echo '<a class="nav-link" href="/login.php">Login</a>';
        echo '</li>';
        }
        
        ?>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdownMenuAvatar"
        >
          <li>
<?php
if (isset($_SESSION['user_id'])) {
            echo '<a class="dropdown-item" href="/my-profile.php">My profile</a>';
          echo '</li>';
          echo '<li>';
            echo '<a class="dropdown-item" href="/logout.php">Logout</a>';
          echo '</li>';
}
          ?>
        </ul>
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->