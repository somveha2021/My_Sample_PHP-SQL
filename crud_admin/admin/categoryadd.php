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
$category_add = new category_add();

// Run the page
$category_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcategoryadd = currentForm = new ew.Form("fcategoryadd", "add");

// Validate form
fcategoryadd.validate = function() {
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
		<?php if ($category_add->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->name->caption(), $category->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_add->icon->Required) { ?>
			elm = this.getElements("x" + infix + "_icon");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->icon->caption(), $category->icon->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($category_add->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $category->status->caption(), $category->status->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($category->status->errorMessage()) ?>");

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
fcategoryadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategoryadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $category_add->showPageHeader(); ?>
<?php
$category_add->showMessage();
?>
<form name="fcategoryadd" id="fcategoryadd" class="<?php echo $category_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$category_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($category->name->Visible) { // name ?>
	<div id="r_name" class="form-group row">
		<label id="elh_category_name" for="x_name" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category->name->caption() ?><?php echo ($category->name->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<input type="text" data-table="category" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($category->name->getPlaceHolder()) ?>" value="<?php echo $category->name->EditValue ?>"<?php echo $category->name->editAttributes() ?>>
</span>
<?php echo $category->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category->icon->Visible) { // icon ?>
	<div id="r_icon" class="form-group row">
		<label id="elh_category_icon" for="x_icon" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category->icon->caption() ?><?php echo ($category->icon->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div<?php echo $category->icon->cellAttributes() ?>>
<span id="el_category_icon">
<input type="text" data-table="category" data-field="x_icon" name="x_icon" id="x_icon" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($category->icon->getPlaceHolder()) ?>" value="<?php echo $category->icon->EditValue ?>"<?php echo $category->icon->editAttributes() ?>>
</span>
<?php echo $category->icon->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_category_status" for="x_status" class="<?php echo $category_add->LeftColumnClass ?>"><?php echo $category->status->caption() ?><?php echo ($category->status->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $category_add->RightColumnClass ?>"><div<?php echo $category->status->cellAttributes() ?>>
<span id="el_category_status">
<input type="text" data-table="category" data-field="x_status" name="x_status" id="x_status" size="30" placeholder="<?php echo HtmlEncode($category->status->getPlaceHolder()) ?>" value="<?php echo $category->status->EditValue ?>"<?php echo $category->status->editAttributes() ?>>
</span>
<?php echo $category->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$category_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $category_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$category_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$category_add->terminate();
?>
