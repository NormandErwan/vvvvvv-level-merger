<?php
	include 'model/Data.class.php';
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<div class="container-fluid text-center">
    <h2>VVVVVV Level Merger</h2>

    <p>By Damien Bry & Erwan Normand</p>
<br/>
<br/>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" action="upload.php" method="POST">
                <fieldset>
                    <div class="form-group">
                        <label for="inputName" class="col-lg-2 control-label">Level name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Level Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Level content</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="data" rows="3" id="textArea"></textarea>
                            <span class="help-block">The content of your actual level</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Which level group ?</label>
                        <div class="col-lg-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="td" id="optionsRadios1" value="1" checked="">
                                    TD 13h15-16h15
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="td" id="optionsRadios2" value="2">
                                    TD 16h30-19h30
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Where to put the level ?</label>
                        <div class="col-lg-5">
							<label for="x" class="">X</label>
                            <select class="form-control" name="x" id="x">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="col-lg-5">
							<label for="y" class="">Y</label>
                            <select class="form-control" name="y" id="y">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">Save the awesome !</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>TD</th>
                    <th>Level name</th>
                    <th>X</th>
                    <th>Y</th>
                </tr>
                </thead>
                <tbody>
					<?php
					for ($td = 1; $td <= 2; $td++) { 
						foreach (Data::loadXML($td) as $level) { ?>
						<tr>
							<td><?php echo $td; ?></td>
							<td><?php echo $level['name']; ?></td>
							<td><?php echo $level['x']; ?></td>
							<td><?php echo $level['y']; ?></td>
						</tr>
					<?php } 
					} ?>
				</tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script section -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>
