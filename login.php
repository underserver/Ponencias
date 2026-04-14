<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para iniciar sesion
 *
***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$sselected = 1; $subtitle = $_i18n["login.submenu"]; $selected = $_GET[ "sm" ];
$items = array( $_i18n["login.submenu"], $_i18n["register.submenu"] ); $links = array( "./login.php", "./register.php" );
include("includes/header.php");
?>
<div align="center" id="content"><?php if( isset( $_GET[ "id" ] ) ){ ?>
<div align="center" class="msg">
<div class="bl3">
<div class="br">
<div class="tl">
<div class="tr2"><?=$_i18n[ "logine".base64_decode( $_GET[ "id" ] ) ]?>
</div>
</div>
</div>
</div>
</div>
<br>
<?php } $fields = " ".base64_decode( $_GET[ "tk" ] );	?>
<style>
.f {
	border-top: solid 1px #bbbbbb;
	color: #676767;
	font-size: 12px;
	padding-top: 5px;
	margin-top: 15px
}

.f span {
	position: relative;
	bottom: 7px
}

.errormsg {
	color: #cc0000
}

.alert {
	color: #FF0000
}

.x {
	background-color: #ddf8cc;
	border: solid 1px #80c65a;
	padding: 15px;
	margin: 0 15px 0 0;
	text-align: center;
}

.x,.x td {
	font-size: 12px
}

.x table {
	margin: 0px;
	text-align: left;
}

.x p {
	text-align: left;
}

.x h2 {
	margin: 0 0 0 0;
	font-weight: bold;
	font-size: 12px;
}
</style>


<div class="login-container">
    <form action="action_login.php" method="post" name="settings" class="login-form">
        <h2 class="section-header">&nbsp;Entrar al sistema</h2>
        <div class="form-group">
            <label for="userName" class="form-label"><?=$_i18n[ "user" ]?> :</label>
            <input id="userName" name="userName" type="text" class="input-text rounded"> 
            <?php if( strpos( $fields, 'userName' ) ){?>
            <span class="errormsg" id="errormsg_0"> <?=$_i18n[ "error.required" ]?></span>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="userPassword" class="form-label"><?=$_i18n[ "pass" ]?> :</label>
            <input id="userPassword" name="userPassword" type="password" class="input-text rounded"> 
            <?php if( strpos( $fields, 'userPassword' ) ){?>
            <span class="errormsg" id="errormsg_0"> <?=$_i18n[ "error.required" ]?></span>
            <?php } ?>
        </div>
        <div class="form-group">
            <input value="<?=$_i18n[ "access" ]?>" type="submit" class="submit-button">
        </div>
    </form>
</div>
</div>
<script type="text/javascript" language="JavaScript">
	  <!--
	  var focusControl = document.forms["login"].elements["userName"];
	  if (focusControl.type != "hidden" && !focusControl.disabled) {
	     focusControl.focus();
	  }
	  // -->
	</script>
<?php include("./includes/foot.php");?>

</body>
</html>
