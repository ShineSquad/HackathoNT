<?php

	ini_set('display_errors', 0);

	require './vendor/autoload.php';

	use Kreait\Firebase\Factory;
	use Kreait\Firebase\ServiceAccount;

	use PhpOffice\PhpWord\PhpWord;

	function createReportInfo() {

		$factory = (new Factory)->withServiceAccount('./php/hackathont-d9b44-ef6940892e5a.json');

		$database = $factory->createDatabase();
		$reference = $database->getReference('teams');
		$snapshot = $reference->getSnapshot();
		$data = $snapshot->getValue();

		$phpWord = new PhpWord();

		$phpWord -> setDefaultFontName('Arial');
		$phpWord -> setDefaultFontSize(14);

		$properties = $phpWord -> getDocInfo();

		$properties->setCreator('Morty');
		$properties->setCompany('ShineSquad');
		$properties->setTitle('Report');
		$properties->setDescription('This is my report');
		$properties->setCategory('My category');
		$properties->setLastModifiedBy('Morty');
		$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
		$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
		$properties->setSubject('My subject');
		$properties->setKeywords('my, key, word');

		$cellRowContinue = array(
			'vMerge' => 'continue',
			'valign' => 'center'
		);
		$cellRowRestart = array(
			'vMerge' => 'restart',
			'valign' => 'center'
		);
		$sectionStyle = array(
			'orientation' => 'landscape',
		);
		$cellHCentered = array(
			'align' => 'center'
		);
		$cellVCentered = array(
			'valign' => 'center'
		);
		$styleTable = array(
			'borderSize' => 6, 
			'borderColor' => '000000',
		);

		$sectionHr = array(
			'bgColor' => 'F4F4F4',
			'valign' => 'center'
		);
		$fontHr = array(
			'spaceAfter' => 400,
			'spaceBefore' => 400,
		);

		$sectionTeam = array(
			'bgColor' => 'DDDDDD',
			'valign' => 'center',
			'borderTopSize' => 20,
			'borderBottomSize' => 20
		);
		$fontTeam = array(
			'spaceAfter' => 250,
			'spaceBefore' => 250
		);

		$sectionUserEven = array(
			'bgColor' => 'F4F4F4',
			'valign' => 'center',
		);
		$sectionUserOdd = array(
			'bgColor' => 'FFFFFF',
			'valign' => 'center',
		);
		$fontUser = array(
			'spaceAfter' => 400,
			'spaceBefore' => 400
		);

		$section = $phpWord -> addSection($sectionStyle);

		$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
		$table = $section->addTable('Colspan Rowspan');
		$table->addRow(null, array('tblHeader' => true));
		$table->addCell(1680, $sectionHr)->addText(
			'ФИО', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1440, $sectionHr) -> addText(
			'Дата рождения', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1078, $sectionHr) -> addText(
			'Роли', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1820, $sectionHr) -> addText(
			'Телефон', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(2044, $sectionHr) -> addText(
			'E-MAIL', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1820, $sectionHr) -> addText(
			'Соц. сети', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1442, $sectionHr) -> addText(
			'Город', 
			array('bold' => true, 'size' => 12),
			$fontHr
		);
		$table->addCell(1442, $sectionHr) -> addText(
			'Место работы / учебы', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);
		$table->addCell(1078, $sectionHr) -> addText(
			'Нужно ли доп. оборуд.', 
			array('bold' => true, 'size' => 12), 
			$fontHr
		);

		$team_count = 1;
		$user_count = 1;

		foreach ($data as $key => $value) {
			$ev_count = 1;
			$team_name = $value["team_name"];
			$participants = $value["participants"];
			$table->addRow(null, array('tblHeader' => true));
			$table->addCell(14000, $sectionTeam) -> addText(
				$team_count." - ".$team_name, 
				array('bold' => true), 
				$fontTeam
			);
			$team_count++;
			foreach ($participants as $key => $val) {
				$mail = $val["mail"];
				$name = $val["name"];
				$date = $val["birth_date"];
				$phone = $val["phone"];
				$link_social = $val["link_social"];
				$role = $val["role"];
				$work_place = $val["work_place"];
				$city = $val["city"];
				if ($val["optional_equipment"] == "yes") { $optional_equipment = "да"; } 
				else { $optional_equipment = "нет"; }
				
				if ($name == NULL) {  } else {
					$table->addRow(null, array('tblHeader' => true));
					if ($ev_count % 2) { $cellVCentered = $sectionUserEven; } 
					else { $cellVCentered = $sectionUserOdd; }
					$table->addCell(1680, $cellVCentered) -> addText(
						$user_count.". ".$name, 
						array('bold' => false, 'size' => 12), 
						$fontUser
					);
					$table->addCell(1440, $cellVCentered) -> addText(
						$date, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1078, $cellVCentered) -> addText(
						$role, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1820, $cellVCentered) -> addText(
						$phone, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(2044, $cellVCentered) -> addText(
						$mail, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1820, $cellVCentered) -> addText(
						$link_social, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1442, $cellVCentered) -> addText(
						$city, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1442, $cellVCentered) -> addText(
						$work_place, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$table->addCell(1078, $cellVCentered) -> addText(
						$optional_equipment, 
						array('bold' => false, 'size' => 13), 
						$fontUser
					);
					$user_count++;
				}
				$ev_count++;
			}
		}

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

		header('Content-Disposition: attachment; filename="Отчет с инфомацией об участниках.docx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		
		ob_clean();
		$objWriter->save('php://output');
		exit;
	}

	function createReportSign() {
		$factory = (new Factory)->withServiceAccount('./php/hackathont-d9b44-ef6940892e5a.json');

		$database = $factory->createDatabase();
		$reference = $database->getReference('teams');
		$snapshot = $reference->getSnapshot();
		$data = $snapshot->getValue();

		$phpWord = new PhpWord(); 

		$phpWord -> setDefaultFontName('Arial');
		$phpWord -> setDefaultFontSize(14);

		$properties = $phpWord -> getDocInfo();

		$properties->setCreator('Morty');
		$properties->setCompany('ShineSquad');
		$properties->setTitle('Report');
		$properties->setDescription('This is my report');
		$properties->setCategory('My category');
		$properties->setLastModifiedBy('Morty');
		$properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
		$properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
		$properties->setSubject('My subject');
		$properties->setKeywords('my, key, word');

		$cellRowContinue = array(
			'vMerge' => 'continue',
			'valign' => 'center'
		);
		$cellRowRestart = array(
			'vMerge' => 'restart',
			'valign' => 'center'
		);
		$sectionStyle = array(
			'orientation' => 'landscape',
		);
		$cellHCentered = array(
			'align' => 'center'
		);
		$cellVCentered = array(
			'valign' => 'center'
		);
		$styleTable = array(
			'borderSize' => 6, 
			'borderColor' => '000000'
		);

		$sectionHr = array(
			'bgColor' => 'F4F4F4',
			'valign' => 'center'
		);
		$fontHr = array(
			'spaceAfter' => 400,
			'spaceBefore' => 400,
		);

		$sectionTeam = array(
			'bgColor' => 'DDDDDD',
			'valign' => 'center',
			'borderTopSize' => 20,
			'borderBottomSize' => 20
		);
		$fontTeam = array(
			'spaceAfter' => 250,
			'spaceBefore' => 250
		);

		$sectionUserEven = array(
			'bgColor' => 'F4F4F4',
			'valign' => 'center',
		);
		$sectionUserOdd = array(
			'bgColor' => 'FFFFFF',
			'valign' => 'center',
		);
		$fontUser = array(
			'spaceAfter' => 400,
			'spaceBefore' => 400
		);

		$section = $phpWord -> addSection($sectionStyle);

		$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
		$table = $section->addTable('Colspan Rowspan');
		$table->addRow(null, array('tblHeader' => true));
		$table->addCell(10500, $sectionHr)->addText(
			'ФИО', 
			array('bold' => true, 'size' => 16), 
			$fontHr
		);
		$table->addCell(3500, $sectionHr) -> addText(
			'Роспись', 
			array('bold' => true, 'size' => 16), 
			$fontHr
		);

		$team_count = 1;
		$user_count = 1;

		foreach ($data as $key => $value) {
			$ev_count = 1;
			$team_name = $value["team_name"];
			$participants = $value["participants"];
			$table->addRow(null, array('tblHeader' => true));
			$table->addCell(14000, $sectionTeam) -> addText(
				$team_count." - ".$team_name, 
				array('bold' => true), 
				$fontTeam
			);
			$team_count++;
			foreach ($participants as $key => $val) {
				$name = $val["name"];
				if ($name == NULL) {  } else {
					if ($ev_count % 2) { $cellVCentered = $sectionUserEven; } 
					else { $cellVCentered = $sectionUserOdd; }
					if ($ev_count % 2) {
						$table->addRow(null, array('tblHeader' => true));
						$table->addCell(10500, $$cellVCentered) -> addText(
							$user_count.". ".$name, 
							array('bold' => false, 'size' => 16), 
							$fontUser
						);
						$table->addCell(3500, $$cellVCentered) -> addText(
							'', 
							array('bold' => false, 'size' => 16), 
							$fontUser
						);
						$user_count++;
					} else {
						$table->addRow(null, array('tblHeader' => true));
						$table->addCell(10500, $sectionUserEven) -> addText(
							$user_count.". ".$name, 
							array('bold' => false, 'size' => 16), 
							$fontUser
						);
						$table->addCell(3500, $sectionUserEven) -> addText(
							'', 
							array('bold' => false, 'size' => 16), 
							$fontUser
						);
						$user_count++;
					}
					$ev_count++;
				}
			}
		}

		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

		header('Content-Disposition: attachment; filename="Отчет для сбора подписей.docx"');
		header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		
		ob_clean();
		$objWriter->save('php://output');
		exit;
	}

	if($_GET['infoReport']){
	   createReportInfo();
	}

	if($_GET['signReport']){
	   createReportSign();
	}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<title>Админка</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js" integrity="sha512-Hmp6qDy9imQmd15Ds1WQJ3uoyGCUz5myyr5ijainC1z+tP7wuXcze5ZZR3dF7+rkRALfNy7jcfgS5hH8wJ/2dQ==" crossorigin="anonymous"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-auth.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-database.js"></script>
		<script type="text/javascript" src="scripts/fb_init.js"></script>
		<script type="text/javascript" src="scripts/admin.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/admin.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<link rel="shortcut icon" href="images/logo.svg" type="image/png">
	</head>
	<body>
		<script type="text/javascript">
			window.onload = () => {
				fb_init();
				let user = localStorage.getItem("user");
				if (user == null) { window.location.href = "auth.html"; }
				else { createTable(); createTable2(); }
			}
		</script>
		<!-- <div>
			<form method="post" onSubmit="return false;" id="regAdmin">
				<input type="text" name="name" placeholder="Имя">
				<input type="password" name="password" placeholder="Пароль">
				<button onclick="reg()">Регистрация</button>
			</form>
			<hr>
		</div> -->
		<div class="container">
			<header>
				<div class="logo" onclick="window.location.href='index.php'">
					<img src="images/white_hackathont_logo.svg">
					<p>HackathoNT 1.0</p>
				</div>
				<ul class="navigation">
					
				</ul>
			</header>
			<div class="preview_list">
				<p class="title">Кабинет Администратора</p>
				<div class="link_container">
					<p class="item" onclick="openEvent()">Хакатон 5 Big Data 13-15 ноября</p>
					<p class="item" onclick="openEvent()">Хакатон 4 Голосовой помощник 4-6 декабря</p>
					<p class="item" onclick="openEvent()">Конференция 3 Smart House 13-15 ноября</p>
					<p class="item" onclick="openEvent()">Мини-хакатон 2 Arduino 6-8 ноября</p>
					<p class="item" onclick="openEvent()">Хакатон 1 Big Data 16-18 октября</p>
				</div>
			</div>
			<div class="tables">
				<div class="header_container" id="header_container">
					<svg width="352" height="22" viewBox="0 0 352 22" fill="none" xmlns="http://www.w3.org/2000/svg" id="back_admin" onclick="back_admin()">
						<path d="M0.292892 12.2929C-0.0976315 12.6834 -0.0976315 13.3166 0.292892 13.7071L6.65685 20.0711C7.04738 20.4616 7.68054 20.4616 8.07107 20.0711C8.46159 19.6805 8.46159 19.0474 8.07107 18.6569L2.41421 13L8.07107 7.34315C8.46159 6.95262 8.46159 6.31946 8.07107 5.92893C7.68054 5.53841 7.04738 5.53841 6.65685 5.92893L0.292892 12.2929ZM16 12L0.999999 12V14L16 14V12Z" fill="#6068F1"/>
						<path d="M35.12 13.1H32.52V19H29.96V5H32.52V10.86H35.2L39.22 5H41.98L37.2 11.78L42.16 19H39.22L35.12 13.1ZM47.7616 8.2C49.3349 8.2 50.5349 8.58 51.3616 9.34C52.2016 10.0867 52.6216 11.22 52.6216 12.74V19H50.2616V17.7C49.9549 18.1667 49.5149 18.5267 48.9416 18.78C48.3816 19.02 47.7016 19.14 46.9016 19.14C46.1016 19.14 45.4016 19.0067 44.8016 18.74C44.2016 18.46 43.7349 18.08 43.4016 17.6C43.0816 17.1067 42.9216 16.5533 42.9216 15.94C42.9216 14.98 43.2749 14.2133 43.9816 13.64C44.7016 13.0533 45.8282 12.76 47.3616 12.76H50.1216V12.6C50.1216 11.8533 49.8949 11.28 49.4416 10.88C49.0016 10.48 48.3416 10.28 47.4616 10.28C46.8616 10.28 46.2682 10.3733 45.6816 10.56C45.1082 10.7467 44.6216 11.0067 44.2216 11.34L43.2416 9.52C43.8016 9.09333 44.4749 8.76667 45.2616 8.54C46.0482 8.31333 46.8816 8.2 47.7616 8.2ZM47.4216 17.32C48.0482 17.32 48.6016 17.18 49.0816 16.9C49.5749 16.6067 49.9216 16.1933 50.1216 15.66V14.42H47.5416C46.1016 14.42 45.3816 14.8933 45.3816 15.84C45.3816 16.2933 45.5616 16.6533 45.9216 16.92C46.2816 17.1867 46.7816 17.32 47.4216 17.32ZM61.4952 8.84C62.5085 8.84 63.4018 9.06 64.1752 9.5C64.9485 9.92667 65.5485 10.5267 65.9752 11.3C66.4152 12.0733 66.6352 12.96 66.6352 13.96C66.6352 14.9867 66.3952 15.9 65.9152 16.7C65.4352 17.4867 64.7618 18.1 63.8952 18.54C63.0285 18.98 62.0418 19.2 60.9352 19.2C59.0818 19.2 57.6485 18.5867 56.6352 17.36C55.6218 16.1333 55.1152 14.3667 55.1152 12.06C55.1152 9.91333 55.5752 8.21333 56.4952 6.96C57.4152 5.70667 58.8218 4.88 60.7152 4.48L65.6752 3.42L66.0352 5.66L61.5352 6.58C60.2418 6.84667 59.2752 7.3 58.6352 7.94C57.9952 8.58 57.6218 9.48 57.5152 10.64C57.9952 10.0667 58.5752 9.62667 59.2552 9.32C59.9352 9 60.6818 8.84 61.4952 8.84ZM60.9952 17.18C61.9152 17.18 62.6552 16.8867 63.2152 16.3C63.7885 15.7 64.0752 14.94 64.0752 14.02C64.0752 13.1 63.7885 12.36 63.2152 11.8C62.6552 11.24 61.9152 10.96 60.9952 10.96C60.0618 10.96 59.3085 11.24 58.7352 11.8C58.1618 12.36 57.8752 13.1 57.8752 14.02C57.8752 14.9533 58.1618 15.7133 58.7352 16.3C59.3218 16.8867 60.0752 17.18 60.9952 17.18ZM69.055 8.32H71.555V15.36L77.455 8.32H79.735V19H77.235V11.96L71.355 19H69.055V8.32ZM83.098 8.32H85.598V12.66H90.978V8.32H93.478V19H90.978V14.78H85.598V19H83.098V8.32ZM106.828 13.72C106.828 13.8933 106.815 14.14 106.788 14.46H98.4084C98.5551 15.2467 98.9351 15.8733 99.5484 16.34C100.175 16.7933 100.948 17.02 101.868 17.02C103.042 17.02 104.008 16.6333 104.768 15.86L106.108 17.4C105.628 17.9733 105.022 18.4067 104.288 18.7C103.555 18.9933 102.728 19.14 101.808 19.14C100.635 19.14 99.6018 18.9067 98.7084 18.44C97.8151 17.9733 97.1218 17.3267 96.6284 16.5C96.1484 15.66 95.9084 14.7133 95.9084 13.66C95.9084 12.62 96.1418 11.6867 96.6084 10.86C97.0884 10.02 97.7484 9.36667 98.5884 8.9C99.4284 8.43333 100.375 8.2 101.428 8.2C102.468 8.2 103.395 8.43333 104.208 8.9C105.035 9.35333 105.675 10 106.128 10.84C106.595 11.6667 106.828 12.6267 106.828 13.72ZM101.428 10.2C100.628 10.2 99.9484 10.44 99.3884 10.92C98.8418 11.3867 98.5084 12.0133 98.3884 12.8H104.448C104.342 12.0267 104.015 11.4 103.468 10.92C102.922 10.44 102.242 10.2 101.428 10.2ZM117.632 10.44H113.892V19H111.392V10.44H107.632V8.32H117.632V10.44ZM128.953 8.2C130.526 8.2 131.726 8.58 132.553 9.34C133.393 10.0867 133.813 11.22 133.813 12.74V19H131.453V17.7C131.146 18.1667 130.706 18.5267 130.133 18.78C129.573 19.02 128.893 19.14 128.093 19.14C127.293 19.14 126.593 19.0067 125.993 18.74C125.393 18.46 124.926 18.08 124.593 17.6C124.273 17.1067 124.113 16.5533 124.113 15.94C124.113 14.98 124.466 14.2133 125.173 13.64C125.893 13.0533 127.02 12.76 128.553 12.76H131.313V12.6C131.313 11.8533 131.086 11.28 130.633 10.88C130.193 10.48 129.533 10.28 128.653 10.28C128.053 10.28 127.46 10.3733 126.873 10.56C126.3 10.7467 125.813 11.0067 125.413 11.34L124.433 9.52C124.993 9.09333 125.666 8.76667 126.453 8.54C127.24 8.31333 128.073 8.2 128.953 8.2ZM128.613 17.32C129.24 17.32 129.793 17.18 130.273 16.9C130.766 16.6067 131.113 16.1933 131.313 15.66V14.42H128.733C127.293 14.42 126.573 14.8933 126.573 15.84C126.573 16.2933 126.753 16.6533 127.113 16.92C127.473 17.1867 127.973 17.32 128.613 17.32ZM148.307 16.88V21.38H145.967V19H137.727V21.38H135.407V16.88H135.907C136.587 16.8533 137.047 16.42 137.287 15.58C137.54 14.7267 137.707 13.5267 137.787 11.98L137.927 8.32H146.727V16.88H148.307ZM140.067 12.16C140.013 13.3867 139.913 14.3867 139.767 15.16C139.62 15.9333 139.353 16.5067 138.967 16.88H144.227V10.44H140.127L140.067 12.16ZM161.039 19V11.92L157.439 17.88H156.359L152.819 11.9V19H150.539V8.32H153.159L156.959 15L160.939 8.32H163.279L163.299 19H161.039ZM166.653 8.32H169.153V15.36L175.053 8.32H177.333V19H174.833V11.96L168.953 19H166.653V8.32ZM180.696 8.32H183.196V12.66H188.576V8.32H191.076V19H188.576V14.78H183.196V19H180.696V8.32ZM198.406 8.2C199.979 8.2 201.179 8.58 202.006 9.34C202.846 10.0867 203.266 11.22 203.266 12.74V19H200.906V17.7C200.599 18.1667 200.159 18.5267 199.586 18.78C199.026 19.02 198.346 19.14 197.546 19.14C196.746 19.14 196.046 19.0067 195.446 18.74C194.846 18.46 194.379 18.08 194.046 17.6C193.726 17.1067 193.566 16.5533 193.566 15.94C193.566 14.98 193.919 14.2133 194.626 13.64C195.346 13.0533 196.473 12.76 198.006 12.76H200.766V12.6C200.766 11.8533 200.539 11.28 200.086 10.88C199.646 10.48 198.986 10.28 198.106 10.28C197.506 10.28 196.913 10.3733 196.326 10.56C195.753 10.7467 195.266 11.0067 194.866 11.34L193.886 9.52C194.446 9.09333 195.119 8.76667 195.906 8.54C196.693 8.31333 197.526 8.2 198.406 8.2ZM198.066 17.32C198.693 17.32 199.246 17.18 199.726 16.9C200.219 16.6067 200.566 16.1933 200.766 15.66V14.42H198.186C196.746 14.42 196.026 14.8933 196.026 15.84C196.026 16.2933 196.206 16.6533 196.566 16.92C196.926 17.1867 197.426 17.32 198.066 17.32Z" fill="#6068F1"/>
					</svg>
					<p id="title">
						Хакатон 1 Big Data 16-18 октября
					</p>
				</div>
				<div class="button_container">
					<button class="all_btn active_btn" onclick="switchAllTable()">Полная таблица</button>
					<button class="small_btn" onclick="switchShortTable()">Краткая таблица</button>
				</div>
				<div class="main_container">
					<div class="all_container">
						<a href="admin.php?infoReport=1" class="btn">Скачать документ</a>
						<table id="team_list1" border="1">
							<tr>
								<th>ФИО</th>
								<th>Дата 
									рождения</th>
								<th>Роли</th>
								<th>Телефон</th>
								<th>E-MAIL</th>
								<th>Соц. сети</th>
								<th>Город</th>
								<th>Место 
									работы / 
									учебы</th>
								<th>Нужно 
									ли доп. 
									оборуд.</th>
							</tr>
						</table>
					</div>
					<div class="short_container">
						<a href="admin.php?signReport=1" class="btn">Скачать документ</a>
						<table id="team_list2" border="1">
							<tr>
								<th>ФИО</th>
								<th>Росписи</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<footer>
				<p class="connect">Связь с нами:</p>
				<div class="content">
					<div class="social">
						<div class="icons">
							<a href="https://www.instagram.com/hackatho.nt/?r=nametag" target="_blank">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M15.999 32C24.8356 32 31.999 24.8366 31.999 16C31.999 7.16344 24.8356 0 15.999 0C7.16247 0 -0.000976562 7.16344 -0.000976562 16C-0.000976562 24.8366 7.16247 32 15.999 32ZM25.5846 17.2323V17.2319V17.2315C25.5871 16.8215 25.5896 16.4117 25.5896 16.0023V11.7687C25.5896 10.6541 25.2646 9.64023 24.5912 8.7579C23.3838 7.179 21.7469 6.42825 19.7848 6.41277C17.9797 6.39618 16.1727 6.39934 14.3664 6.4025H14.3663C13.644 6.40377 12.9218 6.40503 12.1999 6.40503C11.2363 6.4089 10.3114 6.59852 9.46006 7.04356C7.50191 8.07294 6.399 9.65571 6.399 11.9196V20.2398C6.399 21.2885 6.68924 22.256 7.29681 23.1073C8.45389 24.7249 10.0676 25.5454 12.0296 25.5841C13.9397 25.6209 15.8519 25.6121 17.7631 25.6032C18.4579 25.5999 19.1524 25.5967 19.8468 25.5957C20.6788 25.5957 21.4837 25.4215 22.2499 25.0926C24.1578 24.2722 25.6554 22.4301 25.5974 20.0463C25.5731 19.1093 25.5789 18.1705 25.5846 17.2324V17.2323ZM7.82698 20.2591V16.0023C7.82698 15.6019 7.83011 15.2014 7.83324 14.8009V14.8009C7.84056 13.866 7.84788 12.9305 7.81537 11.9931C7.75345 10.0156 9.07694 8.67277 10.501 8.1426C11.0196 7.9491 11.5537 7.83688 12.107 7.83688C12.7171 7.83597 13.3272 7.8342 13.9372 7.83243C15.92 7.82669 17.9027 7.82094 19.8855 7.84462C21.356 7.8601 22.5866 8.45219 23.4767 9.65571C23.9372 10.2826 24.1578 10.9947 24.1578 11.7725C24.1578 12.5968 24.1567 13.4211 24.1557 14.2454C24.1533 16.1687 24.1508 18.092 24.1617 20.0153C24.1694 21.8109 23.2909 23.0067 21.7198 23.7575C21.1432 24.0322 20.524 24.1638 19.8855 24.1638C19.3652 24.1654 18.845 24.1675 18.3248 24.1697H18.3248H18.3248C16.2446 24.1784 14.1649 24.187 12.0877 24.1561C10.4701 24.129 9.16595 23.4402 8.30297 22.0277C7.97403 21.4897 7.82698 20.8938 7.82698 20.2591ZM16.0158 20.1046C13.5197 20.1046 11.5074 18.1155 11.5035 15.6388C11.4996 13.2007 13.5274 11.2039 16.008 11.2039C18.4963 11.2 20.5164 13.193 20.5203 15.6504C20.5203 18.1039 18.5041 20.1007 16.0158 20.1046ZM16.0158 18.6727C17.7146 18.6727 19.0923 17.3144 19.0884 15.6426C19.0846 13.9863 17.7069 12.6319 16.0158 12.6319C14.3169 12.6319 12.9315 13.9825 12.9315 15.6504C12.9353 17.3221 14.3169 18.6766 16.0158 18.6727ZM21.9909 10.8401C21.9909 10.2945 21.5652 9.84942 21.0427 9.84942C20.5203 9.84942 20.0946 10.2983 20.0985 10.844C20.0985 11.378 20.5203 11.8192 21.035 11.8231C21.5574 11.8269 21.987 11.3858 21.9909 10.8401Z" fill="white"/>
								</svg>
							</a>
							<a href="https://vk.com/hackathont" target="_blank">
								<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M14.8564 0.0399132C11.0366 0.323816 7.55236 1.89449 4.81657 4.5676C1.21802 8.07766 -0.507513 13.0478 0.130345 18.04C0.926746 24.2822 5.32907 29.4809 11.3758 31.3208C16.051 32.744 21.2534 31.8996 25.217 29.079C30.0876 25.6095 32.6206 19.8541 31.8684 13.9622C31.072 7.72002 26.6697 2.52129 20.6229 0.681459C18.8236 0.13209 16.7257 -0.100193 14.8564 0.0399132ZM16.0768 9.95436C16.8953 10.0355 17.3046 10.1645 17.4889 10.4042C17.5369 10.4706 17.6143 10.6328 17.6585 10.7655C17.7544 11.0457 17.7581 11.3665 17.6991 13.7631C17.6622 15.26 17.6843 15.7209 17.806 16.0527C17.9498 16.4325 18.2669 16.6058 18.5471 16.462C18.8015 16.3293 19.3951 15.6767 19.7823 15.0978C20.6782 13.7705 21.2239 12.7418 21.8802 11.1527C22.0129 10.8393 22.1899 10.6328 22.3743 10.5849C22.448 10.5627 23.4914 10.5443 24.7745 10.5406L27.0421 10.5332L27.2338 10.6143C27.4808 10.725 27.5767 10.8688 27.5767 11.1305C27.5767 11.6283 27.0568 12.6496 26.1645 13.8995C26.0429 14.0728 25.582 14.6848 25.1432 15.2637C24.1735 16.5394 23.9634 16.8381 23.8159 17.1478C23.6315 17.5386 23.6758 17.8594 23.9671 18.2391C24.0519 18.3461 24.4796 18.7775 24.9183 19.1978C26.1461 20.3739 26.7028 20.9934 27.1564 21.6718C27.4808 22.1622 27.6062 22.5235 27.5546 22.8332C27.5287 23.0028 27.3591 23.2056 27.1674 23.3051C26.9388 23.4194 26.5886 23.4416 24.6602 23.4674L22.8351 23.4932L22.5402 23.3936C21.788 23.1429 21.2866 22.7263 20.1473 21.4063C19.5168 20.6763 19.0486 20.3186 18.7241 20.315C18.4254 20.315 18.0457 20.7132 17.8834 21.2072C17.7728 21.5391 17.7323 21.7935 17.6991 22.3686C17.6585 23.047 17.5774 23.2056 17.1608 23.3789C17.0096 23.4452 15.1292 23.4674 14.6315 23.4158C13.6323 23.3051 12.7068 22.9917 11.7888 22.4497C10.4577 21.6681 9.64291 20.9676 8.76908 19.8541C7.25002 17.9147 6.21396 16.2629 4.95668 13.7705C4.46999 12.8008 3.8985 11.5472 3.80632 11.2485C3.71415 10.9388 3.84688 10.6844 4.14922 10.5885C4.25246 10.5554 4.82763 10.5369 6.15497 10.5185L8.01693 10.5L8.23446 10.5812C8.57736 10.7139 8.72115 10.8835 8.95343 11.4476C9.15253 11.9232 10.2255 14.0765 10.561 14.6775C10.9039 15.2858 11.2689 15.7946 11.5823 16.097C11.9694 16.4767 12.1427 16.5689 12.4156 16.5468C12.6478 16.5247 12.7105 16.4731 12.8543 16.1597C13.2046 15.4038 13.2599 12.8487 12.9465 11.8458C12.7658 11.2743 12.4967 11.0568 11.7519 10.8982C11.6229 10.8688 11.6229 10.8245 11.7408 10.6512C12.0284 10.2383 12.5409 10.0392 13.518 9.95805C14.0526 9.91381 15.638 9.91012 16.0768 9.95436Z" fill="white"/>
								</svg>
							</a>
						</div>
						<a target="_blank" href="mailto:shinesquad.tech@gmail.com"><p class="mail">shinesquad.tech@gmail.com</p></a>
					</div>
					<div class="madeby">© HackathoNT 2020</div>
				</div>
			</footer>
		</div>
	</body>
</html>