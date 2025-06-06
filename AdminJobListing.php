<?php include("admin_session.php"); ?>
<?php
require_once('connect.php');
$id=$_SESSION["adminid"];
$query = "SELECT * FROM admin_info WHERE AdminID = '$id'";
$result = mysqli_query($connect,$query);
$row49 = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Job Listing</title>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-upwork'></i>
      <span class="logo_name">Admin</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="AdminDashboard.php" >
            <i class='bx bxs-dashboard'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="AdminMessage.php" >
            <i class='bx bxs-message' ></i>
            <span class="links_name">Message</span>
          </a>
        </li>
        <li>
          <a href="AdminJobListing.php"  class="active">
            <i class='bx bxs-briefcase-alt-2'></i>
            <span class="links_name">Job Listing </span>
          </a>
        </li>
        <li>
          <a href="AdminReportedJob.php" >
            <i class='bx bxs-report'></i>
            <span class="links_name">Reported Job</span>
          </a>
        </li>
       
        <li>
          <a href="AdminFeedBack.php">
            <i class='bx bxs-star'></i>
            <span class="links_name">Company Feedback</span>
          </a>
        </li>

    

        <li>
            <a href="AdminCompanyList.php">
                <i class='bx bxs-buildings' ></i>
              <span class="links_name">Company List</span>
            </a>
        </li>

        <li>
            <a href="AdminJobSeekerList.php">
              <i class='bx bxs-group' ></i>
              <span class="links_name">Job Seeker List</span>
            </a>
        </li>

        <li>
          <a href="AdminCategory.php">
            <i class='bx bxs-category-alt' ></i>
            <span class="links_name">Category</span>
          </a>
      </li>

      <li>
        <a href="AdminProfile.php">
            <i class='bx bxs-user'></i>
          <span class="links_name">Profile</span>
        </a>
    </li>

    <li>
      <a href="AdminAddAdmin.php" >
        <i class='bx bxs-user-badge'></i>
        <span class="links_name">New Admin</span>
      </a>
  </li>

        <li class="log_out">
        <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>

        
      </ul>
  </div>
  <nav>
    <div class="sidebar-button">
      <i class='bx bx-menu sidebarBtn'></i>
      <span class="dashboard">Job Listing</span>
    </div>
    
    <div class="profile-details">
    <span class="admin_name"><?php echo $row49["AdminUsername"] ?></span>
    </div>
  </nav>
  <section class="home-section">
   

    <div class="home-content">
     
      <div class="all-boxes">
      <div class="title">Job Listing</div>
      <div class="applicant-boxes">
        <div class="recent-applicant">
          
          <div class="table">
            <table>
              <thead>
                <tr>
                    <th>Job Listing ID</th>
                    <th>Job Title</th>
                    <th>Category Name</th>
                    <th>Salary</th>
                    <th>Company Name</th>
                    <th>Company ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            <tr>
                          <?php
                          $username=$_SESSION["adminusername"];//nshow admin name
                          $sql = "select * from joblisting where is_deleted = '0' order by JobListingID DESC";
                          $result = mysqli_query($connect,$sql);
                          while($row = mysqli_fetch_assoc($result))
                          {
                            $jid = $row['JobListingID'];
                            $new = $row['CompanyID']; 
                            $sql2 = "select * from company_info WHERE CompanyID = '$new'and is_deleted = '0'";
                            $result2 = mysqli_query($connect,$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            if(is_array($row2)){
                              $categoryid=$row['JobCategoryID'];
                              $sql4 = "select * from jobcategory  where JobCategoryID= $categoryid and is_deleted = '0'";
                              $result4 = mysqli_query($connect,$sql4);
                              $row3 = mysqli_fetch_assoc($result4);
                              if(is_array($row3)){
                          ?>
                          <td><?php echo $row['JobListingID']; ?></td>
                          <td><?php echo $row['JobTitle']; ?></td>
                          <td><?php echo $row3['JobCategoryName']; ?></td>
                          <td><?php echo $row['JobSalary']; ?></td>
                          <td><?php echo $row2['CompanyName']; ?></td>
                          <td><?php echo $row['CompanyID']; ?></td>
                          <td >
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view<?php echo $jid; ?>">View</button>
                          <div class="modal fade" id="view<?php echo $jid; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                  <div class="modal-dialog modal-lg modal-dialog-centered"  role="document">
                                    <div class="modal-content">
                                      <div class="modal-header" >
                                        <h5 class="modal-title" id="exampleModalLongTitle">Job Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">

                                      <div class="Job-Description" style="text-align: left; margin-left: 50px;">
                                      <img src="data:image/jpeg;base64,<?php echo base64_encode($row2['CompanyLogo']);?>" style="max-width:200px;max-height:200px;">
                                      
                                        <h2 ><?php echo $row["JobTitle"]; ?></h2>
                                        <h5>Company</h5>
                                        <p><li><?php echo $row2["CompanyName"]; ?></li></p>
                                        <h5>Job Description</h5>
                                        <p><li><?php echo $row["JobDescription"]; ?></li></p>
                                        <h5>Job Requirement</h5>
                                        <p><li><?php echo $row["JobRequirement"]; ?></li></p>

                                        <h5>Job Type</h5>
                                        <p><li><?php echo $row["JobType"]; ?></li></p>
                                        <h5>Job Category</h5>
                                        <p><li><?php echo $row3["JobCategoryName"]; ?></li></p>
                                        <h5>Location:</h5>
                                        <p><li><?php echo $row["JobLocation"]; ?></li></p>
                                        <h5>Salary:</h5>
                                        <p><li>RM: <?php echo $row["JobSalary"]; ?></li></p>
                                        <h5>Company Registration No.</h5>
												                <p><li><?php echo $row2["CompanyRegistrationNo"]; ?></li></p>
                                      </div>

                                      
                                    
                                    
                                    </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                          </div>
                          <a class="btn btn-danger" href="AdminJobListing.php?dlt&jid=<?php echo $jid ?>" onclick="return confirmation();">Delete</a>
                          </td>
                        </tr>
                        <?php
                              }
                          }
                        }
                        ?>
          </tr>
                
                
            </tbody>
        </table>
              
          </div>
          
        </div>
        
      </div>
    </div>
    </div>
  </section>

</body>
</html>

<script src="script.js"></script>
<script>
function confirmation()
{
	var answer=confirm("Do you really want to delete?");
	return answer;
}
</script>

<?php

	if(isset($_GET['dlt']))
	{
		$jid=$_GET['jid'];
		$query = "UPDATE joblisting SET is_deleted = '1' WHERE JobListingID = $jid";
		$result = mysqli_query($connect,$query);
?>
            <script type='text/javascript'>

                window.location.href="AdminJobListing.php";
            </script>

<?php
  }
?>