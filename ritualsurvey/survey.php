
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ritual Survey</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/stylish-portfolio.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>

<body id="page-top">

<section class="text-white">
    <div style="background-color: #000">
      <p align="text-center" style="margin-left: 100px">Ritual Survey</p>
    </div>
  </section>

    <!-- About -->
  <section class="content-section bg-light" id="about" style=" height: 95vh;">
    <div class="container text-center my-auto">
      <div class="row">
        <div class="col-lg-20 mx-auto">
		          

		<?php
    //echo phpversion();
		if(isset($_POST['mTurkID']))
		{
		    $mTurkID = $_POST['mTurkID'];

        ?><div class="alert alert-warning" role="alert"> Amazon Turk ID detected: &nbsp; <?php echo $mTurkID; ?></div> <?php

        $links = array();

        if (($linkhandle = fopen("surveylinks.csv", "r")) !== FALSE) {
            while (($linkdata = fgetcsv($linkhandle, 1000, ",")) !== FALSE) {

              //...
              $linknum = count($linkdata);
              $links[] = $linkdata[2];
              
            }
        } fclose($linkhandle);

        // var_dump($links);


        $row = 1;
        $curr_turk = array();
        $available = "";
        if (($handle = fopen("test.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                //echo "This is the name: ".$data[0]."<br/>"; //prints name correctly
                if (($data[0]) == $mTurkID ) {
                  echo "Welcome back, <em><strong>".$data[0]."</strong></em>! Thank you for participating in our survey. <br/>";
                  $curr_turk = $data;
                  $available = array(1,2,3,4,5,6);

                  //echo $curr_turk;
                  foreach ($curr_turk as $item) {
                  // echo $item;
                  if ($item==1) {
                    $ind = array_search($item, $available);
                    // echo "Found index".$ind;
                    array_splice($available,$ind,1);
                    // var_dump($available);
                  }
                  }
                  // foreach ($available as $value) {
                  //    # code...
                  //   echo $value;
                  break;                                    
                }
                else{
                  echo "Thank you for participating in our survey, <em><strong>".$mTurkID."</strong></em>!<br/>";
                  $available = array(1,2,3,4,5,6);
                  break;
                }
            }
            fclose($handle);
        }
        else
        {
          echo "Uh oh! Error!";
        }

        if (sizeof($available)==0) {
          echo "You have taken all possible surveys. You are not eligible for more. Thank you for participating in our surveys!";
        }
        else
        {
        echo "You have ".sizeof($available)." more survey(s) available.<br/>";

        $choice = $available[array_rand($available)];
        echo "You have randomly been assigned the survey #".$choice;
        $link = $links[$choice-1]."?pid=".urlencode(base64_encode($mTurkID));        
		    ?>

<br/><br/>

<!-- <p> Testing encoded ID: &nbsp; <?php echo urlencode(base64_encode($mTurkID)); ?></p>  -->
        <h3> <a target="blank" href="<?php echo $link; ?>">Click here to get to your survey</a></h3>

      <?php } ?>
		<?php 
		}
		else
		{
		    echo "Error! Could not detect Amazon Turk ID. Please try again!";
		    exit(); 
		}
		?>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <p class="text-muted small mb-0">Survey conducted for academic purposes by researchers at Florida International University. All responses will be anonymous and will only be used for scientific purposes. For more information or any concerns, contact <a href="mailto:ritualsurvey@cs.fiu.edu">ritualsurvey@cs.fiu.edu</a>.</p>
    </div>
  </footer>

     <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/stylish-portfolio.min.js"></script>

</body>

</html>
