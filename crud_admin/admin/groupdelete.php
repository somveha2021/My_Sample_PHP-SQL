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
$group_delete = new group_delete();

// Run the page
$group_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$group_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fgroupdelete = currentForm = new ew.Form("fgroupdelete", "delete");

// Form_CustomValidate event
fgroupdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fgroupdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $group_delete->showPageHeader(); ?>
<?php
$group_delete->showMessage();
?>
<form name="fgroupdelete" id="fgroupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($group_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $group_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="group">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($group_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($group->id->Visible) { // id ?>
		<th class="<?php echo $group->id->headerCellClass() ?>"><span id="elh_group_id" class="group_id"><?php echo $group->id->caption() ?></span></th>
<?php } ?>
<?php if ($group->name->Visible) { // name ?>
		<th class="<?php echo $group->name->headerCellClass() ?>"><span id="elh_group_name" class="group_name"><?php echo $group->name->caption() ?></span></th>
<?php } ?>
<?php if ($group->role->Visible) { // role ?>
		<th class="<?php echo $group->role->headerCellClass() ?>"><span id="elh_group_role" class="group_role"><?php echo $group->role->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$group_delete->RecCnt = 0;
$i = 0;
while (!$group_delete->Recordset->EOF) {
	$group_delete->RecCnt++;
	$group_delete->RowCnt++;

	// Set row properties
	$group->resetAttributes();
	$group->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$group_delete->loadRowValues($group_delete->Recordset);

	// Render row
	$group_delete->renderRow();
?>
	<tr<?php echo $group->rowAttributes() ?>>
<?php if ($group->id->Visible) { // id ?>
		<td<?php echo $group->id->cellAttributes() ?>>
<span id="el<?php echo $group_delete->RowCnt ?>_group_id" class="group_id">
<span<?php echo $group->id->viewAttributes() ?>>
<?php echo $group->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($group->name->Visible) { // name ?>
		<td<?php echo $group->name->cellAttributes() ?>>
<span id="el<?php echo $group_delete->RowCnt ?>_group_name" class="group_name">
<span<?php echo $group->name->viewAttributes() ?>>
<?php echo $group->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($group->role->Visible) { // role ?>
		<td<?php echo $group->role->cellAttributes() ?>>
<span id="el<?php echo $group_delete->RowCnt ?>_group_role" class="group_role">
<span<?php echo $group->role->viewAttributes() ?>>
<?php echo $group->role->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$group_delete->Recordset->moveNext();
}
$group_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $group_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$group_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$group_delete->terminate();
?>
