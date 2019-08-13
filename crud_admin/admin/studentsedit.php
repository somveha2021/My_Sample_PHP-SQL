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
$students_edit = new students_edit();

// Run the page
$students_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$students_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fstudentsedit = currentForm = new ew.Form("fstudentsedit", "edit");

// Validate form
fstudentsedit.validate = function() {
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
		<?php if ($students_edit->stu_id->Required) { ?>
			elm = this.getElements("x" + infix + "_stu_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $students->stu_id->caption(), $students->stu_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($students_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $students->name->caption(), $students->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($students_edit->gender->Required) { ?>
			elm = this.getElements("x" + infix + "_gender");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $students->gender->caption(), $students->gender->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($students_edit->bod->Required) { ?>
			elm = this.getElements("x" + infix + "_bod");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $students->bod->caption(), $students->bod->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($students_edit->pob->Required) { ?>
			elm = this.getElements("x" + infix + "_pob");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $students->pob->caption(), $students->pob->RequiredErrorMessage)) ?>");
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
fstudentsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fstudentsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $students_edit->showPageHeader(); ?>
<?php
$students_edit->showMessage();
?>
<form name="fstudentsedit" id="fstudentsedit" class="<?php echo $students_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($students_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $students_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="students">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$students_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($students->stu_id->Visible) { // stu_id ?>
	<div id="r_stu_id" class="form-group row">
		<label id="elh_students_stu_id" class="<?php echo $students_edit->LeftColumnClass ?>"><?php echo $students->stu_id->caption() ?><?php echo ($students->stu_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $students_edit->RightColumnClass ?>"><div<?php echo $students->stu_id->cellAttributes() ?>>
<span id="el_students_stu_id">
<span<?php echo $students->stu_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($students->stu_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="students" data-field="x_stu_id" name="x_stu_id" id="x_stu_id" value="<?php echo HtmlEncode($students->stu_id->CurrentValue) ?>">
<?php echo $students->stu_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_students_name" for="x_name" class="<?php echo $students_edit->LeftColumnClass ?>"><?php echo $students->name->caption() ?><?php echo ($students->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $students_edit->RightColumnClass ?>"><div<?php echo $students->name->cellAttributes() ?>>
<span id="el_students_name">
<input type="text" data-table="students" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($students->name->getPlaceHolder()) ?>" value="<?php echo $students->name->EditValue ?>"<?php echo $students->name->editAttributes() ?>>
</span>
<?php echo $students->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
	<div id="r_gender" class="form-group row">
		<label id="elh_students_gender" for="x_gender" class="<?php echo $students_edit->LeftColumnClass ?>"><?php echo $students->gender->caption() ?><?php echo ($students->gender->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $students_edit->RightColumnClass ?>"><div<?php echo $students->gender->cellAttributes() ?>>
<span id="el_students_gender">
<input type="text" data-table="students" data-field="x_gender" name="x_gender" id="x_gender" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($students->gender->getPlaceHolder()) ?>" value="<?php echo $students->gender->EditValue ?>"<?php echo $students->gender->editAttributes() ?>>
</span>
<?php echo $students->gender->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($students->bod->Visible) { // bod ?>
	<div id="r_bod" class="form-group row">
		<label id="elh_students_bod" for="x_bod" class="<?php echo $students_edit->LeftColumnClass ?>"><?php echo $students->bod->caption() ?><?php echo ($students->bod->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $students_edit->RightColumnClass ?>"><div<?php echo $students->bod->cellAttributes() ?>>
<span id="el_students_bod">
<input type="text" data-table="students" data-field="x_bod" name="x_bod" id="x_bod" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($students->bod->getPlaceHolder()) ?>" value="<?php echo $students->bod->EditValue ?>"<?php echo $students->bod->editAttributes() ?>>
</span>
<?php echo $students->bod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($students->pob->Visible) { // pob ?>
	<div id="r_pob" class="form-group row">
		<label id="elh_students_pob" for="x_pob" class="<?php echo $students_edit->LeftColumnClass ?>"><?php echo $students->pob->caption() ?><?php echo ($students->pob->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $students_edit->RightColumnClass ?>"><div<?php echo $students->pob->cellAttributes() ?>>
<span id="el_students_pob">
<input type="text" data-table="students" data-field="x_pob" name="x_pob" id="x_pob" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($students->pob->getPlaceHolder()) ?>" value="<?php echo $students->pob->EditValue ?>"<?php echo $students->pob->editAttributes() ?>>
</span>
<?php echo $students->pob->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$students_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $students_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $students_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$students_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$students_edit->terminate();
?>
