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
$employees_delete = new employees_delete();

// Run the page
$employees_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var femployeesdelete = currentForm = new ew.Form("femployeesdelete", "delete");

// Form_CustomValidate event
femployeesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $employees_delete->showPageHeader(); ?>
<?php
$employees_delete->showMessage();
?>
<form name="femployeesdelete" id="femployeesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employees_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employees->id->Visible) { // id ?>
		<th class="<?php echo $employees->id->headerCellClass() ?>"><span id="elh_employees_id" class="employees_id"><?php echo $employees->id->caption() ?></span></th>
<?php } ?>
<?php if ($employees->name->Visible) { // name ?>
		<th class="<?php echo $employees->name->headerCellClass() ?>"><span id="elh_employees_name" class="employees_name"><?php echo $employees->name->caption() ?></span></th>
<?php } ?>
<?php if ($employees->address->Visible) { // address ?>
		<th class="<?php echo $employees->address->headerCellClass() ?>"><span id="elh_employees_address" class="employees_address"><?php echo $employees->address->caption() ?></span></th>
<?php } ?>
<?php if ($employees->salary->Visible) { // salary ?>
		<th class="<?php echo $employees->salary->headerCellClass() ?>"><span id="elh_employees_salary" class="employees_salary"><?php echo $employees->salary->caption() ?></span></th>
<?php } ?>
<?php if ($employees->photo->Visible) { // photo ?>
		<th class="<?php echo $employees->photo->headerCellClass() ?>"><span id="elh_employees_photo" class="employees_photo"><?php echo $employees->photo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employees_delete->RecCnt = 0;
$i = 0;
while (!$employees_delete->Recordset->EOF) {
	$employees_delete->RecCnt++;
	$employees_delete->RowCnt++;

	// Set row properties
	$employees->resetAttributes();
	$employees->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employees_delete->loadRowValues($employees_delete->Recordset);

	// Render row
	$employees_delete->renderRow();
?>
	<tr<?php echo $employees->rowAttributes() ?>>
<?php if ($employees->id->Visible) { // id ?>
		<td<?php echo $employees->id->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_id" class="employees_id">
<span<?php echo $employees->id->viewAttributes() ?>>
<?php echo $employees->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->name->Visible) { // name ?>
		<td<?php echo $employees->name->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_name" class="employees_name">
<span<?php echo $employees->name->viewAttributes() ?>>
<?php echo $employees->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->address->Visible) { // address ?>
		<td<?php echo $employees->address->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_address" class="employees_address">
<span<?php echo $employees->address->viewAttributes() ?>>
<?php echo $employees->address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->salary->Visible) { // salary ?>
		<td<?php echo $employees->salary->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_salary" class="employees_salary">
<span<?php echo $employees->salary->viewAttributes() ?>>
<?php echo $employees->salary->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->photo->Visible) { // photo ?>
		<td<?php echo $employees->photo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_photo" class="employees_photo">
<span<?php echo $employees->photo->viewAttributes() ?>>
<?php echo $employees->photo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employees_delete->Recordset->moveNext();
}
$employees_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employees_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$employees_delete->terminate();
?>
