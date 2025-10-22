<?php
	require('include/head.php'); 
?>

	<body class="body_log">
		<div class="wrapper">
			<table class="logowanie">
				<tr>
					<td>
						<form method="post" action="" class="log_form">
							<input type="text" name="login" placeholder="login" />
							<input type="password" name="pass" placeholder="hasło" />
							<input type="submit" name="get_logged" value="zaloguj" />
						</form>
						<?php echo '<p>'.$communique.'</p>'; ?>
						<a href="?page=forgot_password" class="chp_link">Nie pamiętasz hasła?</a>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>	


