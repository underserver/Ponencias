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
<main id="content" style="text-align:center;">
    <section role="alert" aria-live="polite">
        <?php if( isset( $_GET[ "id" ] ) ){ ?>
        <div class="msg bl3">
            <div class="br">
                <div class="tl">
                    <div class="tr2">
                        <?= $_i18n[ "logine" . base64_decode( $_GET[ "id" ] ) ] ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php } ?>
    </section>
    <?php $fields = " " . base64_decode( $_GET[ "tk" ] );?>
    <form action="action_login.php" method="post" name="login">
        <fieldset style="width:300px; margin:auto;">
            <legend class="section">&nbsp;Entrar al sistema</legend>
            <div style="margin:15px 0 0;">
                <label for="userName" style="display:block;">
                    <?=$_i18n[ "user" ]?><span aria-hidden="true"> :&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </label>
                <input id="userName" name="userName" size="35" type="text" class="rounded" required
                       aria-describedby="errormsg_user">
                <?php if( strpos( $fields, 'userName' ) ){?>
                <span class="errormsg" id="errormsg_user"> <?=$_i18n[ "error.required" ]?></span>
                <?php } ?>
            </div>
            <div style="margin:15px 0 0;">
                <label for="userPassword" style="display:block;">
                    <?=$_i18n[ "pass" ]?><span aria-hidden="true"> :&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </label>
                <input id="userPassword" name="userPassword" size="35" type="password" class="rounded" required
                       aria-describedby="errormsg_pass">
                <?php if( strpos( $fields, 'userPassword' ) ){?>
                <span class="errormsg" id="errormsg_pass"> <?=$_i18n[ "error.required" ]?></span>
                <?php } ?>
            </div>
            <div style="margin-top:15px;">
                <button type="submit" value="<?=$_i18n[ "access" ]?>">
                    <?=$_i18n[ "access" ]?>
                </button>
            </div>
        </fieldset>
    </form>
</main>
<script type="text/javascript">
    window.onload = function(){
        var focusControl = document.forms["login"].elements["userName"];
        if (focusControl.type != "hidden" && !focusControl.disabled) {
            focusControl.focus();
        }
    };
</script>
</html>
