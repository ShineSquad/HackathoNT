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
			<div class="tables">
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