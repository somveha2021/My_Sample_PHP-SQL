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
$countries_delete = new countries_delete();

// Run the page
$countries_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$countries_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcountriesdelete = currentForm = new ew.Form("fcountriesdelete", "delete");

// Form_CustomValidate event
fcountriesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcountriesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $countries_delete->showPageHeader(); ?>
<?php
$countries_delete->showMessage();
?>
<form name="fcountriesdelete" id="fcountriesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($countries_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $countries_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="countries">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($countries_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($countries->id->Visible) { // id ?>
		<th class="<?php echo $countries->id->headerCellClass() ?>"><span id="elh_countries_id" class="countries_id"><?php echo $countries->id->caption() ?></span></th>
<?php } ?>
<?php if ($countries->name->Visible) { // name ?>
		<th class="<?php echo $countries->name->headerCellClass() ?>"><span id="elh_countries_name" class="countries_name"><?php echo $countries->name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$countries_delete->RecCnt = 0;
$i = 0;
while (!$countries_delete->Recordset->EOF) {
	$countries_delete->RecCnt++;
	$countries_delete->RowCnt++;

	// Set row properties
	$countries->resetAttributes();
	$countries->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$countries_delete->loadRowValues($countries_delete->Recordset);

	// Render row
	$countries_delete->renderRow();
?>
	<tr<?php echo $countries->rowAttributes() ?>>
<?php if ($countries->id->Visible) { // id ?>
		<td<?php echo $countries->id->cellAttributes() ?>>
<span id="el<?php echo $countries_delete->RowCnt ?>_countries_id" class="countries_id">
<span<?php echo $countries->id->viewAttributes() ?>>
<?php echo $countries->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($countries->name->Visible) { // name ?>
		<td<?php echo $countries->name->cellAttributes() ?>>
<span id="el<?php echo $countries_delete->RowCnt ?>_countries_name" class="countries_name">
<span<?php echo $countries->name->viewAttributes() ?>>
<?php echo $countries->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$countries_delete->Recordset->moveNext();
}
$countries_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $countries_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$countries_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$countries_delete->terminate();
?>
