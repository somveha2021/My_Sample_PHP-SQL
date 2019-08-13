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
$article_edit = new article_edit();

// Run the page
$article_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$article_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var farticleedit = currentForm = new ew.Form("farticleedit", "edit");

// Validate form
farticleedit.validate = function() {
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
		<?php if ($article_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->id->caption(), $article->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->category_id->Required) { ?>
			elm = this.getElements("x" + infix + "_category_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->category_id->caption(), $article->category_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->title->Required) { ?>
			elm = this.getElements("x" + infix + "_title");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->title->caption(), $article->title->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->detail->Required) { ?>
			elm = this.getElements("x" + infix + "_detail");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->detail->caption(), $article->detail->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->photo->Required) { ?>
			felm = this.getElements("x" + infix + "_photo");
			elm = this.getElements("fn_x" + infix + "_photo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $article->photo->caption(), $article->photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->created_by->Required) { ?>
			elm = this.getElements("x" + infix + "_created_by");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->created_by->caption(), $article->created_by->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($article_edit->created_date->Required) { ?>
			elm = this.getElements("x" + infix + "_created_date");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->created_date->caption(), $article->created_date->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_created_date");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($article->created_date->errorMessage()) ?>");
		<?php if ($article_edit->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $article->status->caption(), $article->status->RequiredErrorMessage)) ?>");
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
farticleedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
farticleedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
farticleedit.lists["x_category_id"] = <?php echo $article_edit->category_id->Lookup->toClientList() ?>;
farticleedit.lists["x_category_id"].options = <?php echo JsonEncode($article_edit->category_id->lookupOptions()) ?>;
farticleedit.lists["x_created_by"] = <?php echo $article_edit->created_by->Lookup->toClientList() ?>;
farticleedit.lists["x_created_by"].options = <?php echo JsonEncode($article_edit->created_by->lookupOptions()) ?>;
farticleedit.lists["x_status"] = <?php echo $article_edit->status->Lookup->toClientList() ?>;
farticleedit.lists["x_status"].options = <?php echo JsonEncode($article_edit->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $article_edit->showPageHeader(); ?>
<?php
$article_edit->showMessage();
?>
<form name="farticleedit" id="farticleedit" class="<?php echo $article_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($article_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $article_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="article">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$article_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($article->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_article_id" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->id->caption() ?><?php echo ($article->id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->id->cellAttributes() ?>>
<span id="el_article_id">
<span<?php echo $article->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($article->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="article" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($article->id->CurrentValue) ?>">
<?php echo $article->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->category_id->Visible) { // category_id ?>
	<div id="r_category_id" class="form-group row">
		<label id="elh_article_category_id" for="x_category_id" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->category_id->caption() ?><?php echo ($article->category_id->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->category_id->cellAttributes() ?>>
<span id="el_article_category_id">
<span<?php echo $article->category_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($article->category_id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="article" data-field="x_category_id" name="x_category_id" id="x_category_id" value="<?php echo HtmlEncode($article->category_id->CurrentValue) ?>">
<?php echo $article->category_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->title->Visible) { // title ?>
	<div id="r_title" class="form-group row">
		<label id="elh_article_title" for="x_title" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->title->caption() ?><?php echo ($article->title->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->title->cellAttributes() ?>>
<span id="el_article_title">
<input type="text" data-table="article" data-field="x_title" name="x_title" id="x_title" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($article->title->getPlaceHolder()) ?>" value="<?php echo $article->title->EditValue ?>"<?php echo $article->title->editAttributes() ?>>
</span>
<?php echo $article->title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->detail->Visible) { // detail ?>
	<div id="r_detail" class="form-group row">
		<label id="elh_article_detail" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->detail->caption() ?><?php echo ($article->detail->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->detail->cellAttributes() ?>>
<span id="el_article_detail">
<?php AppendClass($article->detail->EditAttrs["class"], "editor"); ?>
<textarea data-table="article" data-field="x_detail" name="x_detail" id="x_detail" cols="35" rows="4" placeholder="<?php echo HtmlEncode($article->detail->getPlaceHolder()) ?>"<?php echo $article->detail->editAttributes() ?>><?php echo $article->detail->EditValue ?></textarea>
<script>
ew.createEditor("farticleedit", "x_detail", 35, 4, <?php echo ($article->detail->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $article->detail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->photo->Visible) { // photo ?>
	<div id="r_photo" class="form-group row">
		<label id="elh_article_photo" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->photo->caption() ?><?php echo ($article->photo->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->photo->cellAttributes() ?>>
<span id="el_article_photo">
<div id="fd_x_photo">
<span title="<?php echo $article->photo->title() ? $article->photo->title() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($article->photo->ReadOnly || $article->photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="article" data-field="x_photo" name="x_photo" id="x_photo"<?php echo $article->photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_photo" id= "fn_x_photo" value="<?php echo $article->photo->Upload->FileName ?>">
<?php if (Post("fa_x_photo") == "0") { ?>
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_photo" id= "fa_x_photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x_photo" id= "fs_x_photo" value="250">
<input type="hidden" name="fx_x_photo" id= "fx_x_photo" value="<?php echo $article->photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo" id= "fm_x_photo" value="<?php echo $article->photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $article->photo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->created_by->Visible) { // created_by ?>
	<div id="r_created_by" class="form-group row">
		<label id="elh_article_created_by" for="x_created_by" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->created_by->caption() ?><?php echo ($article->created_by->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->created_by->cellAttributes() ?>>
<span id="el_article_created_by">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="article" data-field="x_created_by" data-value-separator="<?php echo $article->created_by->displayValueSeparatorAttribute() ?>" id="x_created_by" name="x_created_by"<?php echo $article->created_by->editAttributes() ?>>
		<?php echo $article->created_by->selectOptionListHtml("x_created_by") ?>
	</select>
<?php echo $article->created_by->Lookup->getParamTag("p_x_created_by") ?>
</div>
</span>
<?php echo $article->created_by->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->created_date->Visible) { // created_date ?>
	<div id="r_created_date" class="form-group row">
		<label id="elh_article_created_date" for="x_created_date" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->created_date->caption() ?><?php echo ($article->created_date->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->created_date->cellAttributes() ?>>
<span id="el_article_created_date">
<input type="text" data-table="article" data-field="x_created_date" name="x_created_date" id="x_created_date" placeholder="<?php echo HtmlEncode($article->created_date->getPlaceHolder()) ?>" value="<?php echo $article->created_date->EditValue ?>"<?php echo $article->created_date->editAttributes() ?>>
<?php if (!$article->created_date->ReadOnly && !$article->created_date->Disabled && !isset($article->created_date->EditAttrs["readonly"]) && !isset($article->created_date->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("farticleedit", "x_created_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $article->created_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($article->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_article_status" class="<?php echo $article_edit->LeftColumnClass ?>"><?php echo $article->status->caption() ?><?php echo ($article->status->Required) ? $Language->Phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $article_edit->RightColumnClass ?>"><div<?php echo $article->status->cellAttributes() ?>>
<span id="el_article_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="form-check-input" data-table="article" data-field="x_status" data-value-separator="<?php echo $article->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $article->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $article->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $article->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$article_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $article_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $article_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$article_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$article_edit->terminate();
?>
