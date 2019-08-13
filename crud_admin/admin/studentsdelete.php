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
$students_delete = new students_delete();

// Run the page
$students_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$students_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fstudentsdelete = currentForm = new ew.Form("fstudentsdelete", "delete");

// Form_CustomValidate event
fstudentsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fstudentsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $students_delete->showPageHeader(); ?>
<?php
$students_delete->showMessage();
?>
<form name="fstudentsdelete" id="fstudentsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($students_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $students_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="students">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($students_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($students->stu_id->Visible) { // stu_id ?>
		<th class="<?php echo $students->stu_id->headerCellClass() ?>"><span id="elh_students_stu_id" class="students_stu_id"><?php echo $students->stu_id->caption() ?></span></th>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
		<th class="<?php echo $students->name->headerCellClass() ?>"><span id="elh_students_name" class="students_name"><?php echo $students->name->caption() ?></span></th>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
		<th class="<?php echo $students->gender->headerCellClass() ?>"><span id="elh_students_gender" class="students_gender"><?php echo $students->gender->caption() ?></span></th>
<?php } ?>
<?php if ($students->bod->Visible) { // bod ?>
		<th class="<?php echo $students->bod->headerCellClass() ?>"><span id="elh_students_bod" class="students_bod"><?php echo $students->bod->caption() ?></span></th>
<?php } ?>
<?php if ($students->pob->Visible) { // pob ?>
		<th class="<?php echo $students->pob->headerCellClass() ?>"><span id="elh_students_pob" class="students_pob"><?php echo $students->pob->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$students_delete->RecCnt = 0;
$i = 0;
while (!$students_delete->Recordset->EOF) {
	$students_delete->RecCnt++;
	$students_delete->RowCnt++;

	// Set row properties
	$students->resetAttributes();
	$students->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$students_delete->loadRowValues($students_delete->Recordset);

	// Render row
	$students_delete->renderRow();
?>
	<tr<?php echo $students->rowAttributes() ?>>
<?php if ($students->stu_id->Visible) { // stu_id ?>
		<td<?php echo $students->stu_id->cellAttributes() ?>>
<span id="el<?php echo $students_delete->RowCnt ?>_students_stu_id" class="students_stu_id">
<span<?php echo $students->stu_id->viewAttributes() ?>>
<?php echo $students->stu_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
		<td<?php echo $students->name->cellAttributes() ?>>
<span id="el<?php echo $students_delete->RowCnt ?>_students_name" class="students_name">
<span<?php echo $students->name->viewAttributes() ?>>
<?php echo $students->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
		<td<?php echo $students->gender->cellAttributes() ?>>
<span id="el<?php echo $students_delete->RowCnt ?>_students_gender" class="students_gender">
<span<?php echo $students->gender->viewAttributes() ?>>
<?php echo $students->gender->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($students->bod->Visible) { // bod ?>
		<td<?php echo $students->bod->cellAttributes() ?>>
<span id="el<?php echo $students_delete->RowCnt ?>_students_bod" class="students_bod">
<span<?php echo $students->bod->viewAttributes() ?>>
<?php echo $students->bod->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($students->pob->Visible) { // pob ?>
		<td<?php echo $students->pob->cellAttributes() ?>>
<span id="el<?php echo $students_delete->RowCnt ?>_students_pob" class="students_pob">
<span<?php echo $students->pob->viewAttributes() ?>>
<?php echo $students->pob->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$students_delete->Recordset->moveNext();
}
$students_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $students_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$students_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$students_delete->terminate();
?>
