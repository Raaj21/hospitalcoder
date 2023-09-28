	<?php if(isset($error_msg) && $error_msg != ''){ ?>
		<div class="alert alert-danger" role="alert" id="alert">
			<?php echo $error_msg;  ?>
		</div>
	<?php }  if(isset($success_msg) && $success_msg != ''){ ?>
		<div class="alert alert-success" role="alert" id="alert">
			<?php echo $success_msg;  ?>
		</div>
	<?php } ?>