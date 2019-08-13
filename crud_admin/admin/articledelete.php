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
$article_delete = new article_delete();

// Run the page
$article_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$article_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var farticledelete = currentForm = new ew.Form("farticledelete", "delete");

// Form_CustomValidate event
farticledelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
farticledelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
farticledelete.lists["x_category_id"] = <?php echo $article_delete->category_id->Lookup->toClientList() ?>;
farticledelete.lists["x_category_id"].options = <?php echo JsonEncode($article_delete->category_id->lookupOptions()) ?>;
farticledelete.lists["x_created_by"] = <?php echo $article_delete->created_by->Lookup->toClientList() ?>;
farticledelete.lists["x_created_by"].options = <?php echo JsonEncode($article_delete->created_by->lookupOptions()) ?>;
farticledelete.lists["x_status"] = <?php echo $article_delete->status->Lookup->toClientList() ?>;
farticledelete.lists["x_status"].options = <?php echo JsonEncode($article_delete->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $article_delete->showPageHeader(); ?>
<?php
$article_delete->showMessage();
?>
<form name="farticledelete" id="farticledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($article_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $article_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="article">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($article_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($article->id->Visible) { // id ?>
		<th class="<?php echo $article->id->headerCellClass() ?>"><span id="elh_article_id" class="article_id"><?php echo $article->id->caption() ?></span></th>
<?php } ?>
<?php if ($article->category_id->Visible) { // category_id ?>
		<th class="<?php echo $article->category_id->headerCellClass() ?>"><span id="elh_article_category_id" class="article_category_id"><?php echo $article->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($article->title->Visible) { // title ?>
		<th class="<?php echo $article->title->headerCellClass() ?>"><span id="elh_article_title" class="article_title"><?php echo $article->title->caption() ?></span></th>
<?php } ?>
<?php if ($article->photo->Visible) { // photo ?>
		<th class="<?php echo $article->photo->headerCellClass() ?>"><span id="elh_article_photo" class="article_photo"><?php echo $article->photo->caption() ?></span></th>
<?php } ?>
<?php if ($article->created_by->Visible) { // created_by ?>
		<th class="<?php echo $article->created_by->headerCellClass() ?>"><span id="elh_article_created_by" class="article_created_by"><?php echo $article->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($article->created_date->Visible) { // created_date ?>
		<th class="<?php echo $article->created_date->headerCellClass() ?>"><span id="elh_article_created_date" class="article_created_date"><?php echo $article->created_date->caption() ?></span></th>
<?php } ?>
<?php if ($article->status->Visible) { // status ?>
		<th class="<?php echo $article->status->headerCellClass() ?>"><span id="elh_article_status" class="article_status"><?php echo $article->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$article_delete->RecCnt = 0;
$i = 0;
while (!$article_delete->Recordset->EOF) {
	$article_delete->RecCnt++;
	$article_delete->RowCnt++;

	// Set row properties
	$article->resetAttributes();
	$article->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$article_delete->loadRowValues($article_delete->Recordset);

	// Render row
	$article_delete->renderRow();
?>
	<tr<?php echo $article->rowAttributes() ?>>
<?php if ($article->id->Visible) { // id ?>
		<td<?php echo $article->id->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_id" class="article_id">
<span<?php echo $article->id->viewAttributes() ?>>
<?php echo $article->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($article->category_id->Visible) { // category_id ?>
		<td<?php echo $article->category_id->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_category_id" class="article_category_id">
<span<?php echo $article->category_id->viewAttributes() ?>>
<?php echo $article->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($article->title->Visible) { // title ?>
		<td<?php echo $article->title->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_title" class="article_title">
<span<?php echo $article->title->viewAttributes() ?>>
<?php echo $article->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($article->photo->Visible) { // photo ?>
		<td<?php echo $article->photo->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_photo" class="article_photo">
<span>
<?php echo GetFileViewTag($article->photo, $article->photo->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($article->created_by->Visible) { // created_by ?>
		<td<?php echo $article->created_by->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_created_by" class="article_created_by">
<span<?php echo $article->created_by->viewAttributes() ?>>
<?php echo $article->created_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($article->created_date->Visible) { // created_date ?>
		<td<?php echo $article->created_date->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_created_date" class="article_created_date">
<span<?php echo $article->created_date->viewAttributes() ?>>
<?php echo $article->created_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($article->status->Visible) { // status ?>
		<td<?php echo $article->status->cellAttributes() ?>>
<span id="el<?php echo $article_delete->RowCnt ?>_article_status" class="article_status">
<span<?php echo $article->status->viewAttributes() ?>>
<?php echo $article->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$article_delete->Recordset->moveNext();
}
$article_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $article_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$article_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$article_delete->terminate();
?>
