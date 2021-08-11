<?php $currentPage = 'Patients' ?>

<?php require_once 'views/db.view.php'; ?>

<?php require 'includes/header.php'; ?>

<div class="container my-2 table__container">
  <p class="patient__list">Patient Bookings</p>
  <?php
    $doctorid = $_SESSION['doctorid'];
    $results = mysqli_query($connection,"SELECT * FROM patients WHERE doctorid = $doctorid");
  ?>
  <?php if($results == false): ?>
  <p>You do not have any bookings yet!</p>
  <?php else: ?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Date</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody class="table_data">
        <?php while($row = mysqli_fetch_array($results)): ?>
        <tr class="text-center">
          <th scope="row"><?php $patient_number = 1; ?></th>
          <td><?php echo $row['first_name']; ?></td>
          <td><?php echo $row['last_name']; ?></td>
          <td><?php echo $row['mobile_number']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['appointment_date']; ?></td>
          <td class="text-center">
            <a href="editpatient.php?edit=<?php echo $row['patientid']; ?>" class="btn btn-primary ">Edit</a>
          </td>
          <td class="text-center">
            <a href="process.php?delete=<?php echo $row['patientid']; ?>" class="btn btn-danger ">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<?php endif; ?>
<?php  mysqli_close($connection); ?>