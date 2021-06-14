
<?php require ("HeaderLayout.php"); ?>
<form class="form-horizontal" action="validerSession.php" method="POST">
<fieldset>

<!-- Form Name -->
<div class="alert alert-info" role="alert">
<legend>Valider votre Session </legend>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailid">Username</label>
  <div class="col-md-4">
  <input id="emailid" name="username" placeholder="" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-4">
    <input id="password" name="mdp" placeholder="" class="form-control input-md" required="" type="password">
    <span class="help-block"> </span>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="login"></label>
  <div class="col-md-4">
    <button id="login" name="login" class="btn btn-primary">Login</button>
  </div>
</div>

</fieldset>
</form>

	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   
   <div class="section group">
				
					</div>
				</div>
			</div>
        </div>

<?php   require("footerLayout.php");  ?>
   <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

