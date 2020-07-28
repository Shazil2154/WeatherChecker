<?php

	 $weather = "";
    $error = "";
    
    if (array_key_exists('city', $_GET)) {
        
        $city = str_replace(' ', '', $_GET['city']);
        
        $file_headers = @get_headers("https://www.timeanddate.com/weather/pakistan/".$city);
        
        
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
            $error = "<h1>404 ERROR</h1> could'nt find the city.";

        } else {
        
        $forecastPage = file_get_contents("https://www.timeanddate.com/weather/pakistan/".$city);
        
        $pageArray = explode(' title="Historic weather and climate information">Climate (Averages)</a></div></nav></section>', $forecastPage);
            
        if (sizeof($pageArray) > 1) {
        
                $secondPageArray = explode('Upcoming 5 hours', $pageArray[1]);
            
                if (sizeof($secondPageArray) > 1) {

                    $weather = $secondPageArray[0];
                    
                } else {
                    
                    $error = "<h1>404 Error</h1>That city could not be found.";
                    
                }
            
            } else {
            
                $error = "<h1>404 Error</h1>That city could not be found.";
            
            }
        
        }
        
    }





?>
<!DOCTYPE html>
<html>
<head>
	<title>Wather Scrapper</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


    <style type="text/css">
    	html { 
  background: url(watherback1.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	}
	body{
		background:none;
		text-align: center;
	}
	.container{
		margin-top: 100px;
		width:450px;
	}
	#city{
		margin-top: 10px;
		margin-bottom: 20px;
	}
    </style>




</head>
<body>
	<div class="container">

		<form>
		  <div class="form-group">
		  	<h1>What's The Weather?</h1>
		    <label for="city">Enter your city here.</label>
		    <input type="text" class="form-control" id="city" name="city" placeholder="e.g. Lahore,Multan" value = "<?php 
																										   
																										   if (array_key_exists('city', $_GET)) {
																										   
																										   echo $_GET['city']; 
																										   
																										   }
																										   
																										   ?>">
		    <small class="form-text text-muted">Notice!This site is only coded to display the weather of Pakistan.</small>
		  </div>
		  <button type="submit" class="btn btn-primary">Check</button>
		</form>
		<div id="weather"><?php 
              
              if ($weather) {
                  
							                  echo '<div class="alert alert-success" role="alert">
							  '.$weather.'
							</div>';
							                  
							              } else if ($error) {
							                  
							                  echo '<div class="alert alert-danger" role="alert">
							  '.$error.'
							</div>';
							                  
							              }
              
              ?></div>

	</div>



	 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js"></script>


     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
