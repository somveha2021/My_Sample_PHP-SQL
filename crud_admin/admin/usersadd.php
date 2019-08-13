<?php
namespace PHPMaker2019\Crud_Admin;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusersadd = currentForm = new ew.Form("fusersadd", "add");

// Validate form
fusersadd.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($users_add->username->Required) { ?>
			elm = this.getElements("x" + infix + "_username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->username->caption(), $users->username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->full_name->Required) { ?>
			elm = this.getElements("x" + infix + "_full_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->full_name->caption(), $users->full_name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->password->Required) { ?>
			elm = this.getElements("x" + infix + "_password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->password->caption(), $users->password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($users_add->created_at->Required) { ?>
			elm = this.getElements("x" + infix + "_created_at");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->created_at->caption(), $users->created_at->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_created_at");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($users->created_at->errorMessage()) ?>");
		<?php if ($users_add->group_id->Required) { ?>
			elm = this.getElements("x" + infix + "_group_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users->group_id->caption(), $users->group_id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_group_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($users->group_id->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusersadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($users_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $users_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($users->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_users_username" for="x_username" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->username->caption() ?><?php echo ($users->username->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->username->cellAttributes() ?>>
<span id="el_users_username">
<input type="text" data-table="users" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($users->username->getPlaceHolder()) ?>" value="<?php echo $users->username->EditValue ?>"<?php echo $users->username->editAttributes() ?>>
</span>
<?php echo $users->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->full_name->Visible) { // full_name ?>
	<div id="r_full_name" class="form-group row">
		<label id="elh_users_full_name" for="x_full_name" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->full_name->caption() ?><?php echo ($users->full_name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->full_name->cellAttributes() ?>>
<span id="el_users_full_name">
<input type="text" data-table="users" data-field="x_full_name" name="x_full_name" id="x_full_name" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($users->full_name->getPlaceHolder()) ?>" value="<?php echo $users->full_name->EditValue ?>"<?php echo $users->full_name->editAttributes() ?>>
</span>
<?php echo $users->full_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->password->Visible) { // password ?>
	<div id="r_password" class="form-group row">
		<label id="elh_users_password" for="x_password" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->password->caption() ?><?php echo ($users->password->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->password->cellAttributes() ?>>
<span id="el_users_password">
<input type="text" data-table="users" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($users->password->getPlaceHolder()) ?>" value="<?php echo $users->password->EditValue ?>"<?php echo $users->password->editAttributes() ?>>
</span>
<?php echo $users->password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->created_at->Visible) { // created_at ?>
	<div id="r_created_at" class="form-group row">
		<label id="elh_users_created_at" for="x_created_at" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->created_at->caption() ?><?php echo ($users->created_at->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->created_at->cellAttributes() ?>>
<span id="el_users_created_at">
<input type="text" data-table="users" data-field="x_created_at" name="x_created_at" id="x_created_at" placeholder="<?php echo HtmlEncode($users->created_at->getPlaceHolder()) ?>" value="<?php echo $users->created_at->EditValue ?>"<?php echo $users->created_at->editAttributes() ?>>
<?php if (!$users->created_at->ReadOnly && !$users->created_at->Disabled && !isset($users->created_at->EditAttrs["readonly"]) && !isset($users->created_at->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fusersadd", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $users->created_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users->group_id->Visible) { // group_id ?>
	<div id="r_group_id" class="form-group row">
		<label id="elh_users_group_id" for="x_group_id" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users->group_id->caption() ?><?php echo ($users->group_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div<?php echo $users->group_id->cellAttributes() ?>>
<span id="el_users_group_id">
<input type="text" data-table="users" data-field="x_group_id" name="x_group_id" id="x_group_id" size="30" placeholder="<?php echo HtmlEncode($users->group_id->getPlaceHolder()) ?>" value="<?php echo $users->group_id->EditValue ?>"<?php echo $users->group_id->editAttributes() ?>>
</span>
<?php echo $users->group_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$users_add->terminate();
?>
