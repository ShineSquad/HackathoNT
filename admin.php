<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Админка</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js" integrity="sha512-Hmp6qDy9imQmd15Ds1WQJ3uoyGCUz5myyr5ijainC1z+tP7wuXcze5ZZR3dF7+rkRALfNy7jcfgS5hH8wJ/2dQ==" crossorigin="anonymous"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>
		<script type="text/javascript" src="scripts/fb_init.js"></script>
		<script type="text/javascript" src="scripts/admin.js"></script>
	</head>
	<body>
		<script type="text/javascript">
			window.onload = () => { 
				fb_init();
				let user = localStorage.getItem("user");
				if (user == null) { window.location.href = "auth.html"; }
				else { return true; }
			}
		</script>
		<div>
			<form method="post" onSubmit="return false;" id="regAdmin">
				<input type="text" name="name" placeholder="Имя">
				<input type="password" name="password" placeholder="Пароль">
				<button onclick="reg()">Регистрация</button>
			</form>
			<hr>
			<form method="post" onSubmit="return false;" id="authAdmin">
				<input type="text" name="name" placeholder="Имя">
				<input type="password" name="password" placeholder="Пароль">
				<button onclick="auth()">Авторизация</button>
			</form>
			<hr>
		</div>
	</body>
</html>