<?php include "header.php"; 
      include "loginCreate.php"; 
 ?>

<link rel="stylesheet" href="schedule.css" />

<div id="login" style="display: none;">
	<div class="page-header">
		<h2>Login</h2>
	</div>
	<div class="row">
		<form method="post" action="login.php" id="loginForm">
			<table style="margin-left: 18px; border-spacing: 10px; border-collapse: separate;">
				<tr>
					<td>Email </td>
					<td><input type="text" name="loginEmail" id="loginEmail" class="form-control big" /></td>
				</tr>
				<tr>
					<td>Password </td>
					<td><input type="password" name="loginPassword" id="loginPassword" class="form-control small" /></td>
				</tr>
			</table>
			<hr />
			<input type="submit" value="Enter" class="btn btn-primary" name="action" />
			&nbsp;&nbsp;<a href="#" id="createAccount">Create my account</a>
		</form>
	</div>
</div>

<div id="newAccount" style="display: none;">
	<div class="page-header">
		<h2>New Account</h2>
	</div>
	<div class="row">
		<form method="post" action="login.php" id="accountForm">
			<table style="margin-left: 18px; border-spacing: 10px; border-collapse: separate;">
				<tr>
					<td>Name </td>
					<td><input type="text" name="name" id="name" class="form-control big" /></td>
				</tr>
				<tr>
					<td>Email </td>
					<td><input type="text" name="email" id="email" class="form-control big" /></td>
				</tr>
				<tr>
					<td>Password </td>
					<td><input type="password" name="password" id="password" class="form-control small" /></td>
				</tr>
				<tr>
					<td>Confirm password </td>
					<td><input type="password" name="confirm" id="confirm" class="form-control small" /></td>
				</tr>
			</table>
			<hr />
			<input type="submit" value="Create" class="btn btn-primary" name="action" />
			&nbsp;&nbsp;<a href="#" id="justLogin">I already have an account</a>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#createAccount").click(function(){
			$("#newAccount").show();
			$("#login").hide();
			$("#name").focus();
		});
		$("#justLogin").click(function(){
			$("#newAccount").hide();
			$("#login").show();
			$("#loginEmail").focus();
		});

		<?php
			if (isset($action))
			{
				if ($action == "Create")
					echo "showForm(2);";
				else
					echo "showForm(1);";
			}
			else
			{
				echo "showForm(1);";	
			}
		?>
		$("#name").focus();
		$("#loginForm").validate({
		  rules: {
		    loginEmail: {
		      required: true,
		      email: true
		    },
		    loginPassword: {
		      required: true
		    }
		}});
		$("#accountForm").validate({
		  rules: {
		    name: {
		      required: true
		    },
		    email: {
		      required: true,
		      email: true
		    },
		    password: {
		      required: true
		    },
		    confirm: {
		      required: true,
		      equalTo: "#password"
		    }
		}});
	});
	function showForm(number) {
		if (number == 1)
			$("#justLogin").click();
		else
			$("#createAccount").click();
	}

</script>

<?php include "footer.php"; ?>