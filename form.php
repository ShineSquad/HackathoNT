<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="index,follow" />
		<meta name="author" content="Shine Squad">
		<link rel="shortcut icon" href="images/logo.svg" type="image/png">
		<title>Форма регистрации</title>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>
		<script type="text/javascript" src="scripts/fb_init.js"></script>
		<script type="text/javascript" src="scripts/form.js"></script>
		<?php
			require_once "php/check_mobile.php";
			if ( check_mobile() ) {
				?>
					<script type="text/javascript" src="scripts/mobile_scripts.js"></script>

					<link rel="stylesheet" type="text/css" href="styles/mobile/styles.css">

					<link rel="stylesheet" type="text/css" href="styles/mobile/main.css">
					<link rel="stylesheet" type="text/css" href="styles/mobile/form.css">
				<?php
			}
			else {
				?>
					<script type="text/javascript" src="scripts/script.js"></script>

					<link rel="stylesheet" type="text/css" href="styles/styles.css">

					<link rel="stylesheet" type="text/css" href="styles/main.css">
					<link rel="stylesheet" type="text/css" href="styles/form.css">
				<?php
			}
		?>
	</head>
	<body>
		<script type="text/javascript">
			window.onload = () => { fb_init(); }
		</script>
		<div id="main">
			<div class="container">
				<header>
					<div class="logo" onclick="window.location.href='index.php'">
						<img src="images/white_hackathont_logo.svg">
						<p>HackathoNT 1.0</p>
					</div>
					<ul class="navigation">
						
					</ul>
					<!-- <div class="mobile_block">
						<div class="mobile_logo">
							<img src="images/white_hackathont_logo.svg">
							<p>HackathoNT 1.0</p>
						</div>
						<div class="mobile_burger">
							<img id="open_burger" src="images/open_burger.svg">
							<img id="close_burger" src="images/close_burger.svg">
						</div>
					</div> -->
					<!-- <div class="mobile_content">
						<ul class="nav_menu">
							<li class="nav_item"><a href="#prize_fund">Призы</a></li>
							<li class="nav_item"><a href="#about">О хакатоне</a></li>
							<li class="nav_item"><a href="#waiting">Кого мы ждем</a></li>
							<li class="nav_item"><a href="#tasks">Задача</a></li>
							<li class="nav_item"><a href="#requirements">Правила</a></li>
							<li class="nav_item"><a href="#footer">Организаторы</a></li>
						</ul>
						<p class="address">Нижний Тагил, пр. Мира 2А <br>16-18 окт 2020</p>
						<a href="https://drive.google.com/file/d/12apWflmEQSDtllqESoGeMS2RT9mGLNLz/view?usp=sharing" target="_blank" style="color: #182B60">
							<div class="mobile_content_button">
								Задача
							</div>
						</a>
						<p class="text">Курирует хакатон <br>команда <b>Shine Squad</b>. <br>Вопросы пишите нам на почту:</p>
						<p class="mail"><a href="mailto:shinesquad.tech@gmail.com">shinesquad.tech@gmail.com</a></p>
						<div class="social">
							или в соц. сети
							<a href="https://vk.com/hackathont"><img src="images/vk.svg"></a>
							<a href="https://www.instagram.com/hackatho.nt/?r=nametag"><img src="images/instagram.svg"></a>
						</div>
					</div> -->
				</header>
				<div id="form">
					<form id="team_lead" method="post" onSubmit="return false;">
						<input 
							type="text" 
							pattern="[0-9a-zA-Zа-яА-Я!-_\s]{3,}" 
							name="name_team" 
							placeholder="Название команды"
						>
						<input 
							type="text" 
							pattern="[a-zA-Zа-яА-Я\s]{3,}" 
							name="name_part" 
							placeholder="ФИО капитана команды"
						>
						<input 
							type="text" 
							pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,}$" 
							name="mail_part" 
							placeholder="Почта капитана команды"
						>
						<input 
							type="text" 
							pattern="[0-9a-zA-Zа-яА-Я!-_\s]{3,}" 
							name="link_social" 
							placeholder="Ссылка на социальные сети"
						>
						<input 
							type="text" 
							pattern="[a-zA-Zа-яА-Я\s]{3,}" 
							name="work_place" 
							placeholder="Учебное заведение или место работы капитана команды"
						>
						<input type="text" style="display: none" name="role">
						<div class="role">
							<p>Роль в команде</p>
							<label><input type="checkbox" name="role" value="project">Проект-менеджер</label>
							<label><input type="checkbox" name="role" value="front">Frontend-разработчик</label>
							<label><input type="checkbox" name="role" value="back">Backend-разработчик</label>
							<label><input type="checkbox" name="role" value="design">Дизайнер</label>
						</div>
						<input 
							type="text" 
							name="optional_equipment" 
							placeholder="Требуется ли вам дополнительное оборудование?"
						>
						<div class="participants_count">
							<p>Сколько участников в команде?</p>
							<select name="participants_count">
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
							</select>
						</div>
						<button onclick="createTeam()">Далее</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>