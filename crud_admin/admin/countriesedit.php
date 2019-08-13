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
$countries_edit = new countries_edit();

// Run the page
$countries_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countries_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcountriesedit = currentForm = new ew.Form("fcountriesedit", "edit");

// Validate form
fcountriesedit.validate = function() {
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
		<?php if ($countries_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countries->id->caption(), $countries->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($countries_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $countries->name->caption(), $countries->name->RequiredErrorMessage)) ?>");
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
fcountriesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountriesedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countries_edit->showPageHeader(); ?>
<?php
$countries_edit->showMessage();
?>
<form name="fcountriesedit" id="fcountriesedit" class="<?php echo $countries_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countries_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countries_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countries">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$countries_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($countries->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_countries_id" class="<?php echo $countries_edit->LeftColumnClass ?>"><?php echo $countries->id->caption() ?><?php echo ($countries->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countries_edit->RightColumnClass ?>"><div<?php echo $countries->id->cellAttributes() ?>>
<span id="el_countries_id">
<span<?php echo $countries->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($countries->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="countries" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($countries->id->CurrentValue) ?>">
<?php echo $countries->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($countries->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_countries_name" for="x_name" class="<?php echo $countries_edit->LeftColumnClass ?>"><?php echo $countries->name->caption() ?><?php echo ($countries->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $countries_edit->RightColumnClass ?>"><div<?php echo $countries->name->cellAttributes() ?>>
<span id="el_countries_name">
<input type="text" data-table="countries" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($countries->name->getPlaceHolder()) ?>" value="<?php echo $countries->name->EditValue ?>"<?php echo $countries->name->editAttributes() ?>>
</span>
<?php echo $countries->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$countries_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $countries_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $countries_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$countries_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$countries_edit->terminate();
?>
