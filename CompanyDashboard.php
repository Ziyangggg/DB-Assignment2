<?php
require_once('connect.php');
include('company_session.php');
$query=mysqli_query($connect,"SELECT * FROM Company_Info where CompanyID='$companyid' and is_deleted = '0'")or die(mysqli_error());
      $row49=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Dashboard</title>
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
      <span class="logo_name">Company</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="CompanyDashboard.php" class="active">
            <i class='bx bxs-dashboard'></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="CompanyJobPosting.php">
            <i class='bx bxs-briefcase-alt-2'></i>
            <span class="links_name">Jobs </span>
          </a>
        </li>
        <li>
          <a href="CompanyApplicant.php">
            <i class='bx bxs-group'></i>
            <span class="links_name">Application</span>
          </a>
        </li>
       
        <li>
          <a href="CompanyReview.php">
            <i class='bx bxs-star'></i>
            <span class="links_name">Review</span>
          </a>
        </li>
        <li>
            <a href="CompanyProfile.php">
                <i class='bx bxs-buildings' ></i>
              <span class="links_name">Company Profile</span>
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
      <span class="dashboard">Dashboard</span>
  </div>
    
    <div class="profile-details">
      <span class="admin_name"><?php echo $row49["CompanyUsername"] ?></span>
      
    </div>
  </nav>

  <?php
  $companyid = $_SESSION["companyid"];
  $query = "select * from joblisting WHERE CompanyID = $companyid and is_deleted = '0'";
  $bbb = mysqli_query($connect,$query);
  
  ?>
  
  <section class="home-section">
   

    <div class="home-content">
      <div class="overview-boxes">
        <?php
        
        $sql = "select * from joblisting WHERE CompanyID = $companyid and is_deleted = '0'";
        $result = mysqli_query($connect,$sql);
        

        while($row = mysqli_fetch_array($result)){
          $jobid = $row['JobListingID'];
          $sql1 = "select COUNT(*) from application WHERE CompanyID = $companyid AND JobListingID = '$jobid' ";
          $result2 = mysqli_query($connect,$sql1);
          $row2 = mysqli_fetch_array($result2);
          
        ?>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">
              <?php echo $row["JobTitle"]; ?>
            </div>
            <div class="applicant-number">
              <div class="number"><?php echo $row2['COUNT(*)'];?></div>
                <div class="applicants">
                  <span class="text">applicants</span>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
          
          ?>
       
        
      </div>
      <div class="all-boxes">
      <div class="title">Recent Applicants</div>
      <div class="applicant-boxes">
        <div class="recent-applicant">
          
          <div class="table">
            <table>
              <thead>
                <tr>
                    <th>Applicant ID</th>
                    <th>Name</th>
                    <th>Applied Role</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Resume</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                  $companyid = $_SESSION["companyid"];
                  $sql = "select * from application WHERE CompanyID = $companyid order by ApplicationID DESC LIMIT 10 ";
                  $result = mysqli_query($connect,$sql);
                  while($row = mysqli_fetch_assoc($result))
                  {
                    $appli = $row['ApplicationID'];
                    $new = $row['Job_SeekerID']; 
                    $sql2 = "select * from job_seekerinfo WHERE Job_SeekerID = '$new' and is_deleted = '0'";
                    $result2 = mysqli_query($connect,$sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    if(is_array($row2)){

                    $new = $row['JobListingID']; 
                    $sql3 = "select * from joblisting WHERE JobListingID = '$new'and is_deleted = '0'";
                    $result3 = mysqli_query($connect,$sql3);
                    $row3 = mysqli_fetch_assoc($result3);
                    if(is_array($row3)){

                    $new = $row['Job_SeekerID']; 
                    $sql4 = "select * from resume_jobseeker WHERE Job_SeekerID = '$new'";
                    $result4 = mysqli_query($connect,$sql4);
                    $row4 = mysqli_fetch_assoc($result4);
                    if(is_array($row4)){ 
                ?>
                <td><?php echo $row['ApplicationID']; ?></td>
                <td><?php echo $row2['Job_SeekerFullname']; ?></td>
                <td><?php echo $row3['JobTitle']; ?></td>
                <td><?php echo $row['DateApplied']; ?></td>
                <td><?php echo $row['ApplicationStatus']; ?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php echo $appli; ?>">View</button>
                              <div class="modal fade" id="exampleModalLong<?php echo $appli; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered"  role="document">
                                  <div class="modal-content">
                                    <div class="modal-header" >
                                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">

                                      <div class="Job-Description" style="text-align: left; margin-left: 50px;">
                                      
                                        <h2 ><?php echo $row4['Job_SeekerFullname']; ?></h2>
                                        <h5>Email</h5>
                                        <p><?php echo $row4['Job_SeekerEmail'];?></p>
                                        <h5>Phone</h5>
                                        <p><?php echo $row4['Job_SeekerPhone']; ?></p>

                                        <h5>Address</h5>
                                        <p><?php echo $row4['Job_SeekerAddress']; ?></p>
                                        <h5>Race</h5>
                                        <p><?php echo $row4['Job_SeekerRace']; ?></p>
                                        <h5>Experience</h5>
                                        <p><?php echo $row4['Job_SeekerExperience']; ?></p>
                                        <h5>Education</h5>
                                        <p><?php echo $row4['Job_SeekerEducation']; ?></p>
                                        <h5>Language</h5>
                                        <p><?php echo $row4['Job_SeekerLanguage']; ?></p>
                                        <h5>Skill</h5>
                                        <p><?php echo $row4['Job_SeekerSkill']; ?></p>
                                        <h5>Summary</h5>
                                        <p><?php echo $row4['Job_SeekerSummary']; ?></p>
                                        
                                      </div>

                                      
                                    
                                    
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>   
                </td>
                
              </tr>
              <?php
                  }
                }
                }
              }
            
              ?>
            </tbody>
        </table>
              
          </div>
          <div class="button">
            <a href="CompanyApplicant.php">See All</a>
          </div>
        </div>
        
      </div>
    </div>
    </div>
  </section>

  

</body>
</html>

<script src="script.js"></script>