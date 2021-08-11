<?php $currentPage = 'My Bookings' ?>
<?php require 'includes/header.php'; ?>
<?php require_once 'views/db.view.php'; ?>

<div class="container mt-3 p-1">
  <?php 
    $results = mysqli_query($connection,"SELECT * FROM patients INNER JOIN doctors ON doctors.doctorid = patients.doctorid"); 
  ?>
  <?php if(count(mysqli_fetch_array($results)) > 0): ?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th colspan="1">Name</th>
          <th colspan="1">Date</th>
          <th colspan="1">Doctor</th>
        </tr>
      </thead>
      <?php while($row = mysqli_fetch_array($results)): ?>
      <?php $_SESSION['patientid'] = $row['patientid']; ?>
      <tbody>
        <tr>
          <td><?php echo $row['first_name'] ?></td>
          <td><?php echo $row['appointment_date'] ?></td>
          <td><?php echo $row['username'] ?></td>
        </tr>
      </tbody>
      <?php endwhile; ?>
    </table>
  </div>
  <?php else: ?>
  <div class="card">
    <p>Nothing to see here yet!</p>
    <a href="book.php">Book an appointment</a>
  </div>
  <?php endif; ?>

</div>