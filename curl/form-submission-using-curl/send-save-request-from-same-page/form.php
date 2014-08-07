<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 <link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <style type="text/css">
     .container{
         margin: 20px;
     }
 </style>
 <title>Curl from same page</title>
 </head>

<body>
    <div class="span10 well">
		<p> Some Data Before Form </p>
       Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. 
    </div>
    <?php
	/* if post request that means form is submitted , so make curl request */
    if (isset($_POST) && !empty($_POST)) :
        $email = $_POST["email"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $postData = array("email"=>$email,"name"=>$name,"password"=>$password);
        //curl request
        $ch = curl_init();
        $url = "http://localhost/Code_Library/study_material/curl/form-submission-using-curl/request-from-same-page/handler.php";
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);		
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postData);	
        //response of curl request in json
        $result = curl_exec($ch);	
        curl_close($ch);
        $msg = json_decode($result);
    ?>
        <div class="span10 well">
        <?php    print_r($msg->msg); ?>
        </div>
    <?php
		/* if not a post request display the form*/
    else :
    ?>
    
    <div class="container">
      <form id="form1" class="contact-us form-horizontal" method="post" action="#">
        <div class="control-group">
            <label class="control-label">Name</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" class="input-xlarge" name="name" id="name" placeholder="Name">
                </div>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                    <input type="text" class="input-xlarge" name="email" id="email" placeholder="Email">
                </div>
            </div>    
        </div>
        <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
                <div class="input-prepend">
                <span class="add-on"><i class="icon-lock"></i></span>
                    <input type="text" id="password" class="input-xlarge" name="password" id="password" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>    
        </div>
      </form>
</div>
    <?php
    endif;
    ?>
    <div class="span10 well">
		<p> Some Data After Form </p>
       Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. 
    </div>
</body>
 </html>
