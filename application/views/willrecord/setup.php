<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
	
	<meta name="author" content="AsuraWorks" />
	<meta name="dcterms.rightsHolder" content="AsuraWorks" />
	<meta name="robots" content="none" />
	<meta name="googlebot" content="none" />
	
	<title><?php echo $title;?></title>
	<base href="<?php echo base_url();?>"/>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/logo/willrecord.ico" >
	<link href="assets/css/common/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/common/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/public.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/willrecord/setup.css" rel="stylesheet" type="text/css" />
</head>

<body ontouchstart="">
<input type="hidden" id="mid" name="mid" value="<?php echo $mid;?>">
<input type="hidden" id="cropx" name="cropx" value="0">
<input type="hidden" id="cropy" name="cropy" value="0">
<input type="hidden" id="cropw" name="cropw" value="300">
<input type="hidden" id="croph" name="croph" value="300">
<input type="hidden" id="editpic" name="editpic" value="<?php echo $editpic;?>">

	<?php $this->load->view('willrecord/menu'); ?>
	
	<div class="main">
		<div class="container">
			<?php echo $record_topic_html; ?>
			<div class="col-xs-12 col-md-6">
				<form name="form" action="" method="POST" name="FileForm" enctype="multipart/form-data">
					<div class="avaterPic" id="avaterPic">
						<div class="avaterPicBorder">
							<img src="<?php echo $head_img;?>" id="my_image">
						</div>
						<div class="avaterPic_loading" id="loading">
							<img src="assets/img/backgrounds/loading.gif">
						</div>
					</div>
					<div class="imgeditarea">
						<div class="imgdefault">
							<img src="<?php echo $head_img_src;?>" id="imageEdit">
						</div>
					</div>
					<div class="edit_div">
						<div class="form-group">
							<label for="exampleInputFile">上傳照片</label>
							<input type="file" id="pic_upload" name="pic_upload">
							<p class="help-block">請選擇 jpg、png、gif 檔案格式</p>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">編輯照片</label>
							<button type="button" class="btn btn-default" id="edit_show" <?php echo $updateLock;?> >選取範圍</button>
							<div class="edit_submit">
								<button type="button" class="btn btn-success btn_submit" id="position_save">送出</button>
								<button type="button" class="btn btn-default btn_submit" id="edit_cancel">取消</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-12 col-md-6 edit_detail">
				<form role="form">
					<div class="form-group">
						<label for="memberEmail">電子郵件</label><br/>
						<span class="membermail"><?php echo $memberEmail;?></span>
					</div>
					<div class="form-group">
						<label for="memberName">暱稱</label>
						<input type="text" class="form-control" id="memberName" value="<?php echo $memberName;?>" maxlength="10">
					</div>
					<div class="form-group">
						<label for="memberGender">性別</label><br>
						<label class="radio-inline">
							<input type="radio" name="memberGender" id="woman" value="2" <?php echo $memberGender[2];?>>女
						</label>
						<label class="radio-inline">
							<input type="radio" name="memberGender" id="man" value="1" <?php echo $memberGender[1];?>>男
						</label>
					</div>
					<div class="form-group">
						<label for="birthdaty">出生日</label>
						<div class="form-inline">
							<select class="form-control" name="birthdaty_year" id="birthday_year">
								<?php echo $memberBirthday_y;?>
							</select> 年 
							<select class="form-control" name="birthdaty_month" id="birthdaty_month">
								<?php echo $memberBirthday_m;?>
							</select> 月  
							<select class="form-control" name="birthdaty_day" id="birthdaty_day">
								<?php echo $memberBirthday_d;?>
							</select> 日
						</div>
					</div>
					<div class="form-group">
						<label for="memberDescription">個人簡介</label>
						<textarea class="form-control" rows="6" name="memberDescription" id="memberDescription" maxlength="1000"><?php echo $memberDescription;?></textarea>
					</div>
					<button type="button" class="btn btn-default" id="memberSave">儲存</button>
					<div class="memberData_loading" id="m_loading">
						<img src="assets/img/backgrounds/loading.gif">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- FOOTER -->
	<?php $this->load->view('willrecord/footer'); ?>

<script type="text/javascript" src="assets/js/common/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="assets/js/common/ajaxfileupload.js"></script>
<script type="text/javascript" src="assets/js/common/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/common/holder.js"></script>
<script type="text/javascript" src="assets/js/common/jquery.Jcrop.min.js"></script>
<script type="text/javascript">var BASE = '<?php echo base_url();?>';</script>
<script type="text/javascript" src="assets/js/willrecord/public.js"></script>
<script type="text/javascript" src="assets/js/willrecord/setup.js"></script> 
</body>
</html>