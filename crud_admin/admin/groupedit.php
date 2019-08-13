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
$group_edit = new group_edit();

// Run the page
$group_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$group_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fgroupedit = currentForm = new ew.Form("fgroupedit", "edit");

// Validate form
fgroupedit.validate = function() {
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
		<?php if ($group_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $group->id->caption(), $group->id->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($group->id->errorMessage()) ?>");
		<?php if ($group_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $group->name->caption(), $group->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($group_edit->role->Required) { ?>
			elm = this.getElements("x" + infix + "_role");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $group->role->caption(), $group->role->RequiredErrorMessage)) ?>");
		<?php } ?>

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
fgroupedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fgroupedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $group_edit->showPageHeader(); ?>
<?php
$group_edit->showMessage();
?>
<form name="fgroupedit" id="fgroupedit" class="<?php echo $group_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($group_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $group_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="group">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$group_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($group->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_group_id" for="x_id" class="<?php echo $group_edit->LeftColumnClass ?>"><?php echo $group->id->caption() ?><?php echo ($group->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $group_edit->RightColumnClass ?>"><div<?php echo $group->id->cellAttributes() ?>>
<span id="el_group_id">
<span<?php echo $group->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($group->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="group" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($group->id->CurrentValue) ?>">
<?php echo $group->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($group->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_group_name" for="x_name" class="<?php echo $group_edit->LeftColumnClass ?>"><?php echo $group->name->caption() ?><?php echo ($group->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $group_edit->RightColumnClass ?>"><div<?php echo $group->name->cellAttributes() ?>>
<span id="el_group_name">
<input type="text" data-table="group" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($group->name->getPlaceHolder()) ?>" value="<?php echo $group->name->EditValue ?>"<?php echo $group->name->editAttributes() ?>>
</span>
<?php echo $group->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($group->role->Visible) { // role ?>
	<div id="r_role" class="form-group row">
		<label id="elh_group_role" for="x_role" class="<?php echo $group_edit->LeftColumnClass ?>"><?php echo $group->role->caption() ?><?php echo ($group->role->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $group_edit->RightColumnClass ?>"><div<?php echo $group->role->cellAttributes() ?>>
<span id="el_group_role">
<input type="text" data-table="group" data-field="x_role" name="x_role" id="x_role" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($group->role->getPlaceHolder()) ?>" value="<?php echo $group->role->EditValue ?>"<?php echo $group->role->editAttributes() ?>>
</span>
<?php echo $group->role->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$group_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $group_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $group_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$group_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$group_edit->terminate();
?>
