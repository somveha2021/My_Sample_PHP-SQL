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
$employees_edit = new employees_edit();

// Run the page
$employees_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var femployeesedit = currentForm = new ew.Form("femployeesedit", "edit");

// Validate form
femployeesedit.validate = function() {
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
		<?php if ($employees_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->id->caption(), $employees->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->name->caption(), $employees->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->address->Required) { ?>
			elm = this.getElements("x" + infix + "_address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->address->caption(), $employees->address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->salary->Required) { ?>
			elm = this.getElements("x" + infix + "_salary");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->salary->caption(), $employees->salary->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($employees_edit->photo->Required) { ?>
			elm = this.getElements("x" + infix + "_photo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employees->photo->caption(), $employees->photo->RequiredErrorMessage)) ?>");
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
femployeesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $employees_edit->showPageHeader(); ?>
<?php
$employees_edit->showMessage();
?>
<form name="femployeesedit" id="femployeesedit" class="<?php echo $employees_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$employees_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($employees->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_employees_id" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->id->caption() ?><?php echo ($employees->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->id->cellAttributes() ?>>
<span id="el_employees_id">
<span<?php echo $employees->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($employees->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="employees" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($employees->id->CurrentValue) ?>">
<?php echo $employees->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_employees_name" for="x_name" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->name->caption() ?><?php echo ($employees->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->name->cellAttributes() ?>>
<span id="el_employees_name">
<input type="text" data-table="employees" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees->name->getPlaceHolder()) ?>" value="<?php echo $employees->name->EditValue ?>"<?php echo $employees->name->editAttributes() ?>>
</span>
<?php echo $employees->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees->address->Visible) { // address ?>
	<div id="r_address" class="form-group row">
		<label id="elh_employees_address" for="x_address" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->address->caption() ?><?php echo ($employees->address->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->address->cellAttributes() ?>>
<span id="el_employees_address">
<input type="text" data-table="employees" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees->address->getPlaceHolder()) ?>" value="<?php echo $employees->address->EditValue ?>"<?php echo $employees->address->editAttributes() ?>>
</span>
<?php echo $employees->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees->salary->Visible) { // salary ?>
	<div id="r_salary" class="form-group row">
		<label id="elh_employees_salary" for="x_salary" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->salary->caption() ?><?php echo ($employees->salary->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->salary->cellAttributes() ?>>
<span id="el_employees_salary">
<input type="text" data-table="employees" data-field="x_salary" name="x_salary" id="x_salary" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($employees->salary->getPlaceHolder()) ?>" value="<?php echo $employees->salary->EditValue ?>"<?php echo $employees->salary->editAttributes() ?>>
</span>
<?php echo $employees->salary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($employees->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_employees_photo" for="x_photo" class="<?php echo $employees_edit->LeftColumnClass ?>"><?php echo $employees->photo->caption() ?><?php echo ($employees->photo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $employees_edit->RightColumnClass ?>"><div<?php echo $employees->photo->cellAttributes() ?>>
<span id="el_employees_photo">
<input type="text" data-table="employees" data-field="x_photo" name="x_photo" id="x_photo" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($employees->photo->getPlaceHolder()) ?>" value="<?php echo $employees->photo->EditValue ?>"<?php echo $employees->photo->editAttributes() ?>>
</span>
<?php echo $employees->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$employees_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $employees_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$employees_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$employees_edit->terminate();
?>
