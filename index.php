
<?php include("includes.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Tracker</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
	
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/nifty.min.css" rel="stylesheet">

	<script src="js/app.js?v=9"></script>	
	<script src="//connect.facebook.net/en_GB/all.js"></script>
    
    <script>
		var appId = null;
		var permission = null; 
		var actionUrl = null;
		var appUser = null;
		
		$(document).ready(function() {
				 appId 		= '<?=$conf['appId']?>';
				 permission = {scope: '<?=$conf['fb_permission']?>'}; 
				 actionUrl 	= '<?=$conf['action_url']?>';
							
			  	window.fbAsyncInit = function() {
				    FB.init({
				      appId      : '<?=$conf['appId']?>', // App ID
				      status     : true, // check login status
				      cookie     : true, // enable cookies to allow the server to access the session
				      xfbml      : true  // parse XFBML
				    });
	
			  	};
		  	
		  		$('.getuser').click(function() {
		  			fblogin(permission,function() {
		  					$('#login').hide();
			  				$('#container').show();
			  			}
		  			);
		  			return false;
		  		});
			});
		   
		</script>

</head>

<body>
	<div id="fb-root"></div>
	
	<div id="login" class="effect mainnav-lg">
		<a href="#" class="getuser">login</a> 
	</div>
	
	<div id="container" class="effect mainnav-lg" style="display: none">
    	<div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-2 col-sm-12">
        	<div class="panel panel-colorful panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title" id="book_title"></h3>
                </div>
                <div class="panel-body">
                    <div class="panel panel-bordered-primary">                        
                        <div class="panel-body">
                            <div class="progress progress-xl"><div id="book_progress" style="width: 50%;" class="progress-bar progress-bar-success">50%</div></div>
                            <form class="form-horizontal">
                            	<div class="input-group mar-btm">
                                	<input type="email" placeholder="Word Count" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning" type="button">Add</button>
                                    </span>                                    
                                </div>
                            </form>
                            <div class="panel panel-colorful panel-primary">
								<div class="panel-body">
                                	<form class="form-horizontal">
                                    	<div class="form-group">
											<div class="col-sm-6">
												<input type="text" placeholder="Book Name" class="form-control input-lg" id="demo-is-inputsmall">
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-3 control-label" for="demo-is-inputsmall">Total Count</label>
											<div class="col-sm-3">
												<input type="text" placeholder="" class="form-control  input-sm" id="total_word_count">
											</div>
										</div>
                                        <div class="form-group">
											<label class="col-sm-3 control-label" for="demo-is-inputsmall">Current Count</label>
											<div class="col-sm-3">
												<input type="text" placeholder="" class="form-control  input-sm" id="current_word_count">
											</div>
										</div>
                                        <div class="col-lg-2 col-lg-offset-10">
                                        <button class="btn btn-default" style="width:125% !important">Edit</button>
                                        </div>
                                    </form>
								</div>
							</div>
                            <div class="panel">
					
								<!--Panel heading-->
								<div class="panel-heading">
									<h3 class="panel-title">Sample Text</h3>
								</div>
					
								<!--Default panel contents-->
								<div class="panel-body">									
								<table class="table" style="color:#000000 !important">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Count</th>
                                            </tr>
                                        </thead>
                        
                                        <tbody>
                                           <div id="record_container">
                                           
                                           </div>
                                        </tbody>
                                    </table>
								</div>
					
					
								
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	<div id="record_template" style="display: none">
											<tr>
                                                <td class="text-center">__index__</td>
                                                <td class="text-center">__date__</td>
                                                <td class="text-center">__count__</td>                                                
                                            </tr>
	</div>

</body>
</html>
