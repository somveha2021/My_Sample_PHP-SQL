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
$category_delete = new category_delete();

// Run the page
$category_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$category_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcategorydelete = currentForm = new ew.Form("fcategorydelete", "delete");

// Form_CustomValidate event
fcategorydelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcategorydelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $category_delete->showPageHeader(); ?>
<?php
$category_delete->showMessage();
?>
<form name="fcategorydelete" id="fcategorydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($category_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $category_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="category">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($category_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($category->category_id->Visible) { // category_id ?>
		<th class="<?php echo $category->category_id->headerCellClass() ?>"><span id="elh_category_category_id" class="category_category_id"><?php echo $category->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
		<th class="<?php echo $category->name->headerCellClass() ?>"><span id="elh_category_name" class="category_name"><?php echo $category->name->caption() ?></span></th>
<?php } ?>
<?php if ($category->icon->Visible) { // icon ?>
		<th class="<?php echo $category->icon->headerCellClass() ?>"><span id="elh_category_icon" class="category_icon"><?php echo $category->icon->caption() ?></span></th>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
		<th class="<?php echo $category->status->headerCellClass() ?>"><span id="elh_category_status" class="category_status"><?php echo $category->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$category_delete->RecCnt = 0;
$i = 0;
while (!$category_delete->Recordset->EOF) {
	$category_delete->RecCnt++;
	$category_delete->RowCnt++;

	// Set row properties
	$category->resetAttributes();
	$category->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$category_delete->loadRowValues($category_delete->Recordset);

	// Render row
	$category_delete->renderRow();
?>
	<tr<?php echo $category->rowAttributes() ?>>
<?php if ($category->category_id->Visible) { // category_id ?>
		<td<?php echo $category->category_id->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCnt ?>_category_category_id" class="category_category_id">
<span<?php echo $category->category_id->viewAttributes() ?>>
<?php echo $category->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($category->name->Visible) { // name ?>
		<td<?php echo $category->name->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCnt ?>_category_name" class="category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($category->icon->Visible) { // icon ?>
		<td<?php echo $category->icon->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCnt ?>_category_icon" class="category_icon">
<span<?php echo $category->icon->viewAttributes() ?>>
<?php echo $category->icon->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($category->status->Visible) { // status ?>
		<td<?php echo $category->status->cellAttributes() ?>>
<span id="el<?php echo $category_delete->RowCnt ?>_category_status" class="category_status">
<span<?php echo $category->status->viewAttributes() ?>>
<?php echo $category->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$category_delete->Recordset->moveNext();
}
$category_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $category_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$category_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$category_delete->terminate();
?>
